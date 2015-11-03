
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
     
     if(!empty($val)){
      
    foreach($val as $list){
        
    ?>
  <li><a href="<?php echo $this->webroot;?>description/<?php echo $list['Newsmanager']['slug'];?>"><img class="view" title="<?php echo $list['Newsmanager']['title'];?>" src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>"width=""/></a><h4><?php echo $list['Newsmanager']['title'];?></h4>
 <?php
 
 if($list['Newsmanager']['description']){
      echo  substr($list['Newsmanager']['description'],0,100);
      echo '<br/><a class="view" title="'.$list['Newsmanager']['title'].'" href="'.$this->webroot.'description/'.$list['Newsmanager']['slug'].'">view</a>';
    }else{
        echo "<span style='color:red'>No Description Avaialble</span>";
    }
 
?>
  </li> 
    
        <?php
    }}else{
        ?>
        <li><img src="<?php echo $this->webroot;?>img/no.png"width="980px" height="300px"/><h4></h4></li>
        
        <?php
    }?>
    </ul>
    </div>
    <div class="clearfix"></div>
    <div>
    <br />
        <ul class="bxslider">
       <?php
       if(!empty($slider)){
           foreach($slider as $a)
            {
            ?><li><img  src="<?php echo $this->webroot;?>slider/<?php echo $a['Newsmanager']['slider'];?>" title="<?php echo $a['Newsmanager']['title'];?>" /></li><?php
            }
            }else{
                ?>
                <li><img src="<?php echo $this->webroot;?>img/no.png"width="980px" height="300px"/><h4></h4></li>
           <?php }
           ?>
        </ul>
    </div>
   <div>
    <!--<div style="float: left; width: 70%; padding: 15px" class="headline"><h1>Headline</h1>
    <hr />
    <ul>
    <?php $query=$this->requestAction('/archive/getHeadline/'.$date);
    foreach($query as $list){?>
    <a class="view" title="<?php echo $list['Newsmanager']['title'];?>" href="<?php echo $this->webroot;?>description/<?php echo $list['Newsmanager']['slug'];?>">
    <li><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>" width="200px" height="150px" /></li>
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li><h3> <?php echo $list['Newsmanager']['title'];?></h3></li>
  <li> <?php if($list['Newsmanager']['description']){
    echo substr(strip_tags($list['Newsmanager']['description']),1,100);
    }
    else{
        echo"No description available";}?></li>
        </a>
 
  </div>
 
    <?php }
    
    ?>
    </ul>
    </div>-->
    <div style="float: left; padding: 5px "><h1>Widgets</h1>
  
    </div>
    </div><div class="clearfix"></div>
    <div class="row" >
<div class="span8" style="float: left; width: 70%; padding: 15px">
<?php $catlist=$this->requestAction('/archive/getCategory');

foreach($catlist as $show){
    ?>
     
<div class="category" style="float: left;width: 45%;border: 1px solid #F9F9F9;height: auto;display:block">
<h3><p style="padding: 10px"><a href="<?php echo $this->webroot;?>category/CategoryList/<?php echo $show['Categorymanager']['id'];?>"><?php echo $show['Categorymanager']['title'];?></a></p></h3>
<?php  $id=$show['Categorymanager']['id'];

$requst=$this->requestAction('archive/getNewsId/'.$id.'/'.$date);

if($requst){
//debug($requst);die();

foreach($requst as $fetch){
    $newsid=$fetch['News_category']['news_id'];
$ft=$this->requestAction('archive/getNewsContent/'.$newsid.'/'.$date);
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
</div>
<div class="span4">
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
Filter By Category: <br/><select class="categoryfilter">
<option value="0">select category </option>

<?php foreach($cat as $listcat){?>
<option value="<?php echo $listcat['Categorymanager']['id'];?>"><?php echo $listcat['Categorymanager']['title'];?></option>
<?php }?>
</select>
<br />
<div class="loader" style="display: none;"><img src="<?php echo $this->webroot;?>img/loader.gif"/></div>
Filter By News Standards:<br /><select class="standardfilter">
<option value="0">select standard</option>
<option value="1">National</option>
<option value="2">International</option>
</select>
<div class="substandardfilter" style="display: none;">
Region:<select name="region">
<option value="notnational">Select Region</option>
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
</div>
</form>
<div >
<h1>Archives</h1>

<?php
/*
$month=10;
$year=2015;
$this->requestAction('/new/days_in_month/'.$month.'/'.$year);*/
$dates=$this->requestAction('new/getDates');
 if($dates[0][0]==$dates[1][0]){
echo '<a class="year" href="#">'.$dates[0][0].'</a>';
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
    $res=$this->requestAction('archive/months_in_string/'.$j);
   echo '<option value="'.$j.'">';
    echo $res;
    echo '</option>';
    
    
 }
 ?>
 </select><br />
 
 <select class="dayhere" title="lalustine" style="display: none;">
 
 
 
 </select>
 <?php 
 

 ?>
 </div>
 </div>
 <?php
 ++$startyear;
        
    }
 }


?>


</div>
</div>

</div>   
<div class="clearfix"></div>
<div class="row">
<ul>
<h3>Mostly Viewed Post</h3>
<?php $result=$this->requestAction('/archive/findmostView/'.$date);

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
}}else{
    echo "<h5>NO POST AVAILABLE</h5>";
}
?>
</ul>
</div>
<div>
        <ul class="audioslider">
        
          <?php 
          if($slider){
          foreach($slider as $a)
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
             }}else{
                ?>
                <li><img src="<?php echo $this->webroot;?>img/no.png"width="980px" height="300px"/><h4></h4></li>
                <?php
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
           url: "<?php echo $this->webroot;?>archive/headLinefilter",
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
           url: "<?php echo $this->webroot;?>archive/newstandard",
            data: "standard="+id,
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
       url: "<?php echo $this->webroot;?>archive/checkview",
       data:"title="+title, 
       type:"post",
       //dataType:"html",
       success: function(response){
        alert(response);
       }
       
    });
    });
    
    /*--------------------------------------------------*/
       $(document.body).on('click','.year',function(){
     
     // $(this).parent().find('.yy').val(year);
     $(this).parent().find('.month').toggle("slow");
        
     });
           
    $(document.body).on('change','.months',function(){
     var month=$(this).val();
      var year=$(this).parent().parent().find('.year').attr('title'); 

      $.ajax({
        url:"<?php $this->webroot;?>days_in_month",
        data:"month="+month+"&year="+year,
        type:"post",
        success:function(response){
        
            var str='';
            var i=1;
            for(i;i<=response;i++){
                str=str+"<option value="+i+">"+i+"</option>";
            }
            
         $('.months').parent().find('.dayhere').html(str);
        
         
        }
      })
       $(this).parent().find('.dayhere').toggle("slow");
      });

     $(document.body).on('change','.dayhere',function(){
        var year=$(this).parent().parent().find('.year').attr('title');
        var month=$(this).parent().find('.months option:selected').val();
        var day=$(this).val();
        var date=year+"-"+month+"-"+day;
        window.location.href='http://localhost/hamroawaz/archive/'+date;
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
