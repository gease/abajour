<div ><?php echo __('You logged in as').' <b>'.$sf_user->getProfile();?></b></div>
<a href="<?php echo url_for('sfGuardAuth/signout'); ?>"><div id="signout_button">
<?php echo __('Sign out');?>
</div></a>
