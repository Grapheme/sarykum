<?
$buttons = '<span class="buttons">
    <a class="btn btn-default edit_parameter"><i class="fa fa-pencil fa-fw"></i></a>
    <a class="btn btn-default delete_parameter"><i class="fa fa-trash-o fa-fw"></i></a>
</span>';
$buttons = preg_replace("~[\r\n]~is", '', $buttons);
?>
@extends(Helper::acclayout())



@section('style')
<style>
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th,
    .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        vertical-align: middle;
    }
    th span.buttons {
        display: none;
    }
    th:hover span.buttons {
        display: block;
    }

    button.loading:before {
        display: inline-block;
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        -webkit-animation: spin 2s infinite linear;
        -moz-animation: spin 2s infinite linear;
        -o-animation: spin 2s infinite linear;
        animation: spin 2s infinite linear;
        position: relative;
        content: "\f110";
        left: -0.9375rem;
        margin-right: 0.3125rem;
    }
</style>
@stop

@section('content')

    <main class="content">

<?
#Helper::d($dirs);
#Helper::d("FILES");
#Helper::d($files);
#Helper::d("ALL_FILES");
#Helper::d($all_files);
$need_set_rights = false;
foreach ($files as $dir => $dir_files) {
    if (!is_dir($dir) || !is_writable($dir)) {
        $need_set_rights = true;
        break;
    } else {
        foreach ($all_files as $file => $null) {
            $full_filename = $dir . '/' . $file;
            if (!file_exists($full_filename) || !is_writable($full_filename)) {
                $need_set_rights = true;
                break(2);
            }
        }
    }
}
?>

        <h1>Редактор языковых файлов</h1>

        @if ($need_set_rights)
        <div class="alert alert-warning fade in">
            <i class="fa-fw fa fa-warning"></i>
            <strong>Внимание!</strong> Необходимо выставить права на запись всем файлам и директориям внутри папки /lang.<br/>
            Для этого подключитесь к серверу по SSH и из корня приложения выполните команду: chmod -R 777 app/lang/
        </div>
        @else

        <div class="row margin-top-10">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                {{ Form::open(array('url' => URL::action($module['class'].'@postSaveLocales'), 'class' => 'smart-form2', 'id' => 'locale-form', 'role' => 'form', 'method' => 'POST')) }}

                <table class="table tbl_header" style="margin-bottom: 0;">
                    <thead>
                    <tr class="" style="width:100%;">
                        <th class="text-center" style="width:250px;" rowspan="1">#</th>
                        @foreach ($dirs as $dir)
                        <th class="text-center locale_row" style="width:*">
                            {{--
                            is_writable($dir)
                            ? '<i class="fa fa-check" title="Dir is writable"></i>'
                            : '<i class="fa fa-times" title="Dir is non-writable"></i>'
                            --}}
                            {{-- mb_strtoupper(basename($dir)) --}}
                            {{ @$locales[basename($dir)] ?: mb_strtoupper(basename($dir)) }}
                        </th>
                        @endforeach
                    </tr>
                    {{--
                    <tr>
                        <td></td>
                        @foreach ($dirs as $dir)
                        <th class="text-center" style="border-bottom: 0;">
                            <div class="alert alert-warning fade in" style="margin:0;">{{ Form::checkbox('del') }} удалить</div>
                        </th>
                        @endforeach
                    </tr>
                    --}}
                    </thead>
                </table>

                @if (count($all_files))
                @foreach($all_files as $file => $null)

                <?
                $classes = array();
                foreach ($dirs as $dir) {
                    $exists = isset($files[$dir][$dir.'/'.$file]);
                    $writable_dir = is_writable($dir);
                    $writable_file = is_writable($dir.'/'.$file);
                    $classes[basename($dir)] = $exists ? 'success' : 'danger';
                }
                ?>

                <div class="alert alert-info fade in file_name" style="margin-bottom: 0;">
                    {{ mb_strtoupper($file) }}
                </div>

                <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0;">
                    <tbody>

                            <?
                            $file_short = mb_substr($file, 0, mb_strpos($file, '.'));
                            $vars = array();
                            $all_vars = array();
                            foreach ($dirs as $dir) {
                                $file_vars = file_exists($dir.'/'.$file) ? include($dir.'/'.$file) : array();
                                $vars[basename($dir)] = $file_vars;
                                $all_vars = $all_vars + ($file_vars);
                                #Helper::d(array_keys($file_vars));
                            }
                            #Helper::d($vars);
                            #Helper::d($all_vars);
                            ksort($all_vars);
                            ?>
                            @foreach ($all_vars as $var => $null)
                            <tr data-file="{{ $file }}" data-name="{{ $var }}">
                                <th>
                                    {{--<i class="fa fa-copy" data-code="trans('{{ $file_short }}.{{ $var }}')"></i>--}}
                                    <span>
                                        {{ $var }}
                                    </span>
                                    {{ $buttons }}
                                </th>
                                @foreach ($dirs as $dir)
                                <?
                                $class = $classes[basename($dir)];
                                if (!isset($vars[basename($dir)][$var]))
                                    $class = 'danger';
                                elseif ($vars[basename($dir)][$var] == '')
                                    $class = 'warning';
                                ?>
                                <td class="text-center {{ $class }}">
                                    {{ Form::textarea('lang[' . basename($dir) . '][' . $file . '][' . $var . ']', @htmlspecialchars($vars[basename($dir)][$var]), array('rows' => 3, 'style' => 'width:100%')) }}
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                            <tr>
                                <td class="text-left">
                                    <a href="#" class="btn btn-default btn-warning add_parameter" style="display: block" data-locale="{{ basename($dir) }}" data-file="{{ basename($file) }}">
                                        <i class="fa fa-plus"></i>
                                        Добавить
                                    </a>
                                </td>
                                <td colspan="99"></td>
                            </tr>
                    </tbody>
                </table>
                @endforeach
                @endif

                <fieldset class="padding-top-10">
                    <button class="btn btn-primary btn-lg submit">
                        <i class="fa fa-save"></i>
                        Сохранить
                    </button>
                </fieldset>

                {{ Form::close() }}

            </div>
        </div>
        @endif

    </main>

@stop


@section('scripts')
{{ HTML::script("js/vendor/jquery-form.min.js") }}
<script>

    $('.add_parameter').click(function(){
        //alert('123');
        var name = prompt('Введите имя переменной', 'default.name');
        var file = $(this).data('file');
        if ( $('[data-file="' + file + '"] [data-name="' + name + '"]').data('name') ) {
            $(this).trigger('click');
            return false;
        }
        //alert(name + ' | ' + typeof name);
        if (name) {
            var line = "<tr data-file='" + file + "' data-name='" + name + "'><th class='warning'><span>" + name + '</span>{{ $buttons }}' + "</td>@foreach($dirs as $dir)<td class='danger'><textarea name='lang[{{ basename($dir) }}][" + file + "][" + name + "]' rows='3' style='width:100%'></textarea></td>@endforeach</tr>";
            $(this).parents('tr').before(line);
        }
        return false;
    });

    $(document).on('click', '.delete_parameter', function(){
        var $this = this;
        $.SmartMessageBox({
            title : "Удалить параметр из всех языковых версий?",
            content : "",
            buttons : '[Нет][Да]'
        },function(ButtonPressed) {
            if(ButtonPressed == "Да") {
                $($this).parents('tr').slideUp().remove();
            }
        });
    });

    $(document).on('click', '.edit_parameter', function(){
        var name = $(this).parents('tr').attr('data-name');
        var new_name = prompt('Введите имя переменной', name);
        if (typeof(new_name) == 'string' && new_name != '' && new_name != name) {
            $(this).parents('tr').attr('data-name', new_name);
            $(this).parents('th').find('span:first').text(new_name);
            $(this).parents('tr').find('td').each(function(){
                var ta = $(this).find('textarea[name*="' + name + '"]');
                if (ta) {
                    var new_ta_name = $(ta).attr('name').split(name).join(new_name);;
                    $(ta).attr('name', new_ta_name);
                }
            });
        }
        return false;
    });


    $(document).on('submit', '#locale-form', function(e, selector, data) {

        //return true;

        e.preventDefault();

        var form = $(this);

        var options = { target: null, type: $(form).attr('method'), dataType: 'json' };

        options.beforeSubmit = function(formData, jqForm, options){
            $(form).find('button.submit').addClass('loading');
            //$('.error').text('').hide();
        }

        options.success = function(response, status, xhr, jqForm){
            //console.log(response);
            //$('.success').hide().removeClass('hidden').slideDown();
            //$(form).slideUp();

            if (response.status) {
                showMessage.constructor('Сохранение', 'Успешно сохранено');
                showMessage.smallSuccess();

                $.ajax({
                    url: "{{ URL::action($module['class'].'@getList') }}",
                    type: 'GET',
                    success: function(response, textStatus, xhr){
                        $('main.content').parent().html(response);
                    },
                    error: function(xhr,textStatus,errorThrown){
                    }
                });

            } else {
                showMessage.constructor('Ошибка при сохранении', response.responseText);
                showMessage.smallError();
            }

        }

        options.error = function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }

        options.complete = function(data, textStatus, jqXHR){
            $(form).find('button.submit').removeClass('loading');
        }

        $(form).ajaxSubmit(options);

        return false;
    });

    // Global header with locales name/sign position
    var header = $(".tbl_header");
    var header_top = $(header).offset().top;
    var header_height = parseInt($(header).css('height'), 10);
    var header_next_margin_top = parseInt($(header).next().css('margin-top'), 10);
    var width = $(header).css('width');
    $(window).scroll(function() {

        if ( header_top < $(window).scrollTop() ) {
            $(header).css('max-width', width).css('position', 'fixed').css('top', '0');
            $(header).next().css('margin-top', header_next_margin_top + header_height + 'px');
        } else {
            $(header).css('position', 'static');
            $(header).next().css('margin-top', header_next_margin_top + 'px');
        }

        /********************************************************************************/

        /*
         * NEED TO WORK
         */
        if (0) {

            var prev_file_name = $('.file_name:first');
            var global_break = false;
            $('.file_name').each(function(){

                if (global_break)
                    return;

                var prev_file_block_top = prev_file_name ? $(prev_file_name).offset().top : false;
                var file_block_top = $(this).offset().top;

                console.log(
                    (
                        parseInt(prev_file_block_top)-parseInt($(window).scrollTop())
                        )
                        + " | " +
                        (
                            parseInt(file_block_top)-parseInt($(window).scrollTop())
                            )
                );

                if (
                    parseInt(prev_file_block_top)-parseInt($(window).scrollTop()) < 0
                    && parseInt(file_block_top)-parseInt($(window).scrollTop()) > 0
                ) {
                    console.log($(prev_file_name).text());
                } else {
                    console.log($(this).text());
                }

                //if ( file_block_top < $(window).scrollTop() ) {
                prev_file_name = $(this);
                //}

                //global_break = true;

            });
            //console.log($(prev_file_name).text());
        }

    });

    // Width of the TH with locale name/sign
    var locale_row_width = (parseInt($('.tbl_header').css('width'), 10) - parseInt($('.tbl_header th:first').css('width'), 10)) / {{ count($dirs) }};
    $('.locale_row').css('width', locale_row_width);

    // Width of first TH of the table with parameters
    $('[data-file][data-name] th').css('width', 250);

</script>
@stop
