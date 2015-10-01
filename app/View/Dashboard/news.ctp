<div class="newcontainer">
<h2>Add News</h2>
<form action="<?php echo $this->webroot;?>dashboard/addNews" method="POST">
News Title:<br />
<input type="text" name="title"/><br/>
Image:<br /><input type="file" name="image"/><br /><br />
Audio:<br /><input type="file" name="audio"/><br /><br />
Video:<br /><textarea name="video">

</textarea>
<br />
Description:<br />
<textarea name="description"  class="ckeditor required">
</textarea><br />
Nation:&nbsp;<input type="radio" name="nation"/> National<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="nation"/> International<br/><br />
Region:<select name="region">
<option value="1">Himalayan</option>
<option value="2">Hilly</option>
<option value="3">Terai</option>
</select><br />
Zone:<select name="zone">
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
Slider:<br /><input type="file" name="slider"/><br /><br />
Is_headline:&nbsp;<input type="checkbox" value="1" name="headline"/> Yes
<input type="checkbox" value="2" name="headline"/> No<br/><br />

<input type="submit" name="submit" value="SUBMIT"/>
</form>


</div>