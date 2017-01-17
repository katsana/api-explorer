@extends('template.main')

@section('sidebar')
{!! $html['toc'] !!}
@stop

@section('content')
<h1>{{ $document->get('title') }}</h1>
{!! $html['document'] !!}
@stop
