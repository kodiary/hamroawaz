<script src="<?php echo $this->webroot;?>js/jquery.bxslider.min.js"></script>
<link href="<?php echo $this->webroot;?>css/jquery.bxslider.css" rel="stylesheet" />
<div class="main" style="margin: 30px auto;width: 980px;">
    <div>
    <ul><li style="float: left; padding: 0 10px;"><a href="#"><strong>Home</strong></a></li>
    <?php foreach($cat as $q)
    {
        ?><li style="float: left; padding: 0 10px;"><a href="#"><strong><?php echo $q['Categorymanager']['title']; ?></strong></a></li><?php
    }
    ?>
    </ul>
    </div><div class="clearfix"></div>
    <div class="marq">
     <marquee>
    <?php 
    foreach($val as $list){
    ?>
   <a href="javascript:void(0)"><?php echo $list['Newsmanager']['title'];?></a>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php }?>
    </marquee>
    </div>
    <div class="clearfix"></div>
    <div>
        <ul class="bxslider">
        
          <?php foreach($slider as $a)
            {
            ?><li><img src="<?php echo $this->webroot;?>slider/<?php echo $a['Newsmanager']['slider'];?>" /></li><?php
            }
           ?>
        </ul>
    </div>
   <div>
    <div style="float: left; width: 70%; padding: 15px"><h1>Headline</h1>
    <hr />
    <ul>
    <?php $query=$this->requestAction('/new/getHeadline');
    foreach($query as $list){?>
    <li><a href="javascript:void(0)"> <img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $list['Newsmanager']['image_file'];?>"/></a></li>
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li><h3><a href="javascript:void(0)"> <?php echo $list['Newsmanager']['title'];?></a></h3></li>
  <li> <?php if($list['Newsmanager']['description']){
    echo $list['Newsmanager']['description'];
    }
    else{
        echo"No description available";}?></li>
 
  </div>
 
    <?php }
    
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
<?php $catlist=$this->requestAction('/new/getCategory');
foreach($catlist as $show){
    ?>

<div class="category" style="float: left;width: 45%;border: 1px solid #F9F9F9;height: auto;display:block">
<h3><p style="padding: 10px"><?php echo $show['Categorymanager']['title'];?></p></h3>
<?php $id=$show['Categorymanager']['id'];
$requst=$this->requestAction('new/getNewsId/'.$id);
foreach($requst as $fetch){
    $newsid=$fetch['News_category']['news_id'];
?>
<div class="sub">

</div>
<?php }?>
</div>
<?php
}?>
</div>
<div class="span4">
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
</script>
