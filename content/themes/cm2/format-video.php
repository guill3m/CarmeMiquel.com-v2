<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */

if (get_field('cm_video_site') == 'youtube') : ?>
	<div class="video" style="padding-bottom:80%;padding-top:25px;"><iframe src="http://www.youtube.com/embed/<?php the_field('cm_video_id'); ?>" frameborder="0" seamless webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
<?php elseif (get_field('cm_video_site') == 'youtube_list') : ?>
	<div class="video" style="padding-bottom:80%;padding-top:25px;"><iframe src="http://www.youtube.com/embed/videoseries?list=<?php the_field('cm_video_id'); ?>" frameborder="0" seamless webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
<?php else : // Vimeo ?>
	<div class="video" style="padding-bottom:80%"><iframe src="http://player.vimeo.com/video/<?php the_field('cm_video_id'); ?>?portrait=0&color=4bb9c3" frameborder="0" seamless webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
<?php endif;

$content = get_the_content();
if (!empty($content)) : echo '<hr />'; endif; ?>