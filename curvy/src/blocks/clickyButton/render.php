<?
$block_wrapper_attributes = get_block_wrapper_attributes();
if ($attributes['linkedPost'] ?? null) {

	$post_uri = get_permalink($attributes['linkedPost']);
}
?>

<a href="<? echo $post_uri ?? "#"; ?>" <? echo $block_wrapper_attributes ?>>
	<? echo $attributes['labelText'] ?>
</a>