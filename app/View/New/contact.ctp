<h1>Contact Us</h1>
<form method="post" action="<?php echo $this->webroot; ?>New/email">
<input type="text" name="sub"  placeholder="Subject" required=""/><br />
<input type="text" name="name"  placeholder="Name" required=""/><br />
<input type="text" name="email"  placeholder="Email" required=""/><br />
<textarea placeholder="Feedback" name="feedback"></textarea><br />
<input type="submit" value="Submit"/>
</form>
<?php echo $this->Session->flash(); ?>