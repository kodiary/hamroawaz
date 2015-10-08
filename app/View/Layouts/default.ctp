<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/superfish.css" type="text/css" />
<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/stylesheet.css" type="text/css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic" type="text/css" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.7.1.min.js"></script>
<script src="<?php echo $this->webroot;?>js/hoverIntent.js" type="text/javascript"></script>
<script src="<?php echo $this->webroot;?>js/superfish.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.animate-shadow.js"></script>
<script type='text/javascript' src='<?php echo $this->webroot;?>js/jquery.cycle.all.min.js'></script>
<script type='text/javascript' src='<?php echo $this->webroot;?>nivo-slider/jquery.nivo.slider.pack.js'></script>
<!--<link rel="stylesheet" media="screen" href="nivo-slider/nivo-slider.css" type="text/css" />-->
</head>

			<?php echo $this->fetch('content'); ?>

      
	