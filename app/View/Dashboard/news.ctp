<div id="">

<form action="<?php echo $this->webroot;?>dashboard/addNews" method="POST">
News Title:<br />
<input type="text" name="title"/><br/>
RegionCategory:<br />
<select  id="category" name="select" class="category">
<?php foreach($value as $v){
    
    $id=$v['Region']['id'];
    ?>
<option value='<?php echo $id;?>'><?php echo $v['Region']['regioncategory'];?></option>
<?php
}?>
</select><br />
Description:<br />
<textarea name="description">
</textarea><br />
<input type="submit" name="submit" value="SUBMIT"/>
</form>


</div>