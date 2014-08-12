var App = (function() {
	var $window = $(window);
	var $header = $('.main-header');
	var $footer = $('.main-footer');
	var $slideshow = $('#slideshow');
	var $main = $('main');

	return {
		//If slider is only child of main element
		//Calculate it's height as window 100% height - (header + footer) height
		//Else we calculate 100% - header heigth, also adding the static-footer class to main footer
		slideshowInit: function() {
			$slideshow.height( $window.height() - $header.height() );
			$footer.addClass('static-footer');
		},
		init: function() {
			if ($main.children().length == 1 && $main.children().filter('.slideshow')[0]) {
				$main.addClass('full-screen');
			} else {
				this.slideshowInit();

				//Align slider on resize
				$(window).resize( function() {
					App.slideshowInit();
				});
			}
		}
	};
})();

jQuery.fn.tabs = function(control) {
	var element = $(this);
	control = $(control);

	element.delegate('li > span', 'click', function(){
		//Извлечение имени вкладки
		var tabName = $(this).parent().data('tab');

		//Запуск пользовательского события при щелчке на вкладке
		element.trigger("change.tabs", tabName);
	});

	//Привязка к пользовательскому событию
	element.bind('change.tabs', function(e, tabName){
		element.find('li > span').parent().removeClass('active');
		element.find('>[data-tab="' + tabName + '"]').addClass('active');
	});

	element.bind('change.tabs', function(e, tabName) {
		control.find('>[data-tab]').removeClass("active");
		control.find('>[data-tab="' + tabName + '"]').addClass("active");
	});

	$('#tabs').bind('change.tabs', function(e, tabName) {
		window.location.hash = tabName;
	});

	$(window).bind('hashchange', function(){
		var tabName = window.location.hash.slice(1);
		$('#tabs').trigger('change.tabs', tabName);
	});

	//Активация первой вкладки
	var garant = element.find('li:first').attr('data-tab');
	element.trigger('change.tabs', garant);
	return this;
};

$("ul#tabs").tabs("#tabContent");
App.init();
