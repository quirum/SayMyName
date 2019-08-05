<?php
$danger = array(
	sprintf(_('Please install the Music On Hold module via %s or run `fwconsole ma install music` from the CLI`'),'<a href="config.php?display=modules">Module Admin</a>')
);
echo generate_message_banner(_('Music On Hold Not Installed'), 'danger', $danger);
