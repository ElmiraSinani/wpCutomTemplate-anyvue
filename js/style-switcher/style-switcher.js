var directory, enable_style_switcher, default_settings;

$(document).ready(function() {


	/* styler config */
	
	default_settings = {
		color: '#2ac5ed'
	}
	
	enable_style_switcher = false;  /* enable or disable style switcher */
	
	/* end styler config */

	
	$('head').append('<script type="text/javascript" src="js/style-switcher/jquery.cookie.js"></script>');

	
	if(enable_style_switcher){

		var colors_count = 11;
		var template = '<div id="mtp-wrapper"><div id="mtp-toggle" class="highlight-bg"><i class="moon-droplet"></i></div><div id="mtp-header" class="highlight-bg">Style Switcher</div><div id="mtp-content"><div class="mtp-content-title">Base color:</div><span class="mtp-primary-color"></span><input type="text" value="#2773ae" class="mtp-color-field"><ul class="mtp-color clearfix"></ul><div class="clear"></div></div></div>';

		$('body').append($(template));

		$('head').append('<link type="text/css" rel="stylesheet" href="js/style-switcher/styler.css"/><script type="text/javascript" src="js/style-switcher/jquery-ui.min.js"></script><script type="text/javascript" src="js/style-switcher/iris.min.js"></script>');

		for(var i = 0; i < colors_count; i++){
			$("#mtp-wrapper .mtp-color").append('<li class="color_' + i + '"></li>')
		}
		colorSwitcherPosition();

		var initStyler = getThemeSettings();
		if(initStyler) {
			colorPicker(initStyler.color);
		}
		$('#mtp-toggle').click(function(e){
			$('#mtp-wrapper').toggleClass('active');
			e.stopPropagation();
		});
		$('body').click(function(){
			if($('#mtp-toggle').is('.mtp-toggle-close')){
				$('#mtp-wrapper, #mtp-toggle').stop(true, true).animate({'right': '-200px'}, 300);
				setTimeout(function(){
					$('#mtp-toggle').toggleClass('mtp-toggle-close');
				}, 500)
			}
		})
		$('#mtp-wrapper').click(function(e){
			e.stopPropagation();
		})
		$('.mtp-primary-color').click(function(){
			$('.iris-picker').toggle();
		});
		$(".mtp-color li").click(function(){
			var color = rgb2hex($(this).css('background-color'));
			setThemeSettings('color', color);
			changeColor(color);
			$(".mtp-color-field").val(color);
			$('.mtp-color-field').iris('color', color);
		})

	} else {
		var initStyler = getThemeSettings();
		$.cookie('themeSettings', null, { path: '/' });
	}

})
function setThemeSettings(key, value){
	var themeSettings = $.cookie('themeSettings');
	if(!themeSettings) {
        themeSettings = {};
    } else {
        themeSettings = JSON.parse(themeSettings);
    }
	themeSettings[key] = value;

	var s = JSON.stringify(themeSettings);
	$.cookie('themeSettings', s, { path: '/' });
}

function getThemeSettings(){
	if(enable_style_switcher){
		var themeSettings = $.cookie('themeSettings');
        if(!themeSettings) {
            themeSettings = default_settings;
        } else {
            themeSettings = JSON.parse(themeSettings);
        }
	} else {
		var themeSettings = default_settings;
	}

	if(themeSettings['color']) changeColor(themeSettings.color);
	return themeSettings;
}

function changeColor(color){
	$("#styler_color").remove();
    var styles = 'a:hover, ' +
        'a:focus,' +
        '.highlight, ' +
        '.btn-primary, ' +
        '.btn-default, ' +
        '#header .navbar-nav > li > a:hover,' +
        '.navbar-default .navbar-nav>.active>a,' +
        '#filters-container .cbp-filter-item .cbp-filter-counter,' +
        '#grid-container figure figcaption a, ' +
        '#up:hover,' +
        '.tabs2 .nav-tabs>li>a,' +
        '.toggles #accordion3 .panel-default>.panel-heading a,' +
        '.features-list .feature-block.bottom-line .ico,' +
        'button.btn,' +
        '.btn-primary.inverted:hover, ' +
        '.btn-default.inverted:hover,' +
        'button.btn.inverted:hover ' +
        '{color:' + color + ';}' +
        '.highlight-bg,' +
        '.highlight-active-bg.active,' +
        '.btn-primary:hover, ' +
        '.btn-default:hover, ' +
        '#filters-container .cbp-filter-item.cbp-filter-item-active .name,' +
        '.features-list .feature-block .ico,' +
        '#grid-container figure figcaption a:hover,' +
        '#contacts .up-btn, ' +
        '.navbar-default .navbar-nav>li.extra>a,' +
        '.slider-home-block .navigation span.active,' +
        '.progressbars-block .progressbar .skillbar .skillbar-bar,' +
        '.toggles .panel-default>.panel-heading,' +
        '.tabs1 .nav-tabs>li>a,' +
        '.tabs2 .nav-tabs>li.active>a,' +
        '.tabs2 .nav-tabs>li:hover>a,' +
        '.step .step-count,' +
        '.grid .number,' +
        'button.btn:hover,' +
        '#toggles #accordion2 .panel-default>.panel-heading:hover,' +
        '#slider .flex-control-paging li a.flex-active,' +
        '.btn-primary.inverted, ' +
        '.btn-default.inverted,' +
        'button.btn.inverted' +
        '{background-color:' + color + ';}' +
        '.highlight-border, ' +
        '.btn-primary, ' +
        '.btn-default,' +
        '.btn-primary:hover, ' +
        '.btn-default:hover, ' +
        '#filters-container .cbp-filter-item .cbp-filter-counter,' +
        '#grid-container figure figcaption a,' +
        '.tabs2 .nav-tabs>li>a,' +
        'button.btn,' +
        'button.btn:hover,' +
        '#slider .flex-control-paging li a.flex-active,' +
        '#slider .flex-control-paging li a:hover,' +
        '.btn-primary.inverted, ' +
        '.btn-default.inverted,' +
        'button.btn.inverted' +
        '{border-color:' + color + ';}';

	$('head').append('<style type="text/css" id="styler_color">' + styles + '</style>');
    $('.chart').each(function(){
        var cur = $(this);
        if(cur.hasClass('waypoint')){
            cur.removeClass('easyPieChart');
            cur.data({
                'color': color,
                'easyPieChart': ''
            });
            pieChart(cur);
        } else {
            cur.data({
                'color': color
            });
        }
    })
}

function rgb2hex(rgb) {
	rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
	function hex(x) {
		return ("0" + parseInt(x).toString(16)).slice(-2);
	}
	return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function colorSwitcherPosition(){
	var h = $(window).height();
	if(h < $("#mtp-wrapper").height()) {
		$("#mtp-toggle, #mtp-wrapper").addClass('absolute');
	} else {
		$("#mtp-toggle, #mtp-wrapper").removeClass('absolute');
	}
}

function colorPicker(color){
	$('.mtp-color-field').iris({
		palettes: false,
		border: false,
		width: 155,
		color: color,
		mode: 'hsl',
		change: function(event, ui) {
			
			var color = ui.color.toString();
			setThemeSettings('color', color);
			changeColor(color);
			/* Background fix */
			$('.mtp-off .background-block').css( 'background-color', '#f7f7f7');
		}
	});
}
$(window).resize(function(){
	colorSwitcherPosition();
})