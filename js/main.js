$(window).load(function(){
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	 	$('.clouds').addClass('hidden');
	}
	$('.logo, .clouds').addClass('loaded');
	var open = false;
	$('.booking').click(function(){
		if(open)
		{
			$(this).removeClass('active');
			$('.nav').removeClass('active');
			$('.container').removeClass('active');
			open = false;
		} else {
			$(this).addClass('active');
			$('.nav').addClass('active');
			$('.container').addClass('active');
			open = true;
		}
	});

	$('body').mousemove(function(e){
	    var amountMovedX = (e.pageX * -1 / 15);
	    var amountMovedY = (e.pageY * -1 / 15);
	    var cloudMovedX = (e.pageX * 1 / 40);
	    var cloudMovedY = (e.pageY * 1 / 40);
	    $('.background').css('background-position', amountMovedX + 'px ' + amountMovedY + 'px');
	    $('.clouds').css('background-position', cloudMovedX + 'px ' + cloudMovedY + 'px');
	});
});
