<?php

if (is_admin()) {
?>		<form method="post" class="standard-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
			<br />
				<h2 style="margin-top: 0; padding-top: 0;">Metadata</h2>
<?php
}
else {
?>
	<br />

	<h3>Metadata</h3>
<?php
}
?>	
	<div id="nbm">
		<div id="nbm_intro">
		<?php if ( is_admin() ) { ?> <h3 style='margin-bottom: .5em;'>About Your Site</h3> <?php } else { ?>
			<h6 style='margin-bottom: .5em;'>About Your Site</h6> 
		<?php } ?>
			<p>Please take a moment to tell us a little bit about your site on Blogs@Baruch. This information would be used simply to help us understand how members of the community are using Blogs@Baruch so that we can improve the overall experience. You may change these answers at any point.</p>
		</div>

