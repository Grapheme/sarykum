@extends(Helper::layout())


@section('style')
<style>
.services.what2look {
    background-image: none;
}
</style>
@stop


@section('content')

    @if (Input::get('dbg-page'))
        {{ Helper::tad($page) }}
    @endif


    <main role="main">
        {{ $page->block('header') }}

        <section class="sect-wrap discover margin-bottom-40">
            {{ is_object($page->meta) && is_object($page->meta->seo) ? '<h1 class="text-center">' . $page->meta->seo->h1 . '</h1>' : '' }}
        </section>

        {{ $page->block('content') }}
    </main>


    {{ $page->block('seo') }}

@stop


@section('scripts')
@stop
