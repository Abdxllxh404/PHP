
/* developerthai.com */

function sideMenu() {
	var show = false;
	var el = $('.side-menu-toggle i');
	var bar = 'fas fa-bars';		   //=
	var times = 'fas fa-times';	//x
			
	$('.side-menu-toggle').click(function(e) {
		e.preventDefault();						
		$('.side-menu').toggleClass('show');
		show = !show;
		//สลับ = กับ x
		if (show) {
			el.removeClass(bar).addClass(times);
		} else {
			el.removeClass(times).addClass(bar);
		}
	});
			
	$('.side-menu a').click(function(event) {
		if ($(this).next('ul').length) {		//ถ้ามีเมนูย่อย
			event.preventDefault();
			$(this).next().toggle('fast');
			$(this).children('i:last-child').toggleClass('fa-caret-down fa-caret-left');
		}
	});	
}