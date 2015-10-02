<head>
<script>  
$(function(){
    
    setTimeout(function(){$('#odlpwd').val('')},100);  
}); 
</script>
</head>
<body>
<h1>settings</h1>
<form method="post" action="<?php echo $this->webroot; ?>Dashboard/update/<?php echo $value['Admin']['id'] ?>">
Username:<input type="text" name="username" placeholder="Username"  value="<?php echo $value['Admin']['username'] ?>" required=""/><br />
Old Password:<input type="password" id="odlpwd"  class="input" value="" placeholder="Old Password" name="pw" /><br />
New Password:<input type="password" placeholder="Password" id="password" name="newpassword"  /><br />
Confirm Password:<input type="password" placeholder="Confirm Password" id="confirm_password" /><br />
Email:<input type="text" placeholder="Email" name="email" class="button"  value="<?php echo $value['Admin']['email'] ?>" /><br />
<input type="submit" class="button" value="Update"/>
</form>
<script src="<?php echo $this->webroot; ?>password.js"></script>
<div><?php echo $this->Session->flash();?></div>
</body>