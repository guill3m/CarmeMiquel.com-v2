<?php
/**
 * @package WordPress
 * @subpackage CarmeMiquel.com v2
 */
?>

<audio controls preload="auto" autobuffer>
	<source src="<?php the_field('cm_audio_mp3'); ?>" type="audio/mpeg">
	<source src="<?php the_field('cm_audio_ogg'); ?>" type="audio/ogg">
	<p>El teu navegador no soporta l'element <code>audio</code>, no podem reproduïr l'arxiu des de la web, <a href="<?php the_field('cm_audio_mp3'); ?>" title="Descarregar l'arxiu per escoltar-lo al teu ordinador">però el pots descarregar</a>.</p>
</audio>

<?php $content = get_the_content();
if (!empty($content)) : echo '<hr />'; endif; ?>