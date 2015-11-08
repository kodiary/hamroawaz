<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>
<?php  $url=Router::url( $this->here, true );
$slug=explode('/',$url);
$ext=end($slug);
 if($this->params['controller']=='description'){
   
$result=$this->requestAction('/description/getContent/'.$ext);
  $url=Router::url( $this->here, true );
  $var= explode('hamroawaz.com/',$url);
  }


 ?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:type"content="blog" />
<!--<meta property="fb:admins"content="980665111956108"/>-->
<?php if(!empty($result)){?>
<meta property="fb:app_id"content="506034659558768" />
<meta property="og:url"content="http://www.kodiary.com/hamroawaz.com/description/<?php echo $ext;?>" />
<meta property="og:title"content="<?php echo $result['Newsmanager']['title'];?>" />
<meta property="og:site_name"content="Kodiary Site"/>
<meta property="og:description" content=" <?php echo $result['Newsmanager']['description'];?>" />
<meta property="og:image" content="<?php echo $var[0];?>hamroawaz.com/news/image/thumb/<?php echo $result['Newsmanager']['image_file'];?>"/>
<?php }?>

<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/superfish.css" type="text/css" />
<!-- <link rel="stylesheet"  href="<?php echo $this->webroot;?>css/bootsrap.css" type="text/css" />
<link rel="stylesheet"  href="<?php echo $this->webroot;?>css/bootsrap.min.css" type="text/css" />-->
<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/stylesheet.css" type="text/css" />
<link rel="stylesheet" media="screen" href="<?php echo $this->webroot;?>css/style.css" type="text/css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic" type="text/css" />
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-1.7.1.min.js"></script>
<script src="<?php echo $this->webroot;?>js/hoverIntent.js" type="text/javascript"></script>
<script src="<?php echo $this->webroot;?>js/superfish.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery-ui.min.js"></script>
<!--<script type="text/javascript" src="<?php echo $this->webroot;?>js/custom.js"></script>-->
<script type="text/javascript" src="<?php echo $this->webroot;?>js/jquery.animate-shadow.js"></script>
<script type='text/javascript' src='<?php echo $this->webroot;?>js/jquery.cycle.all.min.js'></script>
<script type='text/javascript' src='<?php echo $this->webroot;?>nivo-slider/jquery.nivo.slider.pack.js'></script>
<!--<link rel="stylesheet" media="screen" href="nivo-slider/nivo-slider.css" type="text/css" />-->
</head>

			<?php echo $this->fetch('content'); ?>

      
	