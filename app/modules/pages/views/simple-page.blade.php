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
        <h1>
            {{ @is_object($page->meta->seo) && $page->meta->seo->h1 ? $page->meta->seo->h1 : $page->title }}
        </h1>

        @if (@is_object($page->blocks) && $page->blocks->count())
            <section class="sect-wrap">
                {{ Helper::ta_($page->blocks) }}
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