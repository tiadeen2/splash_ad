<?php
$css  = '<link rel="stylesheet" type="text/css" href="splash_style.css" charset="utf-8" />';

$html = <<< HTML
<div id="splash">
  <div class="splash-header">
    <a href="#hide">クリックで閉じる（<span class="skip-time">10秒後に自動的に閉じる</span>）</a>
  </div><!-- .splash-header -->
  <div class="splash-content">
    広告とか表示しちゃう部分<br />
    特に表示するものもないので画像でも表示しておく。<br />
    <a href="https://www.flickr.com/photos/tiadeen2/11729881214/in/photostream/" target="_blank"><img src="eiffel.jpg" alt="エッフェル塔画像"/></a>
  </div><!-- .splash-content -->
</div><!-- .splash -->
HTML;

$js = <<< JS_CODE
var g_splashed = false;
var g_interval = 10;
var g_time = setInterval(function(){
	g_interval--;
	if (g_interval < 0) g_interval = 0;
	$("span.skip-time").html(g_interval +"秒後に自動的に閉じる");
	
	if (g_interval == 0 && ! g_splashed) {
		hideSplash();
	}
}, 1000);

$(".splash-header a").click(hideSplash);

function hideSplash() {
	clearInterval(g_time);
	g_splashed = true;
	$("#container").show();
	$("#splash").hide();
	return false;
}
JS_CODE;

header("Content-type: text/javascript; charset=utf-8");
echo "document.write('". preg_replace("/'/", "\\'", $css) ."');";
$html = preg_replace("/[\r\n]/", "", $html); // 改行不可
echo "document.write('". preg_replace("/'/", "\\'", $html) ."');";
echo "\n";
echo $js;
