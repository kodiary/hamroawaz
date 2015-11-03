<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=506034659558768";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script src="<?php echo $this->webroot;?>js/jquery.bxslider.min.js"></script>
<link href="<?php echo $this->webroot;?>css/jquery.bxslider.css" rel="stylesheet" />
<div class="main" style="margin: 30px auto;width: 980px;">
    <div>
    <ul><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot;?>"><strong>Home </strong></a></li>
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
     if($val){
    foreach($val as $list){
    ?>
  <li><a href="<?php echo $this->webroot;?>description/<?php echo $list['Newsmanager']['slug'];?>"><img class="view" title="<?php echo $list['Newsmanager']['title'];?>" src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>"/></a><h4><?php echo $list['Newsmanager']['title'];?></h4>
 <?php
 
 if($list['Newsmanager']['description']){
      echo substr($list['Newsmanager']['description'],0,100);
       echo '<br/><a class="view" title="'.$list['Newsmanager']['title'].'" href="'.$this->webroot.'description/'.$list['Newsmanager']['slug'].'">view</a>';
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
    <div style="float: left; width: 70%; padding: 15px"><h1>  <?php 
     //debug($catvar);die();
     //debug($query);die();
     if(!empty($query)){
     
        echo $query['Newsmanager']['title'];
        
        }else{
            echo "No Title Available";
        }?></h1>
    <hr />
    <ul>
  <li> <img src="<?php echo $this->webroot;?>news/image/thumb/<?php echo $query['Newsmanager']['image_file'];?>" /></li><br
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li> <?php if($query['Newsmanager']['description']){
    echo $query['Newsmanager']['description'];
    ?>
    
    <div class="fb-like"  data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
  
    <?php
  }
    else{
        echo"No description available";}?>
     
</li>
<div class="fb-comments" data-width="600" data-numposts="100"></div>
 
  </div>
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
    <div class="clearfix"></div>
    <div>
    <h1>Related News</h1>
    <ul>
    <?php  $fid=$query['Newsmanager']['id'];
   // echo $fid;die('here');
    $output= $this->requestAction('/description/getCategoryId/'.$fid);
    
   foreach ($output as $similarnews){
    $nid=$similarnews['News_category']['news_id'];
    
    if($nid!=$fid){
        $simnews=$this->requestAction('/description/getSimilarnews/'.$nid);
        //debug($simnews);die();
        if($simnews!='NULL'){
        ?>
        <a class="view" title="<?php echo $simnews['Newsmanager']['title'];?>" href="<?php echo $this->webroot;?>description/<?php echo $simnews['Newsmanager']['slug'];?>">
    <li><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $simnews['Newsmanager']['image_file'];?>"  /></li>
  <div>
  <li><h3> <?php echo $simnews['Newsmanager']['title'];?></h3></li>
  <li> <?php if($simnews['Newsmanager']['description']){
    echo substr(strip_tags($simnews['Newsmanager']['description']),1,100);
    }
    else{
        echo"No description available";}?></li>
        </a>
 
  </div>
        
        
        <?php
        }
    }else{
      // echo 'no need to show';
    }
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
$(function(){
    $('.view').click(function(){
       var title=$(this).attr('title');
      // alert(title);
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
