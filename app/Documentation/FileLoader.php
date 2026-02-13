<?php

namespace App\Documentation;

use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\Filesystem;
use Kurenai\DocumentParser;

class FileLoader
{
    /**
     * The Application implementation.
     */
    protected Application $app;

    /**
     * The cache repository implementation.
     */
    protected mixed $cache;

    /**
     * The filesystem implementation.
     */
    protected Filesystem $files;

    /**
     * Construct a new File loader.
     */
    public function __construct(Application $app, Cache $cache, Filesystem $files)
    {
        $this->app   = $app;
        $this->cache = $cache->driver('file');
        $this->files = $files;
    }

    /**
     * Get documentation by version and filename.
     *
     * @throws FileNotFoundException
     */
    public function getDocumentation(string $path, string $filename): array
    {
        if ($this->files->isDirectory("{$path}/src/{$filename}")) {
            $filename = "{$filename}/index";
        }

        $toc      = "{$path}/table-of-content.md";
        $document = "{$path}/{$filename}.md";

        return [
            $this->getTableOfContent($toc),
            $this->getBodyContent($document),
        ];
    }

    /**
     * Get table of content.
     */
    protected function getTableOfContent(string $toc): mixed
    {
        return $this->loadContent($toc);
    }

    /**
     * Get content body.
     */
    protected function getBodyContent(string $document): mixed
    {
        return $this->loadContent($document);
    }

    /**
     * Load content.
     */
    protected function loadContent(string $file): mixed
    {
        $this->validateFileDoesExist($file);

        $content = $this->files->get($file);

        return $this->getParser()->parse($content);
    }

    /**
     * Validate if file does exist.
     *
     * @throws FileNotFoundException
     */
    protected function validateFileDoesExist(string $file): void
    {
        if (! $this->files->exists($file)) {
            throw new FileNotFoundException();
        }
    }

    /**
     * Get markdown document parser.
     */
    protected function getParser(): DocumentParser
    {
        return $this->app->make(DocumentParser::class);
    }
}
