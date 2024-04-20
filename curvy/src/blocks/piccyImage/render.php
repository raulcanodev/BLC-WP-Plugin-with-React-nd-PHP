<?
$block_wrapper_attributes = get_block_wrapper_attributes();
$image_uri = isset($attributes['imageId']) ? wp_get_attachment_image_url($attributes['imageId']) : null;
$image_uri_large = isset($attributes['imageId']) ? wp_get_attachment_image_url($attributes['imageId'], "large") : null;

?>

<div <? echo $block_wrapper_attributes; ?>>
	<img data-large-size="<? echo $image_uri_large ?>" src="<? echo $image_uri ?>" class="thumb" />
</div>