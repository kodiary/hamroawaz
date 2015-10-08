
<h2><button class="addnews">Add News</button></h2>
<div class="newcontainer" style="display: none;">
<form id="upload_form" action="<?php echo $this->webroot;?>dashboard/addNews" method="POST" enctype="multipart/form-data">
News Title:<br />
<input type="text" name="title" required="required"/><br/>
Image:<br />
         <input type="text" id="x1" name="x1" />
        <input type="text" id="y1" name="y1" />
        <input type="text" id="x2" name="x2" />
        <input type="text" id="y2" name="y2" />
        <input type="text" id="w" name="w" />
        <input type="text" id="h" name="h" />
       
        
       <div> <input type="file" name="image_file" id="image_file" onchange="fileSelectHandler()" /></div>
       <div class="error"> </div>
        <div class="step2">
        <div class="cont">
            <h2>Step2: Please select a crop region</h2>
            </div>
            <img id="preview" />
            

            
        </div><br /><br /><br />
Audio:<br /><input type="file" name="audio" required="required"/><br /><br />
Video:<br /><textarea name="video" required="required"></textarea>
<br />
Description:<br />
<textarea name="description"  class="ckeditor required" required="required"></textarea><br />

Category:<br />
<?php foreach($order as $ord){?>
<input type="checkbox" name="category[]" value="<?php echo $ord['Categorymanager']['id'];?>" /><?php echo $ord['Categorymanager']['title'];?>&nbsp;&nbsp;
<?php }?><br /><br />

Standard:&nbsp;<input type="radio" name="national" value="1" class="standard" required="required"/> National<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="2" name="national" required="required"/> International<br/><br />
<p class="hid" style="display: none;">
Region:<select name="region">
<option selected="selected" value="notnational">Select Region</option>
<option value="1">Himalayan</option>
<option value="2">Hilly</option>
<option value="3">Terai</option>
</select><br />
Zone:<select name="zone">
<option selected="selected"  value="notnational">Select Zone</option>
<option value="1">Mechi</option>
<option value="2">Koshi</option>
<option value="3">Sagarmatha</option>
<option value="4">Janakpur</option>
<option value="5">Bagmati</option>
<option value="6">Narayani</option>
<option value="7">Gandaki</option>
<option value="8">Lumbini</option>
<option value="9">Dhawalagiri</option>
<option value="10">Rapti</option>
<option value="11">Karnali</option>
<option value="12">Bheri</option>
<option value="13">Seti</option>
<option value="14">Mahakali</option>
</select>
<br />
</p>
Slider:<input type="file" name="slider"/><br />
Is_headline:&nbsp;<input type="radio" value="1" name="is_headline" required="required"/> Yes
<input type="radio" value="0" name="is_headline" required="required"/> No<br/><br />

<input type="submit" class="submit" name="submit" value="SUBMIT"/>
</form>
</div>
<div class="showlist">
<h4>list of News</h4>

<div class="newslist">
<?php 
if($list){
    $i=0;
foreach($list as $val){
    $i++;
  ?>
 <div class="list"><div class="number"><?php echo $i;?>.</div>
 <div class="title"><?php echo $val['Newsmanager']['title']?></div>
 <!--<div class="image"><img src="<?php echo $this->webroot;?>news/image/<?php echo $val['Newsmanager']['image']?> " height="50px" width="50px"/></div>-->
 <div class="action">
 <a href="<?php echo $this->webroot; ?>dashboard/editNews/<?php echo $val['Newsmanager']['id'];?>" class="btn btn-info">Edit</a>
  <a href="<?php echo $this->webroot; ?>dashboard/deleteNews/<?php echo $val['Newsmanager']['id'];?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</a>
  </div>
 <div class="clear"></div></div>
  
  <?php  
}
}else{
    echo "<h6>No News have been inserted!!</h6>";
}
?>

</div>
</div>
<script>
$(function(){
    $(".addnews").click(function(){
        $(".newcontainer").toggle();
        $(".showlist").toggle();
    })
    $( 'input[name="national"]:radio' ).change(function() {       
   if (this.value == 1) {
            $(this).parent().find("p.hid").show();
        }
        else if (this.value == 2) {
          $(this).parent().find("p.hid").hide();
        }
})
 

});


</script>