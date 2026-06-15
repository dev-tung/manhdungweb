<?php

require_once __DIR__ . '/BaseCrawler.php';

class YonexCategoryCrawler extends BaseCrawler
{
    protected string $baseUrl =
        'https://www.yonex.com/badminton';

    protected string $dataDir;

    protected string $categoryDir;

    public function __construct()
    {
        $this->dataDir =
            __DIR__ . '/../data/yonex/categories';

        $this->categoryDir =
            $this->dataDir . '/img';
    }

    public function run(): void
    {
        set_time_limit(0);

        $this->deleteDirectory(
            $this->dataDir
        );

        mkdir(
            $this->categoryDir,
            0777,
            true
        );

        $this->log(
            'Loading homepage...'
        );

        $html = $this->getHtml(
            $this->baseUrl
        );

        if (trim($html) === '') {

            throw new RuntimeException(
                'Cannot load Yonex website'
            );
        }

        $categories =
            $this->extractCategories(
                $html
            );

        $this->log(
            'Found ' .
            count($categories) .
            ' categories'
        );

        preg_match_all(
            '#https://www\.yonex\.com/media/wysiwyg/submenu-icons/[^"\']+#i',
            $html,
            $matches
        );

        $images = array_unique(
            $matches[0] ?? []
        );

        $this->log(
            'Found ' .
            count($images) .
            ' menu images'
        );

        $map = [
            'racquets'           => 'raquet',
            'strings'            => 'string',
            'stringing-machines' => 'machine',
            'shuttlecocks'       => 'shuttlecocks',
            'shoes'              => 'shoe',
            'footwear'           => 'shoe',
            'bags'               => 'bag',
            'apparel'            => 'apparel',
            'accessories'        => 'accessory',
        ];

        foreach (
            $categories as &$category
        ) {

            $keyword =
                $map[
                    $category['slug']
                ] ?? null;

            if (!$keyword) {
                continue;
            }

            foreach (
                $images as $imageUrl
            ) {

                if (
                    stripos(
                        $imageUrl,
                        $keyword
                    ) === false
                ) {
                    continue;
                }

                $fileName =
                    $category['slug'] .
                    '.png';

                $savePath =
                    $this->categoryDir .
                    '/' .
                    $fileName;

                $this->log(
                    'Downloading: ' .
                    $fileName
                );

                if (
                    $this->downloadImage(
                        $imageUrl,
                        $savePath
                    )
                ) {

                    $category['image'] =
                        $imageUrl;

                    $category['image_file'] =
                        'data/yonex/categories/img/' .
                        $fileName;
                }

                break;
            }
        }

        unset($category);

        file_put_contents(
            $this->dataDir .
            '/data.json',
            json_encode(
                array_values(
                    $categories
                ),
                JSON_PRETTY_PRINT
                | JSON_UNESCAPED_UNICODE
                | JSON_UNESCAPED_SLASHES
            )
        );

        $this->log('');
        $this->log(
            '===================='
        );
        $this->log('DONE');
        $this->log(
            'Categories: ' .
            count($categories)
        );
        $this->log(
            'JSON: ' .
            $this->dataDir .
            '/categories.json'
        );
        $this->log(
            'Images: ' .
            $this->categoryDir
        );
        $this->log(
            '===================='
        );
    }

    protected function extractCategories(
        string $html
    ): array {

        libxml_use_internal_errors(
            true
        );

        $dom = new DOMDocument();

        $dom->loadHTML(
            $html
        );

        $xpath = new DOMXPath(
            $dom
        );

        $categories = [];

        $links = $xpath->query(
            '//a[contains(@href,"/badminton/")]'
        );

        foreach (
            $links as $link
        ) {

            $href = trim(
                $link->getAttribute(
                    'href'
                )
            );

            if (
                !preg_match(
                    '#/badminton/(racquets|strings|stringing-machines|shuttlecocks|apparel|shoes|footwear|bags|accessories)#i',
                    $href
                )
            ) {
                continue;
            }

            $url =
                str_starts_with(
                    $href,
                    'http'
                )
                    ? $href
                    : 'https://www.yonex.com' .
                    $href;

            $slug = basename(
                parse_url(
                    $url,
                    PHP_URL_PATH
                )
            );

            if (
                isset(
                    $categories[$slug]
                )
            ) {
                continue;
            }

            $name = trim(
                $link->textContent
            );

            if (!$name) {

                $name = ucwords(
                    str_replace(
                        '-',
                        ' ',
                        $slug
                    )
                );
            }

            $categories[$slug] = [
                'name'       => $name,
                'slug'       => $slug,
                'url'        => $url,
                'image'      => null,
                'image_file' => null,
            ];
        }

        return $categories;
    }
}

(new YonexCategoryCrawler())->run();