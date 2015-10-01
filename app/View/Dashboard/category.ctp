<div class="news-section">

<p class="sel">
<form action="<?php echo $this->webroot;?>dashboard/addCategory" method="POST">
News Standard:
<select  id="category" name="select" class="category">
<?php foreach($value as $v){
    
    $id=$v['Region']['id'];
    ?>
<option value='<?php echo $id;?>'><?php echo $v['Region']['regioncategory'];?></option>
<?php
}?>
</select>
</p>
<p class="regionname" style="display: none;">
Enter news category:
<input type="text" name="regionname" class=""/><br />
<input type="submit" name="submit"/>
</form>
</p>
</div>
<script>

$(function(){
   
  $('.category').change(function() {
    if ($(this).val() === '1' || $(this).val() === '2') {
       $(function(){
        $("p.regionname").show();
       })
    }
    if ($(this).val() === '3') {
       $(function(){
        $("p.regionname").hide();
       })
    }
    
});
})


</script>