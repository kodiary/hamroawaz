
<script src="<?php echo $this->webroot;?>js/jquery.bxslider.min.js"></script>
<link href="<?php echo $this->webroot;?>css/jquery.bxslider.css" rel="stylesheet" />
<div class="main" style="margin: 30px auto;width: 980px;">
    <div>
    <ul><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot;?>"><strong>Home</strong></a></li>
    
    <?php foreach($cat as $q)
    {
        ?><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot.'page/'.$q['Categorymanager']['slug'];?> "><strong><?php echo $q['Categorymanager']['title']; ?></strong></a></li><?php
    }
    ?>
    </ul>
    </div><div class="clearfix"></div>
    <div >
    <ul class="contentslider">
     <?php 
     
     $result=$this->requestAction('new/checkstandard/'.$standard.'/'.$classname);

    if($result){
    foreach($result as $list){
    ?>
  <li><a href="<?php echo $this->webroot;?>description/<?php echo $list['Newsmanager']['slug'];?>"><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>"width=""/></a><h4><?php echo $list['Newsmanager']['title'];?></h4>
 <?php
 
 if($list['Newsmanager']['description']){
      echo  substr($list['Newsmanager']['description'],0,100);
      echo '<br/><a href="'.$this->webroot.'description/'.$list['Newsmanager']['slug'].'">view</a>';
    }else{
        echo "<span style='color:red'>No Description Avaialble</span>";
    }
 
?>
  </li> 
    <?php }}?>
    </ul>
    </div>
    <div class="clearfix"></div>
    <div>
        <ul class="bxslider">
         <?php $slider=$this->requestAction('new/checkslider/'.$standard.'/'.$classname);
         if($slider){
          foreach($slider as $a)
            {
            ?><li><img src="<?php echo $this->webroot;?>slider/<?php echo $a['Newsmanager']['slider'];?>" title="<?php echo $a['Newsmanager']['title'];?>" /></li><?php
            }}else{
                
            }
           ?>
        </ul>
    </div>
   <div>
    <div style="float: left; width: 70%; padding: 15px" >
   
    </div>
    
   
    </div><div class="clearfix"></div>
    <div class="row" >
<div class="span8">
<?php $catlist=$this->requestAction('new/getCategory');
foreach($catlist as $show){
    ?>
     
<div class="category" style="float: left;width: 45%;border: 1px solid #F9F9F9;height: auto;display:block">
<h3><p style="padding: 10px"><?php echo $show['Categorymanager']['title'];?></p></h3>
<?php  $id=$show['Categorymanager']['id'];

$requst=$this->requestAction('new/getNewsId/'.$id.'/'.$standard.'/'.$classname);
;
if($requst){


foreach($requst as $fetch){
    $newsid=$fetch['News_category']['news_id'];
$ft=$this->requestAction('new/getNewsContent/'.$newsid.'/'.$standard.'/'.$classname);
if($ft){
?>
<div class="sub" style="float: left;margin-right:38px">
<?php
echo "<ul>";
    foreach($ft as $content){
      ?>
       <a href="<?php echo $this->webroot;?>description/<?php echo $content['Newsmanager']['slug'];?>"  class="view" title="<?php echo $content['Newsmanager']['title'];?>">
     <li><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $content['Newsmanager']['image_file'];?>"width="81px" class="view" title="<?php echo $content['Newsmanager']['title'];?>"/></li>
        <?php
        echo "<li><h4>".$content['Newsmanager']['title']."</h4></li>";
        echo "<li>".substr(strip_tags($list['Newsmanager']['description']),1,100)."</li>";
       echo "</a>";
        ?>

        <?php
}
?>

<?php
echo "</ul>";
?>

</div>

<?php }else{
   // echo "No data available";
} 
?>

<?php
}
?>
<a href="<?php echo $this->webroot;?>page/<?php echo $show['Categorymanager']['title'];?>">view all</a>
<?php
}else{
   echo "";
}
?>

</div>

<?php
}?>
</div><div class="span4" style="float:right;margin-top:-109px">
 <h1>Widgets</h1>
    <hr />
    <h2>Currency</h2>
    <hr />
        <?php
        $arab= $this->requestAction('/new/get_currency/AED/NPR/1');
        $uk= $this->requestAction('/new/get_currency/GBP/NPR/1');
        $canada= $this->requestAction('/new/get_currency/CAD/NPR/1');
        $Australia= $this->requestAction('/new/get_currency/AUD/NPR/1');
        $india= $this->requestAction('/new/get_currency/INR/NPR/1');
        $usa= $this->requestAction('/new/get_currency/USD/NPR/1');
        ?>
        <table>
        <tr><td>UAE</td><td>1</td><td><?php echo "NRs".$arab;?></td></tr>
        <tr><td>UK</td><td>1</td><td><?php echo  "NRs".$uk;;?></td></tr>
        <tr><td>UAE</td><td>1</td><td><?php echo "NRs".$canada;?></td></tr>
        <tr><td>Australia</td><td>1</td><td><?php echo "NRs".$Australia;?></td></tr>
        <tr><td>India</td><td>1</td><td><?php echo "NRs".$india;?></td></tr>
        <tr><td>USA</td><td>1</td><td><?php echo "NRs".$usa;?></td></tr>
        </table>
    
        <a href=" <?php echo $this->webroot; ?>New/currency">Currency Converter</a>

<form action="" method="POST" >
Filter By News Standards:<br /><select class="standardfilter">
<option value="0">select standard</option>
<option value="1" selected="selected">National</option>
<option value="2">International</option>
</select>
<div class="substandardfilter">
<?php if($classname=='region'){ ?>
Region:<select name="region" class="region">
<option value="0" >Select Region</option>
<option value="1" <?php if($standard==1){echo "selected";} ?>>Himalayan</option>
<option value="2" <?php if($standard==2){echo "selected";} ?>>Hilly</option>
<option value="3" <?php if($standard==3){echo "selected";} ?>>Terai</option>
</select><br />
<?php }else{ ?>
    Region:<select name="region" class="region">
<option value="0">Select Region</option>
<option value="1">Himalayan</option>
<option value="2">Hilly</option>
<option value="3">Terai</option>
</select><br />
<?php    
}
if($classname=='zone'){
?>
Zone:<select name="zone" class="zone">
<option value="0" >Select Zone</option>
<option value="1" <?php if($standard==1){echo "selected";} ?>>Mechi</option>
<option value="2" <?php if($standard==2){echo "selected";} ?>>Koshi</option>
<option value="3" <?php if($standard==3){echo "selected";} ?>>Sagarmatha</option>
<option value="4" <?php if($standard==4){echo "selected";} ?>>Janakpur</option>
<option value="5" <?php if($standard==5){echo "selected";} ?>>Bagmati</option>
<option value="6" <?php if($standard==6){echo "selected";} ?>>Narayani</option>
<option value="7" <?php if($standard==7){echo "selected";} ?>>Gandaki</option>
<option value="8" <?php if($standard==8){echo "selected";} ?>>Lumbini</option>
<option value="9" <?php if($standard==9){echo "selected";} ?>>Dhawalagiri</option>
<option value="10" <?php if($standard==10){echo "selected";} ?>>Rapti</option>
<option value="11" <?php if($standard==11){echo "selected";} ?>>Karnali</option>
<option value="12" <?php if($standard==12){echo "selected";} ?>>Bheri</option>
<option value="13" <?php if($standard==13){echo "selected";} ?>>Seti</option>
<option value="14" <?php if($standard==14){echo "selected";} ?>>Mahakali</option>
</select>
<br />
<?php }
else{
?>
Zone:<select name="zone" class="zone">
<option value="0" >Select Zone</option>
<option value="1" >Mechi</option>
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
<?php }?>
</div>
</form>

<h1>Archives</h1>

<?php
/*
$month=10;
$year=2015;
$this->requestAction('/new/days_in_month/'.$month.'/'.$year);*/
$dates=$this->requestAction('new/getDates');
if($dates!='NULL'){
 if($dates[0][0]==$dates[1][0]){
 $startyear=$dates[0][0];   
echo '<a class="year" title="'.$startyear.'" href="javascript:void(0)">'.$dates[0][0].'</a>';
?>
 <div style="display:none;" class="month">
 <select class="months">
 <option value="0">Select Month</option>
 <?php 
 for($j=1;$j<=12;$j++){
    $res=$this->requestAction('archive/months_in_string/'.$j);
   echo '<option value="'.$j.'">';
    echo $res;
    echo '</option>';
    
    
 }
 ?>
 </select><br />
 
 <select class="dayhere" title="lalustine" style="display: none;">
 
 
 
 </select>
 </div>
 <?php
 }else{
 $diff=$dates[1][0]-$dates[0][0];
 $startyear=$dates[0][0];
 
 for($i=0;$i<=$diff;$i++){
  ?>
  <div>
  <?php
 echo '<a class="year" title="'.$startyear.'"href="javascript:void(0)">'.$startyear.'</a><br>';
 ?>
 <div style="display:none;" class="month">
 <select class="months">
 <option value="0">Select Month</option>
 <?php 
 for($j=1;$j<=12;$j++){
    $res=$this->requestAction('/new/months_in_string/'.$j);
   echo '<option value="'.$j.'">';
    echo $res;
    echo '</option>';
    
    
 }
 ?>
 </select><br />
 
 <select class="dayhere" style="display: none;">
 
 
 
 </select>
 <?php 
 

 ?>
 </div>
 </div>
 <?php
 ++$startyear;
        
    }
 }
}else{
    echo "No archive available!!";
    echo "<br/>";
}

?>

<div class="loader" style="display: none;"><img src="<?php echo $this->webroot;?>img/loader.gif"/></div>
</div>

</div>

<div class="clearfix"></div>
<div class="row">
<ul>
<h3>Mostly Viewed Post</h3>
<?php $result=$this->requestAction('/new/findmostView/'.$standard.'/'.$classname);
if($result!='NULL'){
foreach($result as $mostviewed){
    ?>
    <a class="view" title="<?php echo $mostviewed['Newsmanager']['title'];?>" href="<?php echo $this->webroot;?>description/<?php echo $mostviewed['Newsmanager']['slug'];?>">
    <li><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $mostviewed['Newsmanager']['image_file'];?>" width="200px" height="150px" /></li>
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li><h3> <?php echo $mostviewed['Newsmanager']['title'];?></h3></li>
  <li> <?php if($mostviewed['Newsmanager']['description']){
    echo substr(strip_tags($mostviewed['Newsmanager']['description']),1,100);
    }
    else{
        echo"No description available";}?></li>
        </a>
 
  </div>
 <?php
}
}else{
    echo "No Post Available!!";
    echo "<br>";
}
?>
</ul>
</div>
<div>
        <ul class="audioslider">
        
          <?php foreach($slider as $a)
            {
    ?><li>
    <?php  if($a['Newsmanager']['video']&&$a['Newsmanager']['audio']&&$a['Newsmanager']['audio']){?>
            <div class="ytvideo"><?php echo $a['Newsmanager']['video'];?></div>
            <audio controls>
<source src="<?php echo $this->webroot;?>news/audio/<?php echo $a['Newsmanager']['audio'];?>" type="audio/mpeg">
    <source src="<?php echo $this->webroot;?>news/audio/<?php echo $a['Newsmanager']['audio'];?>" type="audio/wav">
Your browser does not support the audio element.
</audio><?php }?></li><?php
           // die();
             }
           ?>
        </ul>
    </div>
    <div class="footer">
    <p>Powered By Kodiary.com</p>
    <div>
    <ul><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot;?>"><strong>Home</strong></a></li>
    <?php foreach($cat as $q)
    {
        ?><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot.'page/'.$q['Categorymanager']['slug'];?> "><strong><?php echo $q['Categorymanager']['title']; ?></strong></a></li><?php
    }
    ?>
    </ul>
    </div>
    </div>
    </div>
    <script>
    $(function(){
    $('.categoryfilter').change(function(){
        var id;
        id=this.value;
        if(id!=0){
        $.ajax({
           url: "<?php echo $this->webroot;?>new/headLinefilter",
            data: "id="+id,
            type: "post",
            dataType: "html",
            success: function(response){
            $('.headline').html(response);
            } 
            
        });}
    });
      /*--------------------------------------------------*/
    $('.standardfilter').change(function(){
       
        var id;
        id=this.value;
        if(id==1){
        $('.substandardfilter').show();
        }
         else if(id==2){
             $('.substandardfilter').hide();
                    
         }           
               
          if(id!=0){
        $('.loader').show();
           $.ajax({
           url: "<?php echo $this->webroot;?>new/newstandard",
            data: "standard="+id,
            type: "post",
            dataType: "html",
            success: function(response){
                $('.loader').hide();
            $('.main').html(response);
           
            } 
            
        });}
    });
    
     $('.region').change(function(){
       var id=this.value; 
var className = $('.region').attr('class');
        if(id!=0){
        $('.loader').show();

           $.ajax({
           url: "<?php echo $this->webroot;?>new/newsubstandard",
            data: 'sub='+id+'&classname='+className,
            type: "post",
            dataType: "html",
            success: function(response){
                $('.loader').hide();
            $('.main').html(response);
           
            } 
            
        });}
    });
    $('.zone').change(function(){
       var id=this.value; 
var className = $('.zone').attr('class');
        if(id!=0){
        $('.loader').show();
           $.ajax({
           url: "<?php echo $this->webroot;?>new/newsubstandard",
            data: 'sub='+id+'&classname='+className,
            type: "post",
            dataType: "html",
            success: function(response){
                $('.loader').hide();
            $('.main').html(response);
           
            } 
            
        });}
         });
    /*--------------------------------------------------*/
    $('.view').click(function(){
       var title=$(this).attr('title');
       //alert(title);
    $.ajax({
       url: "<?php echo $this->webroot;?>new/checkview",
       data:"title="+title, 
       type:"post",
       //dataType:"html",
       success: function(response){
        alert(response);
       }
       
    });
    });
    
    
    
    /*--------------------------------------------------*/
});

$('.bxslider').bxSlider({
  auto: true,
   mode: 'fade',
  captions: true,
  autoControls: true
});
$('.contentslider').bxSlider({
  minSlides: 4,
  maxSlides: 4,
  slideWidth: 500,
  slideHeight:50,
  slideMargin: 10
});
$('.audioslider').bxSlider({
minSlides: 4,
  maxSlides: 4,
  slideWidth: 500,
  slideHeight:50,
  slideMargin: 10
});
</script>

