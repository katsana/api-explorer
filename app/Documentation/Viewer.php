<?php

namespace App\Documentation;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;
use Kurenai\Document;

class Viewer
{
    /**
     * Base path.
     */
    protected string $basePath;

    /**
     * Configuration repository instance.
     */
    protected Config $config;

    /**
     * Documentation file loader instance.
     */
    protected FileLoader $loader;

    /**
     * Construct a new documentation processor.
     */
    public function __construct(Application $app, Config $config, FileLoader $loader)
    {
        $this->basePath = $app->basePath();
        $this->config   = $config;
        $this->loader   = $loader;
    }

    /**
     * Show a documentation.
     */
    public function show(object $listener, string $version, string $filename = 'index'): mixed
    {
        $path = $this->getDocumentationPath($version);

        try {
            [$toc, $document] = $this->loader->getDocumentation($path, $filename);
        } catch (FileNotFoundException $e) {
            return $listener->documentationNotFound($e, $version);
        }

        $redirect = $document->get('see');

        if (! is_null($redirect)) {
            $redirect = $this->parseContent($redirect, $version);

            if (! Str::startsWith($redirect, 'http')) {
                $redirect = url($redirect);
            }

            return $listener->redirectDocumentation($redirect, $this);
        }

        return $listener->showDocumentation($version, $toc, $document, $this);
    }

    /**
     * Parse HTML/Content from markdown.
     */
    public function parseMarkdown(Document $content, string $version): string
    {
        $content->setContent($this->parseContent($content->getContent(), $version));

        return $content->getHtmlContent();
    }

    /**
     * Parse HTML/Content from string.
     */
    public function parseContent(string $content, string $version): string
    {
        $replacement = [
            '{doc-url}' => url($version),
            '{asset-url}' => asset(''),
        ];

        return Str::replace(array_keys($replacement), array_values($replacement), $content);
    }

    /**
     * Get documentation base path.
     */
    protected function getDocumentationPath(string $version): string
    {
        return "{$this->basePath}/docs/{$version}";
    }
}
