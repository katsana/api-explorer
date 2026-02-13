<?php

namespace App\Http\Controllers;

use App\Documentation\Viewer;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Kurenai\Contracts\Document;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentationController extends Controller
{
    /**
     * Show documentation index.
     */
    public function index(Viewer $processor, string $version = 'v1'): mixed
    {
        return $this->show($processor, $version, 'index');
    }

    /**
     * Show documentation page.
     */
    public function show(Viewer $processor, string $version = 'v1', string $filename = 'index'): mixed
    {
        return $processor->show($this, $version, $filename);
    }

    /**
     * Redirect to documentation page.
     */
    public function redirectDocumentation(string $to): mixed
    {
        return redirect($to, 301);
    }

    /**
     * Display documentation.
     */
    public function showDocumentation(string $version, Document $toc, Document $document, Viewer $processor): mixed
    {
        return view('documentation', [
            'toc'      => $toc,
            'user'     => null,
            'document' => $document,
            'version'  => $version,
            'html'     => [
                'toc'      => $processor->parseMarkdown($toc, $version),
                'document' => $processor->parseMarkdown($document, $version),
            ],
        ]);
    }

    /**
     * Handle documentation not found.
     *
     * @throws NotFoundHttpException
     */
    public function documentationNotFound(FileNotFoundException $e, string $version): never
    {
        throw new NotFoundHttpException();
    }
}
