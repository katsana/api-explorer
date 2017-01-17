@extends('template.main')

@section('sidebar')
{!! $toc->getHtmlContent() !!}
@stop

@section('content')
<h1>{{ $document->get('title') }}</h1>
{!! $document->getHtmlContent() !!}
@stop
