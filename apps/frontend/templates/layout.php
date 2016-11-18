<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php if (!include_slot('page_title')):?>
<?php echo __('Journal of Structural Chemistry');?>
<?php endif;?>
</title>
<?php include_http_metas() ?>
<?php include_metas() ?>


<link rel="shortcut icon" href="<?php echo image_path('favicon.ico'); ?>" />
</head>
<body>
<div id="header">
<div id="header1"><a href="<?php echo url_for('@homepage');?>"></a></div>
<div id="header2"><div id="in_header2">
<?php if ($sf_user->getCulture()=='en'):?>
<img src="<?php echo image_path('jsc-en.gif'); ?>" />
<?php else:?>
<img src="<?php echo image_path('jsc-ru.gif'); ?>" />
<?php endif;?>
</div></div>
<div id="header3"></div>
<div id="header4"></div>
</div>
<div id="lang_bar"><?php include_partial('main/language');?></div>
<?php if ($sf_user->isAuthenticated()):?>
<div id="signout"><?php include_partial('main/signout');?></div>
<?php endif;?>
<div id="content">
    <?php if ($sf_user->hasCredential('admin')):?>
        <div id="main_menu" class="menu">
        <?php include_partial('main/admin_menu');?>
        </div>
    <?php elseif ($sf_user->isAuthenticated()):?>
        <div id="user_menu" class="menu">
        <?php include_component('user','menu');?>
        </div>
    <?php endif;?>
    <h1><?php include_slot('page_header');?></h1>
    <?php if ($sf_user->hasFlash('info')):?>
        <div class="flash info"><?php echo $sf_user->getFlash('info') ?></div>
    <?php endif; ?>
    <?php echo $sf_content ?>
</div>
<div id="footer">
<div id="footer1"></div>
<div id="footer2"><div id="in_footer2">
<?php echo __('Editorial office'); ?>&nbsp;
<img src="<?php echo image_path('email');?>" style="vertical-align: text-bottom; cursor: pointer;" onclick="window.open('mailto:'+str_rot13('<?php echo str_rot13(sfConfig::get('app_mail_admin'));?>'), '_self')"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo __('Technical support'); ?>&nbsp;
<img src="<?php echo image_path('email');?>" style="vertical-align: text-bottom; cursor: pointer;" onclick="window.open('mailto:'+str_rot13('<?php echo str_rot13(sfConfig::get('app_mail_support'));?>'), '_self')"/>
</div></div>
<div id="footer3"></div>
</div>
</body>
</html>
