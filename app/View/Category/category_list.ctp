<script src="<?php echo $this->webroot;?>js/jquery.bxslider.min.js"></script>
<link href="<?php echo $this->webroot;?>css/jquery.bxslider.css" rel="stylesheet" />
<div class="main" style="margin: 30px auto;width: 980px;">
    <div>
    <ul><li style="float: left; padding: 0 10px;"><a href="<?php echo $this->webroot.'new/';?>"><strong>Home </strong></a></li>
    <?php
    //debug($cat);die();
     foreach($cat as $q)
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
  <li><a href="javascript:void(0)"><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>"width="50%"/><h4><?php echo $list['Newsmanager']['title'];?></h4>
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
    <div style="float: left; width: 70%; padding: 15px"><h1>  <?php 
     //debug($catvar);die();
     //debug($query);die();

     if(!empty($query)){
     
        echo $query['Categorymanager']['title'];
        
        }else{
            echo "No Title Available";
        }?></h1>
    <hr />
    <?php $var=$query['Categorymanager']['id'];
    $result=$this->requestAction('/category/getNewsId/'.$var);
    foreach($result as $res){
        //debug($res);die();
        $newsid=$res['News_category']['news_id'];
        //debug($newsid);die();
       $fres=$this->requestAction('/Category/getNews/'.$newsid);
       
    ?>
     <a href="<?php echo $this->webroot;?>description/detail/<?php echo $fres['Newsmanager']['id'];?>">
    <ul>
  <li><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $fres['Newsmanager']['image_file'];?>" width="200px" height="150px"/></li>
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li><h3><a href="javascript:void(0)"> <?php echo $fres['Newsmanager']['title'];?></a></h3></li>
  <li> <?php if($fres['Newsmanager']['description']){
    echo $fres['Newsmanager']['description'];
  }
    else{
        echo"No description available";}?></li>
 
  </div>
    </ul>
    </a>
    <?php }?>
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
