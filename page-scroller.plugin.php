<?php

Plugin::register(
    __FILE__,
    __('Page Scroller', 'page-scroller'),
    __('Simple page scroller plugin for Monstra', 'page-scroller'),
    '1.0.0',
    'Sergiy Tkach / DevApromix',
    'https://github.com/devapromix-monstra/page-scroller'
);

Action::add('theme_header', 'PageScroller::headerCSS');
Action::add('theme_header', 'PageScroller::headerJS');
Action::add('theme_pre_content', 'PageScroller::contentHTML');
Action::add('theme_footer', 'PageScroller::footerJS');

class PageScroller {

    public static function headerCSS(){
        echo ('
		<style type="text/css">
		.top_up {
			display: block;
			position: fixed;
			right: 5px;
			bottom: 5px;
			z-index: 99;
			margin: 0;
			width: 48px;
			height: 48px;
			background: #666 url("'.Option::get('siteurl').'/plugins/page-scroller/images/arrow_up.png") center center no-repeat;
			border-radius: 4px;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			-o-border-radius: 4px;
			opacity: 0.1;
			transition: opacity 0.15s ease-in-out 0s !important;
			-webkit-transition: opacity 0.15s ease-in-out 0s !important;
			-moz-transition: opacity 0.15s ease-in-out 0s !important;
			-o-transition: opacity 0.15s ease-in-out 0s !important;
		}
		.top_up:hover {
			opacity: 0.5;
		}		
		</style>
		');
    }

	public static function contentHTML() {
		echo '<a class="top_up" href="#"></a>';
	}
	
	public static function headerJS() {
        echo '<script type="text/javascript" src="'.Option::get('siteurl'). '/public/assets/js/jquery.min.js"></script>';
	}

	public static function footerJS() {
        echo ('
		<script type="text/javascript">
		$(document).ready(function(){
			$(window).scroll(function(){
				if ($(this).scrollTop() >= 100) {
					$(\'.top_up\').fadeIn();
				} else {
					$(\'.top_up\').fadeOut();
				}
			}); 
			$(\'.top_up\').click(function(){
				$("html, body").animate({ scrollTop: 0 }, 600);
				return false;
			}); 
		});
		</script>
		');
    }

}
