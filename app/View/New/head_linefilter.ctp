    <div style="float: left; width: 70%; padding: 15px" class="headline"><h1>Headline</h1>
    <hr />
    <ul>
    <?php

  if($value=='empty'){
echo 'No data found';
    }else{
        
    foreach($value as $list){
        $q=$this->requestAction('new/Newsheadline/'.$list['News_category']['news_id']);
        foreach($q as $result){
        
        ?>
    
    <a href="<?php echo $this->webroot;?>description/<?php echo $result['Newsmanager']['slug'];?>">
    <li><img src="<?php echo $this->webroot;?>news/image/thumb1/<?php echo $result['Newsmanager']['image_file'];?>" width="200px" height="150px"/></li>
  <div style="float: left;margin-left: 214px;margin-top: -159px">
  <li><h3> <?php echo $result['Newsmanager']['title'];?></h3></li>
  <li> <?php if($result['Newsmanager']['description']){
    echo substr(strip_tags($result['Newsmanager']['description']),1,100);
    }
    else{
        echo"No description available";}?></li>
        </a>
 
  </div>
 
    <?php }
    }
    }
    ?>
    </ul>
    </div>