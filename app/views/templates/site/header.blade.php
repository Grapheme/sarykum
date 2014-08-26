<?
$route = Route::currentRouteName();
#Helper::dd($page);
?>
        <div class="wrapper">
            <header class="main-header">
                <h1 class="logo">
                    Sarykum hotel and spa
                </h1>
                <nav>
                    <ul class="nav-ul">
                        <li class="nav-li">
                            <a data-hover="Номера" href="{{ URL::route('page', 'rooms') }}">
                                <span>Номера
                            </a>
                        <li class="nav-li">
                            <a data-hover="SPA" href="{{ URL::route('page', 'spa') }}">
                                <span>SPA
                            </a>
                        <li class="nav-li">
                            <a data-hover="Ресторан" href="{{ URL::route('page', 'restaurant') }}">
                                <span>Ресторан
                            </a>
                        <li class="nav-li">
                            <a data-hover="Discover Dagestan" href="{{ URL::route('page', 'discover') }}">
                                <span>Discover Dagestan
                            </a>
                        <li class="nav-li">
                            <a data-hover="Услуги" href="{{ URL::route('page', 'services') }}">
                                <span>Услуги</span>
                            </a>
                        <li class="nav-li">
                            <a data-hover="Акции" href="{{ URL::route('page', 'actions') }}">
                                <span>Акции
                            </a>
                    </ul>
                </nav>
                <div class="booking" id="bookBtn">
                    Бронировать <span class="icon icon-angle-right"></span>
                    <div class="booking-form">
                        <div class="form-success">
                            Ваша бронь успешно отправлена администратору
                        </div>

                        {{ Form::open(array('url' => URL::route('ajax-reserve-room'), 'class' => 'smart-form', 'id' => 'reserve-form', 'role' => 'form', 'method' => 'POST')) }}
                            <fieldset class="date-data">
                                <section>
                                    <header>
                                        Выберите номер и дату
                                    </header>
                                    <div class="inline">
                                        {{ Form::select('room_type', Dic::whereSlugValues('room_type')->lists('name', 'id')) }}
                                    </div>
                                    <section class="datepickerFrom inline">
                                        с
                                        {{ Form::text('date_start', null, array('id' => 'datepickerFrom', 'class' => 'datepicker')) }}
                                    </section>
                                    <section class="datepickerTo inline">
                                        по
                                        {{ Form::text('date_stop', null, array('id' => 'datepickerTo', 'class' => 'datepicker_')) }}
                                    </section>
                                </section>
                            </fieldset>
                            <fieldset class="text-data">
                                <section>
                                    <header>
                                        Представьтесь
                                    </header>
                                    <div class="inline">
                                        {{ Form::text('name', null, array('placeholder' => 'Представьтесь')) }}
                                    </div>
                                    <div class="inline">
                                        {{ Form::text('contact', null, array('placeholder' => 'Телефон или email')) }}
                                    </div>
                                </section>
                            </fieldset>
                            <fieldset>
                                <section>
                                    <div class="price inline">
                                        Стоимость услуги за сутки: <span>4500 руб.</span>
                                    </div>                                                                        
                                    <button type="submit" class="btn bordered inline">
                                        Забронировать
                                    </button> 
                                </section>
                            </fieldset>                                                   

                        {{ Form::close() }}

                    </div>
                </div>
                <div class="phone">
                    <a href="tel:+34560052222">
                        <span class="icon icon-phone"></span> +34 56 005 22 22
                    </a>
                </div>
                <div class="lang">
                    <ul class="lang-ul">
                        <li class="lang-li">
                            <a href="#">EN</a>
                        </li>
                        <li class="lang-li">
                            <a href="#">RU</a>
                        </li>
                    </ul>
                </div>                
            </header>