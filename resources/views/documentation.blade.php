@extends('template.main')

@section('sidebar')
{!! $html['toc'] !!}
@stop

@section('content')
<h1>{{ $document->get('title') }}</h1>
{!! $html['document'] !!}

<script>
@unless(is_null($user))
  app.$set('user', $user)
@endunless
</script>
@stop
