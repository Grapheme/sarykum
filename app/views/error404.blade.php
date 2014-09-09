<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
 <head>
	@include('templates.default.head')
	@yield('style')
</head>
<body>
	<!--[if lt IE 7]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	@include('templates.default.header')

    <main>
        <div class="slideshow">
            <div class="slide">
                <div class="slide-bg" style="background-image: {{asset('theme/img/404bg.jpg')}};"></div>
                <section class="slide-cont" style="margin-top: 15.1%;">
                    <header>
                        <div class="slide-logo" style="background: url({{asset('theme/img/404.png')}}); width: 215px; height: 96px;">
                            
                        </div>
                        <h2 class="slide-head" style="margin-bottom: 0;">
                            ОШИБКА
                        </h2>
                        <div class="desc"></div>
                    </header>
                    <div class="slide-desc">
                        Запрашиваемая вами страница не существует.<br>
                        Вернитесь на <a href="/">главную</a>
                    </div>
                </section>
            </div>
            <div class="arrow arrow-left"><span class="icon icon-angle-left"></span></div>
            <div class="arrow arrow-right"><span class="icon icon-angle-right"></span></div>
        </div>
    </main>

	@include('templates.default.footer')
	@include('templates.default.scripts')
	@yield('scripts')
</body>
</html>