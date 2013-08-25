<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */

if (get_field('cm_video_aspectratio') == '5:4') :
	$video_height = '80%';
else : // Aspect Ratio 16:9
	$video_height = '56.25%';
endif;

if (get_field('cm_video_site') == 'youtube') : ?>
	<div class="video" style="padding-bottom:<?php echo $video_height; ?>;padding-top:25px;"><iframe src="http://www.youtube.com/embed/<?php the_field('cm_video_id'); ?>" frameborder="0" seamless webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
<?php else : // Vimeo ?>
	<div class="video" style="padding-bottom:<?php echo $video_height; ?>"><iframe src="http://player.vimeo.com/video/<?php the_field('cm_video_id'); ?>?portrait=0&color=4bb9c3" frameborder="0" seamless webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
<?php endif;

$content = get_the_content();
if (!empty($content)) : echo '<hr />'; endif; ?>