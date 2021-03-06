<?php

namespace App\Documentation;

use Kurenai\Document;
use Orchestra\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class Viewer
{
    /**
     * Base path.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Configuration repository instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Documentation file loader instance.
     *
     * @var \App\Documentation\FileLoader
     */
    protected $loader;

    /**
     * Construct a new documentation processor.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  \Illuminate\Contracts\Config\Repository  $config
     * @param  \App\Documentation\FileLoader  $loader
     */
    public function __construct(Application $app, Config $config, FileLoader $loader)
    {
        $this->basePath = $app->basePath();
        $this->config   = $config;
        $this->loader   = $loader;
    }

    /**
     * Show a documentation.
     *
     * @param  object  $listener
     * @param  string  $version
     * @param  string  $filename
     *
     * @return mixed
     */
    public function show($listener, $version, $filename = 'index')
    {
        $path = $this->getDocumentationPath($version);

        try {
            list($toc, $document) = $this->loader->getDocumentation($path, $filename);
        } catch (FileNotFoundException $e) {
            return $listener->documentationNotFound($e, $version);
        }

        $redirect = $document->get('see');

        if (!is_null($redirect)) {
            $redirect = $this->parseContent($redirect, $version);

            ! Str::startsWith($redirect, 'http') && $redirect = handles("app::{$redirect}");

            return $listener->redirectDocumentation($redirect, $this);
        }

        return $listener->showDocumentation($version, $toc, $document, $this);
    }

    /**
     * Parse HTML/Content from markdown.
     *
     * @param  \Kurenai\Document  $content
     * @param  string  $version
     *
     * @return string
     */
    public function parseMarkdown(Document $content, $version)
    {
        $content->setContent($this->parseContent($content->getContent(), $version));

        return $content->getHtmlContent();
    }

    /**
     * Parse HTML/Content from string.
     *
     * @param  string  $content
     * @param  string  $version
     *
     * @return string
     */
    public function parseContent($content, $version)
    {
        $replacement = [
            'doc-url' => url($version),
            'asset-url' => asset(null),
        ];

        return Str::replace($content, $replacement);
    }

    /**
     * Get documentation base path.
     *
     * @param  string  $version
     *
     * @return string
     */
    protected function getDocumentationPath($version)
    {
        return "{$this->basePath}/docs/{$version}";
    }
}
