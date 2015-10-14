<script src="<?php echo $this->webroot;?>js/jquery.bxslider.min.js"></script>
<link href="<?php echo $this->webroot;?>css/jquery.bxslider.css" rel="stylesheet" />
<div class="main" style="margin: 30px auto;width: 980px;">
    <div>
    <ul><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot.'new/';?>"><strong>Home </strong></a></li>
    <?php foreach($cat as $q)
    {
        ?><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot.'page/index/'.$q['Categorymanager']['id'];?> "><strong><?php echo $q['Categorymanager']['title']; ?></strong></a></li><?php
    }
    ?>
    </ul>
    </div><div class="clearfix"></div>
    <div >
    <ul class="contentslider">
     <?php 
    foreach($val as $list){
    ?>
  <li><a href="<?php echo $this->webroot;?>description/detail/<?php echo $list['Newsmanager']['id'];?>"><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>"width="50%"/><h4><?php echo $list['Newsmanager']['title'];?></h4>
 <?php
 
 if($list['Newsmanager']['description']){
      echo $list['Newsmanager']['description'];
    }else{
        echo "<span style='color:red'>No Description Avaialble</span>";
    }
 
?>
  </a></li> 
    <?php }?>
    </ul>
    </div>
    <div class="clearfix"></div>
    <div>
        <ul class="bxslider">
        
          <?php foreach($slider as $a)
            {
            ?><li><img src="<?php echo $this->webroot;?>slider/<?php echo $a['Newsmanager']['slider'];?>" title="<?php echo $a['Newsmanager']['title'];?>" width="100%" /></li><?php
            }
           ?>
        </ul>
    </div>
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
     if(!empty($catvar)){
    foreach($catvar as $ask){
        $qt=$this->requestAction('/page/getHeadline/'.$ask['News_category']['news_id']);
      
    
    foreach($qt as $list){?>
    <li><a href="<?php echo $this->webroot;?>description/detail/<?php echo $list['Newsmanager']['id'];?>"> <img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>" width="200px" height="150px"/></a></li>
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li><h3><a href="javascript:void(0)"> <?php echo $list['Newsmanager']['title'];?></a></h3></li>
  <li> <?php if($list['Newsmanager']['description']){
    echo $list['Newsmanager']['description'];
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
    <div class="row recent-work margin-bottom-40" style="margin: 30px auto;">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <h2><a href="portfolio.html">Slider</a></h2>
            <p>Lorem ipsum dolor sit amet, dolore eiusmod quis tempor incididunt ut et dolore Ut veniam unde voluptatem. Sed unde omnis iste natus error sit voluptatem.</p>
          </div>
         
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="owl-carousel owl-carousel3">
                <?php 
                if(!empty($catvar)){
                 foreach($catvar as $ask){
        $qt=$this->requestAction('/page/getHeadline/'.$ask['News_category']['news_id']);
    
    foreach($qt as $list){ ?>
              <div class="recent-work-item">
                <em>
                  <img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>" alt="Amazing Project" class="img-responsive">
                  <a href=""><i class="fa fa-link"></i></a>
                  <a href="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>" class="fancybox-button" title="Project Name #1" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                </em>
                <a class="recent-work-description" href="#">
                  <strong><?php echo $list['Newsmanager']['title'];?></strong>
                </a>
              </div>
                <?php }
                }
                }else{
       echo "No Content Available";
    }
     ?>
                
            </div>       
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
</script>
