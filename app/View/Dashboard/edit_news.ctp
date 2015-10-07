<div class="newcontainer" style="">
<form action="<?php echo $this->webroot;?>dashboard/updateNews/<?php echo  $edit['Newsmanager']['id'];?>" method="POST" enctype="multipart/form-data" onsubmit="return checkForm()">
News Title:<br />
<input type="text" name="title" value="<?php echo  $edit['Newsmanager']['title'];?>"required="required"/><br/>

Image:<br />
         <input type="hidden" id="x1" name="x1" />
        <input type="hidden" id="y1" name="y1" />
        <input type="hidden" id="x2" name="x2" />
        <input type="hidden" id="y2" name="y2" />
       <div> <input type="file" name="image_file" id="image_file" onchange="fileSelectHandler()" /></div>
       <div class="error"></div>
        <div class="step2">
            <h2>Step2: Please select a crop region</h2>
            <img id="preview" />

            <div class="info">
                <label>File size</label> <input type="text" id="filesize" name="filesize" />
                <label>Type</label> <input type="text" id="filetype" name="filetype" />
                <label>Image dimension</label> <input type="text" id="filedim" name="filedim" />
                <label>W</label> <input type="text" id="w" name="w" />
                <label>H</label> <input type="text" id="h" name="h" />
            </div>

            
        </div>
        <img src="<?php echo $this->webroot;?>news/image/thumb/<?php echo $edit['Newsmanager']['image_file'];?>" width="100px" height="100px"/>
        <br />
 
Audio:<br /><input type="file" name="audio" /><br />
<?php echo $edit['Newsmanager']['audio'];?>
<br /><br />
Video:<br /><textarea name="video" >
<?php echo strip_tags($edit['Newsmanager']['video']);?>
</textarea>
<br />
Description:<br />
<textarea name="description"  class="ckeditor required" >
<?php echo  $edit['Newsmanager']['description'];?>
</textarea><br />

Category:<br />
<?php foreach($order as $ord){
       ?>
<input type="checkbox" name="category[]" value="<?php echo $ord['Categorymanager']['id'];?>" <?php foreach($list as $lis){if($ord['Categorymanager']['id']==$lis['News_category']['cat_id']){echo "checked";}} ?> /><?php echo $ord['Categorymanager']['title'];?>&nbsp;&nbsp;
<?php 
}
?><br /><br />

Standard:&nbsp;<input type="radio" name="national" value="1" class="standard" <?php $nation=$edit['Newsmanager']['national']; if(isset($nation) && $nation==1) echo "checked";?> /> National<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="2" name="national" <?php $nation=$edit['Newsmanager']['national']; if(isset($nation) && $nation==2) echo "checked";?>/> International<br/><br />
<p class="hid" style="display: none;">
Region:<select name="region">
<option value="1" <?php $region=$edit['Newsmanager']['region']; if(isset($region) && $region==1) echo "selected='selected'";?>>Himalayan</option>
<option value="2" <?php $region=$edit['Newsmanager']['region']; if(isset($region) && $region==2) echo "selected='selected'";?>>Hilly</option>
<option value="3" <?php $region=$edit['Newsmanager']['region']; if(isset($region) && $region==3) echo "selected='selected'";?>>Terai</option>
</select><br />
Zone:<select name="zone">
<option value="1" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==1) echo "selected";?>>Mechi</option>
<option value="2" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==2) echo "selected";?>>Koshi</option>
<option value="3" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==3) echo "selected";?>>Sagarmatha</option>
<option value="4" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==4) echo "selected";?>>Janakpur</option>
<option value="5" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==5) echo "selected";?>>Bagmati</option>
<option value="6" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==6) echo "selected";?>>Narayani</option>
<option value="7" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==7) echo "selected";?>>Gandaki</option>
<option value="8" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==8) echo "selected";?>>Lumbini</option>
<option value="9" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==9) echo "selected";?>>Dhawalagiri</option>
<option value="10" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==10) echo "selected";?>>Rapti</option>
<option value="11" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==11) echo "selected";?>>Karnali</option>
<option value="12" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==12) echo "selected";?>>Bheri</option>
<option value="13" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==13) echo "selected";?>>Seti</option>
<option value="14" <?php $zone=$edit['Newsmanager']['zone']; if(isset($zone) && $zone==14) echo "selected";?>>Mahakali</option>
</select>
<br />
</p>
Slider:<br /><input type="file" name="slider" value="<?php echo $edit['Newsmanager']['slider'];?>"/><br />
<?php echo $edit['Newsmanager']['slider'];?>
<div class="thumb" style="margin: 10px 0;">
  <!--  <img src="<?php echo $this->webroot.'news/slider/thumb/'.$edit['Newsmanager']['slider'];?>" class="target" style="width:690x;"/>

--></div>

<br /><br />
Is_headline:&nbsp;<input type="radio" value="1"  name="is_headline"  <?php $check=$edit['Newsmanager']['is_headline']; if(isset($check) && $check==1) echo "checked";?>/> Yes
<input type="radio" value="0" name="is_headline"  <?php $check=$edit['Newsmanager']['is_headline']; if(isset($check) && $check==0) echo "checked";?>/> No<br/><br />
<br />
<input type="submit" class="submit" name="submit" value="SUBMIT"/>
</form>

</div>
<script>
$(function(){
      
    $('.imgcrop').click(function(){
    $(this).closest('.thumb').find('.mainimg').toggle('style');
    });
$( 'input[name="national"]:radio' ).change(function() {       
   if (this.value == 1) {
            $(this).parent().find("p.hid").show();
        }
        else if (this.value == 2) {
          $(this).parent().find("p.hid").hide();
        }
        })
        var selectedVal = "";
var selected = $("input[type='radio'][name='national']:checked");
    selectedVal = selected.val();
    if(selectedVal==1){
        $("p.hid").show();
    }
    
   
 
});
  
</script>