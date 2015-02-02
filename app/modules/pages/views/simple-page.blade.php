@extends(Helper::layout())


@if (@is_object($page->meta->seo))
@section('title'){{ $page->meta->seo->title }}@stop
@section('description'){{ $page->meta->seo->description }}@stop
@section('keywords'){{ $page->meta->seo->keywords }}@stop
@else
@section('title')
    {{{ $page->meta->title }}}@stop
@section('description')
    {{{ striptags($page->meta->preview) }}}@stop
@endif

@section('style')
@stop


@section('content')
    <main>

        @if (@is_object($page->blocks) && $page->blocks->count())

            {{ Helper::ta_($page->blocks) }}

            <section class="sect-wrap">

                <h1>
                    {{ @is_object($page->meta->seo) && $page->meta->seo->h1 ? $page->meta->seo->h1 : $page->title }}
                </h1>

                @foreach($page->blocks as $block)
                    @if (is_object($block->meta))
                        {{ $block->meta->content }}
                    @endif
                @endforeach
            </section>
        @endif

    </main>
@stop


@section('scripts')
@stop