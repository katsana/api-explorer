<?php

namespace App\Http\Controllers;

use App\Documentation\Viewer;
use Kurenai\Contracts\Document;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DocumentationController extends Controller
{
    /**
     * Show documentation.
     *
     * @param  \App\Documentation\Viewer  $processor
     * @param  string   $version
     * @param  string   $filename
     *
     * @return mixed
     */
    public function index(Viewer $processor, $version = 'v1')
    {
        return $this->show($processor, $version, 'index');
    }

    /**
     * Show documentation.
     *
     * @param  \App\Documentation\Viewer  $processor
     * @param  string   $version
     * @param  string   $filename
     *
     * @return mixed
     */
    public function show(Viewer $processor, $version = 'v1', $filename = 'index')
    {
        return $processor->show($this, $version, $filename);
    }

    /**
     * Redirect.
     *
     * @param  string  $to
     *
     * @return mixed
     */
    public function redirectDocumentation($to)
    {
        return redirect($to, 301);
    }

    /**
     * Display documentation.
     *
     * @param  string  $version
     * @param  \Kurenai\Document  $toc
     * @param  \Kurenai\Document  $document
     * @param  \App\Documentation\Viewer $processor
     *
     * @return mixed
     */
    public function showDocumentation($version, Document $toc, Document $document, Viewer $processor)
    {
        return view('documentation', [
            'toc'      => $toc,
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
     * @param \Illuminate\Contracts\Filesystem\FileNotFoundException  $e
     * @param string  $version
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function documentationNotFound(FileNotFoundException $e, $version)
    {
        throw new NotFoundHttpException();
    }

}
