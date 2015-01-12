@extends(Helper::layout())


@section('style')
@stop


@section('content')

    {{ $page->block('slider') }}

    {{ $page->block('seo') }}

@stop


@section('scripts')
@stop