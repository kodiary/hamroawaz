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
<body>
<div id="panel" style="display: none;">
  <p># You can add any kind of announcement or updates happening on your website</p>
</div>
<a id="notification" class="btn-slide" href="javascript:void(0)">&darr;</a>
<div id="container_wrapper">
  <div id="header">
    <div id="header-top">
      <h2 id="logo"><a href="#"></a></h2>
      <div class="nav-container">
        <ul id="menu">
          <li><a href="index.html">Home</a></li>
          <li><a href="post-page.html">Post Page</a></li>
          <li class="sub"><a href="#">Dropdowns</a>
            <ul>
              <li class="sub"><a href="#">Item one</a></li>
              <li class="sub"><a href="#">Item two</a></li>
              <li class="sub"><a href="#">Item three</a></li>
            </ul>
          </li>
          <li><a href="full-width.html">Fullwidth</a></li>
          <li><a href="archives.html">Archives</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
      <form method="get" id="searchform" action="javascript:void(0)" name="searchform">
        <input type="text" class='rounded text_input' value="" name="s" id="s" />
        <input type="submit" class="button ie6fix" id="searchsubmit" value="&rarr;" />
      </form>
    </div>
			<?php echo $this->fetch('content'); ?>
            <div id="footer"> <span id="Scroll"><a href="javascript:void(0)">&uarr;</a></span>
    <div id="footer_inner">
      <div class="columns">
        <div class="widget">
          <h6>About Us</h6>
          <p>Lorem ipsum dolor sit consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
          <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla consequat massa quis enim.</p>
          <p>Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
        </div>
        <div class="clear"></div>
      </div>
      <div class="columns">
        <div class="widget">
          <h6>My Flickr</h6>
          <div class="flickr">
        </div>
          <div class="clear"></div>
        </div>
      </div>
      <div class="columns">
        <div class="widget">
          <h6>Recent Posts</h6>
          <ul class="recent_posts">
            <li class="clearfix">
              <h3 class="title"><a href="#">Samsung seeks ban on sale of key Apple products in US</a></h3>
            </li>
            <li class="clearfix">
              <h3 class="title"><a href="#">Big fast-food chains lag rivals in taste</a></h3>
            </li>
            <li class="clearfix">
              <h3 class="title"><a href="#">Toyota recalls 110,000 hybrid cars on safety concerns</a></h3>
            </li>
            <li class="clearfix">
              <h3 class="title"><a href="#">Sony hacker now on Facebook payroll</a></h3>
            </li>
            <li class="clearfix">
              <h3 class="title"><a href="#">Sarkozy involved in scuffle during handshake tour</a></h3>
            </li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      <div class="columns" style="width:15% !important;">
        <div class="widget">
          <h6>Quick links</h6>
          <ul class="quick_links">
            <li><a href="#">World news</a></li>
            <li><a href="#">Science</a></li>
            <li><a href="#">Entertainment</a></li>
            <li><a href="#">Technology</a></li>
            <li><a href="#">Helth</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Sports</a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      <div class="footer_bottom">
        <ul class="footer_menu">
          <li><a href="#">Home</a> /</li>
          <li><a href="#">About</a> /</li>
          <li><a href="#">Contact</a> /</li>
          <li><a href="#">Licensing</a></li>
        </ul>
        <p>&copy; Copyright 2011. All rights reserved. Template by <a target="_blank" href="http://www.bloggerzbible.com">Jdsans</a></p>
      </div>
    </div>
  </div>
	