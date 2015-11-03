<script src="<?php echo $this->webroot;?>js/jquery.bxslider.min.js"></script>
<link href="<?php echo $this->webroot;?>css/jquery.bxslider.css" rel="stylesheet" />
<div class="main" style="margin: 30px auto;width: 980px;">
    <div>
    <ul><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot;?>"><strong>Home </strong></a></li>
    <?php foreach($cat as $q)
    {
        ?><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot.'archivepage/'.$q['Categorymanager']['slug'];?> "><strong><?php echo $q['Categorymanager']['title']; ?></strong></a></li><?php
    }
    ?>
    </ul>
    </div><div class="clearfix"></div>
    <div >
    <ul class="contentslider">
     <?php 
    foreach($val as $list){
    ?>
  <li><a href="<?php echo $this->webroot;?>description/<?php echo $list['Newsmanager']['slug'];?>"><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>" class="view" title="<?php echo $list['Newsmanager']['title'];?>"/><h4><?php echo $list['Newsmanager']['title'];?></a></h4>
 <?php
 
 if($list['Newsmanager']['description']){
      echo substr($list['Newsmanager']['description'],0,100);
       echo '<br/><a class="view" title="'.$list['Newsmanager']['title'].'" href="'.$this->webroot.'description/'.$list['Newsmanager']['slug'].'">view</a>';
    }else{
        echo "<span style='color:red'>No Description Avaialble</span>";
    }
 
?>
  </li> 
    <?php }?>
    </ul>
    </div>
    <div class="clearfix"></div>
   
   <div>
    <div style="float: left; width: 70%; padding: 15px"><h1>  <?php 
     //debug($catvar);die();
     if(!empty($catname)){
     
        echo $catname['Categorymanager']['title'];
        
        }?></h1>
    <hr />
    <ul>
    <?php 
     //debug($catvar);die();
     if($catvar){
    foreach($catvar as $ask){
        //echo $ask['News_category']['news_id'].'_';continue;
        $qt=$this->requestAction('/archivepage/getHeadline/'.$ask['News_category']['news_id']);
        debug($qt);die();
      
    
    foreach($qt as $list){?>
    <li><a class="view" title="<?php echo $list['Newsmanager']['title'];?>" href="<?php echo $this->webroot;?>description/<?php echo $list['Newsmanager']['slug'];?>"> <img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>" width="200px" height="150px"/></a></li>
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li><h3><a href="javascript:void(0)"> <?php echo $list['Newsmanager']['title'];?></a></h3></li>
  <li> <?php if($list['Newsmanager']['description']){
    echo substr(strip_tags($list['Newsmanager']['description']),1,100);
    
    }
    else{
        echo"No description available";}?></li>
 
  </div>
 
    <?php }
    }
    }else{
       echo "No Content Available";
    }
    
    ?>
    </ul>
    </div>
    <div style="float: left; padding: 5px "><h1>Widgets</h1>
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
    </div>
    </div><div class="clearfix"></div>
    <div class="row" style="float: left; width: 70%; padding: 15px">
<div class="span8">

</div>
<div class="span4">
</div>

</div> 
  <div class="clearfix"></div>
  <div>
        <ul class="audioslider">
        
          <?php foreach($slider as $a)
            {
    ?><li>
    <?php  if($a['Newsmanager']['video']&&$a['Newsmanager']['audio']){?>
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
     <div class="clearfix"></div>
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
$(function(){
        /*--------------------------------------------------*/
    $('.view').click(function(){
       var title=$(this).attr('title');
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
})
</script>
