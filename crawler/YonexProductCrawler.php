<?php

require_once __DIR__ . '/BaseCrawler.php';

class YonexProductCrawler extends BaseCrawler
{
    protected string $categoryFile;

    protected string $dataDir;

    protected string $imageDir;

    public function __construct()
    {
        $this->categoryFile =
            __DIR__ .
            '/../data/yonex/categories/data.json';

        $this->dataDir =
            __DIR__ .
            '/../data/yonex/products';

        $this->imageDir =
            $this->dataDir . '/img';
    }

    public function run(): void
    {
        set_time_limit(0);

        if (!file_exists($this->categoryFile)) {
            throw new RuntimeException(
                'Categories file not found: ' . $this->categoryFile
            );
        }

        $this->deleteDirectory($this->dataDir);

        mkdir($this->imageDir, 0777, true);

        $categories = json_decode(
            file_get_contents($this->categoryFile),
            true
        );

        if (!is_array($categories)) {
            throw new RuntimeException('Invalid categories file');
        }

        $products = [];

        foreach ($categories as $category) {

            $this->log('');
            $this->log('====================');
            $this->log('Category: ' . $category['name']);

            $items = $this->crawlCategory($category);

            foreach ($items as $item) {
                $products[$item['url']] = $item;
            }

            $this->log('Found: ' . count($items));
        }

        file_put_contents(
            $this->dataDir . '/data.json',
            json_encode(
                array_values($products),
                JSON_PRETTY_PRINT |
                JSON_UNESCAPED_UNICODE |
                JSON_UNESCAPED_SLASHES
            )
        );

        $this->log('');
        $this->log('====================');
        $this->log('TOTAL PRODUCTS: ' . count($products));
        $this->log('====================');
    }

    protected function crawlCategory(array $category): array
    {
        $firstHtml = $this->getHtml($category['url']);

        if (!$firstHtml) {
            return [];
        }

        $pageUrls = $this->getPageUrls($firstHtml, $category['url']);

        $this->log('Pages found: ' . count($pageUrls));

        $products = [];

        foreach ($pageUrls as $url) {

            $this->log('Crawling: ' . $url);

            $html = $this->getHtml($url);

            if (!$html) {
                continue;
            }

            $items = $this->parseProducts($html, $category);

            foreach ($items as $item) {
                $products[$item['url']] = $item;
            }
        }

        return $products;
    }

    protected function getPageUrls(string $html, string $baseUrl): array
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML($html);

        $xpath = new DOMXPath($dom);

        $links = $xpath->query(
            '//div[contains(@class,"pages")]//a[contains(@class,"page")]'
        );

        $urls = [];

        foreach ($links as $link) {

            $href = trim($link->getAttribute('href'));

            if ($href) {
                $urls[] = $href;
            }
        }

        // luôn thêm page 1
        $urls[] = $baseUrl;

        $urls = array_unique($urls);

        sort($urls);

        return $urls;
    }

    protected function parseProducts(string $html, array $category): array
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML($html);

        $xpath = new DOMXPath($dom);

        $nodes = $xpath->query('//li[contains(@class,"product-item")]');

        $products = [];

        foreach ($nodes as $node) {

            $linkNode = $xpath->query(
                './/a[contains(@class,"product-item-link")]',
                $node
            )->item(0);

            if (!$linkNode) continue;

            $name = trim(preg_replace('/\s+/', ' ', $linkNode->textContent));
            $url  = trim($linkNode->getAttribute('href'));

            if (!$name || !$url) continue;

            $imgNode = $xpath->query('.//img', $node)->item(0);

            $image = null;

            if ($imgNode) {
                $image =
                    $imgNode->getAttribute('src')
                    ?: $imgNode->getAttribute('data-src')
                    ?: $imgNode->getAttribute('data-original');
            }

            $slug = $this->slugify($name);

            $categoryImageDir =
                $this->imageDir . '/' . $category['slug'];

            if (!is_dir($categoryImageDir)) {
                mkdir($categoryImageDir, 0777, true);
            }

            $product = [
                'name'     => $name,
                'slug'     => $slug,
                'url'      => $url,
                'category' => $category['slug'],
                'image'    => $image,
                'image_file' => null,
            ];

            if ($image) {

                $ext = pathinfo(
                    parse_url($image, PHP_URL_PATH),
                    PATHINFO_EXTENSION
                );

                if (!$ext) {
                    $ext = 'jpg';
                }

                $fileName = $slug . '.' . $ext;

                $savePath =
                    $categoryImageDir . '/' . $fileName;

                $this->log('Downloading: ' . $name);

                if ($this->downloadImage($image, $savePath)) {
                    $product['image_file'] =
                        'data/yonex/products/img/' .
                        $category['slug'] . '/' .
                        $fileName;
                }
            }

            $products[] = $product;
        }

        return $products;
    }

    protected function slugify(string $text): string
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        return trim($text, '-');
    }
}

(new YonexProductCrawler())->run();