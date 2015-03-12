@extends(Helper::layout())


@section('style')
@stop


@section('content')

    <main role="main">

        {{ $page->block('header') }}

        <section class="sect-wrap sect-services">

            {{ is_object($page->meta) && is_object($page->meta->seo) ? '<h1 class="text-center">' . $page->meta->seo->h1 . '</h1>' : '' }}

            {{ $page->block('content') }}

        </section>

    </main>

    {{ $page->block('seo') }}

@stop


@section('scripts')
@stop