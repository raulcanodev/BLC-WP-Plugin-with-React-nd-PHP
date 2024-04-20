<?

use WebDevEducation\Blockylicious;

$block_gap = Blockylicious::convert_custom_properties($attributes['style']['spacing']['blockGap'] ?? 0);
$block_wrapper_attributes = get_block_wrapper_attributes([
	'style' => 'gap: ' . $block_gap . '; justify-content: ' . $attributes['justifyContent']

]);
// wp_send_json($block_gap)
?>

<div <? echo $block_wrapper_attributes ?>>
	<? echo $content ?>
</div>