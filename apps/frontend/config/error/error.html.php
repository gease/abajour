<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="ru" />
<title>Журнал "Вычислительные Технологии"</title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path; ?>/css/main.css" />
<link rel="shortcut icon" href="<?php echo $path; ?>/images/favicon.ico" />
<script src="/js/jquery/jquery-1.3.2.min.js" type="text/javascript" ></script>
<script src="/js/layout.js" type="text/javascript" ></script>
</head>
<body>
<div id="header">
<div id="header1"><a href="<?php echo $path;?>"></a></div>
<div id="header2"><div id="in_header2">
<img src="<?php echo $path; ?>/images/title.png" />
</div></div>
<div id="header3"></div>
<div id="header4"></div>
</div>
<div id="content">
<h1 class="error">Ошибка</h1>
<div class="error">
На сервере произошла ошибка. Код ошибки <?php echo $code;?>, сообщение <?php echo $text;?>. Если ошибка возникнет снова,
сообщите администратору сервера jsc@niic.nsc.ru
</div>
<h1 class="error">Error</h1>
<div class="error">
An error has occurred. Error code is  <?php echo $code;?>, text message is <?php echo $text;?>. If the error persists,
please notify server administrator at jsc@niic.nsc.ru
</div>
</div>
<div id="footer">
<div id="footer1"></div>
<div id="footer2"><div id="in_footer2">
</div></div>
<div id="footer3"></div>
</div>
</body>
</html>
