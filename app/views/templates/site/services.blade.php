@extends(Helper::layout())


@section('style')
@stop


@section('content')

    {{ $page->block('content') }}

    {{ $page->block('seo') }}

@stop


@section('scripts')
@stop