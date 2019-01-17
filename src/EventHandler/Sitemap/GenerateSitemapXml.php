<?php

namespace PODEntender\EventHandler\Sitemap;

use samdark\sitemap\Sitemap;
use TightenCo\Jigsaw\Jigsaw;
use PODEntender\EventHandler\HandlerInterface;
use RuntimeException;

class GenerateSitemapXml implements HandlerInterface
{
    const CONFIG_ENTRY_BASE_URL = 'baseUrl';

    const SITEMAP_FILENAME = 'sitemap.xml';

    protected $exclude = [
        '/assets/*',
        '*/favicon.ico',
        '*/404',
    ];

    public function handle(Jigsaw $jigsaw): void
    {
        $baseUrl = $jigsaw->getConfig(self::CONFIG_ENTRY_BASE_URL);

        if (!$baseUrl) {
            $message = '[GenerateSitemapXml] "$baseUrl" config entry is not properly set.';
            throw new RuntimeException($message);
        }

        $sitemap = new Sitemap($jigsaw->getDestinationPath() . '/' . self::SITEMAP_FILENAME);

        collect($jigsaw->getOutputPaths())
            ->sortBy(function (string $path) {
                return $path;
            }, SORT_DESC, true)
            ->reject(function ($path) {
                return $this->isExcluded($path);
            })
            ->each(function ($path) use ($baseUrl, $sitemap, $jigsaw) {
                $url = rtrim($baseUrl, '/') . $path;
                $lastModified = time(); // @todo create proper last modified date generator
                $sitemap->addItem($url, $lastModified, Sitemap::MONTHLY);
            });

        $sitemap->write();
    }

    /**
     * @param string $path
     * @return bool
     */
    private function isExcluded(string $path): bool {
        return str_is($this->exclude, $path);
    }
}
