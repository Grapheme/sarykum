@extends(Helper::layout())


@section('style')
<style>
.services.what2look {
    background-image: none;
}
</style>
@stop


@section('content')

    <main role="main">
        {{ $page->block('header') }}
        {{ $page->block('content') }}
    </main>


    {{ $page->block('seo') }}

@stop


@section('scripts')
@stop
