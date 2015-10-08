<!DOCTYPE HTML>
<html>
	<head>
		<title>News Portal -Nepal</title>
			<link href="<?php echo $this->webroot;?>css/admin.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $this->webroot;?>css/style.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $this->webroot;?>css/bootstrap.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $this->webroot;?>css/demo/main.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $this->webroot;?>css/demo/demos.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $this->webroot;?>css/demo/jquery.Jcrop.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo $this->webroot;?>css/demo/style.css" rel="stylesheet" type="text/css" />
            

         <script type="text/javascript" src="<?php echo $this->webroot;?>js/demo/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo $this->webroot;?>js/ajaxupload.3.6.js"></script>
            <script type="text/javascript" src="<?php echo $this->webroot;?>js/ckeditor/ckeditor.js"></script>
            <script type="text/javascript" src="<?php echo $this->webroot;?>js/demo/jquery.Jcrop.js"></script>
           <script type="text/javascript" src="<?php echo $this->webroot;?>js/demo/style.js"></script>
         
            
           
		
		<script>
        
        
        </script>
	</head>
	<body>
    <div class="wrapper">
    <div class="header">
        <h3>NewsPortal Admin Panel</h3>
        <ul style="width:47%;">
            <li><a href="<?php echo $this->webroot;?>dashboard/">Home</a></li>
           <li><a href="<?php echo $this->webroot;?>dashboard/category">Category</a></li>
           <li><a href="<?php echo $this->webroot;?>dashboard/news">News Manager</a></li>
           <li><a href="<?php echo $this->webroot;?>dashboard/setting">Setting</a></li>
            <li><a href="<?php echo $this->webroot;?>dashboard/logout">Logout</a></li>
            
        </ul>
        <div class="clear"></div>
    </div>
    <div class="content">
    <?php echo $this->Session->flash();?>
    <?php echo $this->fetch('content'); ?>
    </div>
    <div class="footer">
        <hr />
        &copy; Copyright 2014. SHH<br />Powered by <a href="http://www.kodiary.com/">Kodiary</a>
    </div>
    </div>
    </body>
</html>
<?php echo $this->element('sql_dump'); ?>
