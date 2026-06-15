<?php

require_once __DIR__ . '/BaseCrawler.php';

class YonexProductDetailCrawler extends BaseCrawler
{
    protected string $inputFile;
    protected string $outputDir;

    public function __construct()
    {
        $this->inputFile =
            __DIR__ . '/../data/yonex/products/data.json';

        $this->outputDir =
            __DIR__ . '/../data/yonex/products-detail';
    }

    public function run(): void
    {
        set_time_limit(0);

        if (!file_exists($this->inputFile)) {
            throw new RuntimeException('Products file not found');
        }

        $products = json_decode(
            file_get_contents($this->inputFile),
            true
        );

        foreach ($products as $i => $product) {

            $url = $this->buildUrl(
                $product['category'],
                $product['slug']
            );

            $this->log("[$i] Crawling: $url");

            $html = $this->getHtml($url);

            if (!$html) {
                $this->log("SKIP EMPTY HTML");
                continue;
            }

            $detail = $this->parseDetail($html);

            $this->log("IMAGE FOUND: " . count($detail['images']));

            $imageFiles = $this->downloadImages(
                $product['category'],
                $product['slug'],
                $detail['images']
            );

            $item = array_merge(
                $product,
                $detail,
                [
                    'detail_url'   => $url,
                    'local_images' => $imageFiles
                ]
            );

            /**
             * =========================
             * SAVE PER SLUG
             * =========================
             */
            $slug = $product['slug'];
            $dir = $this->outputDir . "/$slug";

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            file_put_contents(
                $dir . '/data.json',
                json_encode(
                    $item,
                    JSON_PRETTY_PRINT |
                    JSON_UNESCAPED_UNICODE |
                    JSON_UNESCAPED_SLASHES
                )
            );

            $this->log("SAVED: $slug");
        }

        $this->log("DONE ALL");
    }

    protected function buildUrl(string $category, string $slug): string
    {
        return "https://www.yonex.com/badminton/$category/$slug";
    }

    /**
     * =========================
     * NORMALIZE IMAGE URL
     * =========================
     */
    protected function normalizeImageUrl(string $url): string
    {
        $url = trim($url);
        $url = strtok($url, '?');
        $url = str_replace('http://', 'https://', $url);
        return $url;
    }

    /**
     * =========================
     * PARSE DETAIL
     * =========================
     */
    protected function parseDetail(string $html): array
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML($html);

        $xpath = new DOMXPath($dom);

        $data = [
            'title' => null,
            'description' => null,
            'specs' => [],
            'images' => []
        ];

        // TITLE
        $h1 = $xpath->query('//h1')->item(0);
        if ($h1) {
            $data['title'] = trim($h1->textContent);
        }

        // DESCRIPTION
        $desc = $xpath->query('//div[contains(@class,"description")]')->item(0);
        if ($desc) {
            $data['description'] = trim($desc->textContent);
        }

        // SPECS
        foreach ($xpath->query('//table//tr') as $row) {

            $cols = $xpath->query('.//td|.//th', $row);

            if ($cols->length < 2) continue;

            $k = trim($cols->item(0)->textContent);
            $v = trim($cols->item(1)->textContent);

            if ($k && $v) {
                $data['specs'][$k] = $v;
            }
        }

        /**
         * =========================
         * IMAGES (ROBUST FIX)
         * =========================
         */
        $images = [];

        // LEVEL 1: JSON fotorama
        if (preg_match('#"data"\s*:\s*(\[[\s\S]*?\])#', $html, $m)) {

            $json = json_decode($m[1], true);

            if (is_array($json)) {
                foreach ($json as $item) {

                    if (!empty($item['img'])) {
                        $images[] = $this->normalizeImageUrl($item['img']);
                    }

                    if (!empty($item['full'])) {
                        $images[] = $this->normalizeImageUrl($item['full']);
                    }
                }
            }
        }

        // LEVEL 2: fotorama stage
        if (empty($images)) {

            $frames = $xpath->query('//div[contains(@class,"fotorama__stage__frame")]');

            foreach ($frames as $frame) {

                $href = $frame->getAttribute('href');
                if ($href && str_contains($href, '/media/catalog/product/')) {
                    $images[] = $this->normalizeImageUrl($href);
                }

                $img = $xpath->query('.//img', $frame)->item(0);
                if ($img) {
                    $src = $img->getAttribute('src');
                    if ($src && str_contains($src, '/media/catalog/product/')) {
                        $images[] = $this->normalizeImageUrl($src);
                    }
                }
            }
        }

        // LEVEL 3: GLOBAL IMG FALLBACK (FIX MẤT ẢNH)
        if (empty($images)) {

            $imgNodes = $xpath->query('//img[contains(@src,"/media/catalog/product/")]');

            foreach ($imgNodes as $img) {
                $src = $img->getAttribute('src');
                if ($src) {
                    $images[] = $this->normalizeImageUrl($src);
                }
            }
        }

        /**
         * DEDUPE STRONG
         */
        $unique = [];
        foreach ($images as $img) {
            if (!$img) continue;
            $unique[md5($img)] = $img;
        }

        $data['images'] = array_values($unique);

        return $data;
    }

    /**
     * =========================
     * DOWNLOAD IMAGES
     * =========================
     */
    protected function downloadImages(
        string $category,
        string $slug,
        array $images
    ): array {

        $baseDir =
            $this->outputDir . "/$slug/img";

        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $saved = [];

        foreach ($images as $i => $url) {

            if (!$url) continue;

            $ext = pathinfo(
                parse_url($url, PHP_URL_PATH),
                PATHINFO_EXTENSION
            );

            if (!$ext) $ext = 'jpg';

            $fileName = ($i + 1) . '.' . $ext;
            $savePath = $baseDir . '/' . $fileName;

            $this->log("Downloading: $url");

            if ($this->downloadImage($url, $savePath)) {
                $saved[] =
                    "data/yonex/products-detail/$slug/img/$fileName";
            }
        }

        return $saved;
    }
}

(new YonexProductDetailCrawler())->run();