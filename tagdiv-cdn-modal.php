<?php
/**
 * Plugin Name: Newspaper tagDiv CDN modal image enabler
 * Description: Enable the modal image when using a CDN in the tagDiv Newspaper theme - switch off global modal image in settings.
 * Author: Giacomo Lawrance
 * Author URI: https://giacomolaw.me
 * Version: 1.0
 * Text Domain: tagdiv-cdn-modal
 *
 */

// td modal img on all images
function add_responsive_class($content){
	$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
	$document = new DOMDocument();
	libxml_use_internal_errors(true);
	$document->loadHTML(utf8_decode($content));
	$imgs = $document->getElementsByTagName('img');
	foreach ($imgs as $img) {
		$existing_class = $img->getAttribute('class');
		$img->setAttribute('class', "td-modal-image $existing_class");
	}
	$html = $document->saveHTML();
	return $html;
}
add_filter('the_content', 'add_responsive_class');