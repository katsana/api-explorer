<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kurenai\Contracts\Document as DocumentContract;
use Kurenai\Contracts\MarkdownParser as MarkdownParserContract;
use Kurenai\Document;
use Kurenai\Parser\ParsedownExtra;

class DocumentationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(DocumentContract::class, Document::class);
        $this->app->bind(MarkdownParserContract::class, ParsedownExtra::class);
    }
}
