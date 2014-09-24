@extends(Helper::layout())


@section('style')
<style>
.action-img {
    background-repeat: no-repeat;
}
.sect-wrap.restaurant:after {
    background-image: none !important;
}
</style>
@stop


@section('content')

    <main role="main">
        <section class="sect-wrap actions-wrap">

            <h1>{{ trans("interface.title.actions") }}</h1>

            {{ $page->block('actions') }}

        </section>
    </main>

@stop


@section('scripts')
@stop