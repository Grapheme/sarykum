<?
#$data = Dic::valueBySlugs('news_type', 'spa');
#Helper::tad($data);
$news = News::where('type_id', Dic::valueBySlugs('news_type', 'spa')->id)
    ->with('meta.photo')
    ->orderBy('published_at', 'DESC')
    ->take(3)->get();
#Helper::tad($news);
?>

@extends(Helper::layout())


@section('style')
@stop


@section('content')

    <main role="main">
        <div class="slideshow" id="slideshow">
            <div class="slide">
                <div class="slide-bg" style="background-image: url(img/slides/spa-01.jpg);"></div>
                <section class="slide-cont">

                    {{ $page->block('slide-cont') }}

                </section>
            </div>
            <div class="arrow arrow-left"><span class="icon icon-angle-left"></span></div>
            <div class="arrow arrow-right"><span class="icon icon-angle-right"></span></div>
        </div>
        <section class="sect-wrap spa">

            {{ $page->block('description') }}

        </section>
        <section class="sect-wrap tabs-sect">

            {{ $page->block('service_menu') }}

            <ul id="tabContent" class="tab-content">
                <li class="tab-li" data-tab="firm">

                    {{ $page->block('service_1') }}

                </li>
                <li class="tab-li" data-tab="snack">

                    {{ $page->block('service_2') }}

                </li>
                <li class="tab-li" data-tab="salad">

                    {{ $page->block('service_3') }}

                </li>
                <li class="tab-li" data-tab="bar">

                    {{ $page->block('service_4') }}

                </li>
                <li class="tab-li" data-tab="desert">

                    {{ $page->block('service_5') }}

                </li>
            </ul>
        </section>

        @if (@count($news))
        <section class="sect-wrap square-list-sect">

            <ul class="square-ul clearfix">

                @foreach ($news as $new)
                <?
                $photo = @is_object($new->meta->photo) ? $new->meta->photo->thumb() : false;
                ?>
                <li class="square-li">
                    <a href="#"></a>
                    <div class="square-li-img" style="background-image: url({{ $photo }});"></div>
                    <span>{{ $new->meta->title }}</span>
                </li>
                @endforeach

                @if (0)
                <li class="square-li">
                    <a href="#"></a>
                    <div class="square-li-img" style="background-image: url(img/lists/04.jpg);"></div>
                    <span>Спецпредложение для пар</span>
                </li>
                <li class="square-li">
                    <a href="#"></a>
                    <div class="square-li-img" style="background-image: url(img/lists/05.jpg);"></div>
                    <span>Скидки до 50%</span>
                </li>
                <li class="square-li">
                    <a href="#"></a>
                    <div class="square-li-img" style="background-image: url(img/lists/06.jpg);"></div>
                    <span>Шоколадный скраб для тела</span>
                </li>
                @endif
            </ul>

        </section>
        @endif

        <section class="sect-wrap mini-footer">
            <header>
                <div class="small-logo">
                    
                </div> 1000 и 1 ночь
            </header>
            <div class="call">
                Вопросы администратору<br>
                Вы можете задать по телефону
                <a href="tel:+74958944455">+7 495 894 44 55</a>
            </div>
        </section>
    </main>

@stop


@section('scripts')
@stop