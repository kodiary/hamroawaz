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
    <div>
        <ul class="bxslider">
          <?php foreach($slider as $a)
            {
            ?><li><img src="<?php echo $this->webroot; ?>slider/<?php echo $a['Slider']['image']; ?>" /></li><?php
            }
           ?>
        </ul>
    </div>
   <div>
    <div style="float: left; width: 80%; padding: 15px"><h1>Heading</h1>
    <hr />
    </div>
    <div style="float: left; padding: 5px "><h1>Widgets</h1>
    <hr />
    <h2>Currency</h2>
    <hr />
        <a href="<?php echo $this->webroot; ?>New/currency">Currency Converter</a>
    </div>
    </div><div class="clearfix"></div>
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
