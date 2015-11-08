<?php
App::uses('Resize','Lib');
App::load("Resize");

class DashboardController extends AppController
{
    
    function beforeFilter() //is called before any other function is called
    {
    
        $this->layout='admin';
        
        if(!$this->Session->read('admin'))
        {
            $this->redirect('/admin');
        }
    }
    
    function index()
    {
       
    }
    
    function news(){
       $this->loadModel('Categorymanager');
       $q= $this->Categorymanager->find('all',array('order' => array('display_order' => 'asc')));
       $this->set('order',$q);
       $this->loadModel('Newsmanager');
       $a=$this->Newsmanager->find('all');
       $this->set('list',$a);
    }
     function addNews(){
       // debug($_POST);die();
              $error=0;
        if(isset($_POST)){
         $dateObject = new DateTime(date('Y-m-d G:i:s'));
        $date=$dateObject->format('Y-m-d'); 
        $_POST['created_date']=$date;
         $slug=$this->checkSlug($_POST['slug']);
         
         //echo $slug;die();
         $_POST['slug']=$slug;
        $this->loadModel('Newsmanager');
        $images=$_FILES['image_file']['name'];
        
        $arr=explode('.',$images);
       $ext=end($arr);
        $rand=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        if($ext == 'jpg' || $ext == 'JPGE'||$ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $mainimage=APP.'/webroot/news/image/main/'.$rand;
        $largeimage=APP.'/webroot/news/image/thumb/'.$rand;
        $smallimage=APP.'/webroot/news/image/thumb1/'.$rand;
        $croppedimage=APP.'/webroot/news/image/croppedimage/'.$rand;
        }else{
             $this->Session->setFlash('Invalid File Extension');  
             $error++;
                }
         $_POST['image_file']=$rand;
         
         if(!isset($_POST['category'])){
             $this->Session->setFlash('No category have been selected');  
             $error++;
         }
         $audio=$_FILES['audio']['name'];
       if(!empty($_FILES['audio']['name'])){
        $arr=explode('.',$audio);
        $ext=end($arr);
        $randd=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        if($ext == 'mp3' || $ext == 'wav')
         {
        $path1=APP.'/webroot/news/audio/'.$randd;
          }
           $_POST['audio']=$randd;
          }
         
          
      $slider=$_FILES['slider']['name'];
        if(!empty($_FILES['slider']['name'])){
        $arr=explode('.',$slider);
        $ext=end($arr);
        $rand2=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        $slidename=rand(100000,999999).rand(100000,999999).'.'.$ext;
        if($ext == 'jpg' || $ext == 'JPGE'||$ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $path2=APP.'webroot/slider/main/'.$rand2;
         $pathslide=APP.'webroot/slider/'.$rand2;
         $_POST['slider']=$rand2;
 
       }
       
        }
      //debug($_POST);die();
    if($error==0){
        
        /* -------------Image Upload----------------*/
        $x1=$_POST['x1'];
         $y1=$_POST['y1'];
         $w=$_POST['w'];
         $h=$_POST['h'];
       
        move_uploaded_file($_FILES['image_file']['tmp_name'],$mainimage);
        $resizeObj = new resize($mainimage);
         $resizeObj -> resizeImage($w, $h,'exact',$_POST['x1'],$_POST['y1']);
         $resizeObj -> saveImage($croppedimage, 100);
         unset($resizeObj);
          $resizeObj = new resize($croppedimage);
         $resizeObj -> croppedimage(600, 400,'exact');
         $resizeObj -> saveImage($largeimage, 100);
         unset($resizeObj);
          $resizeObj = new resize($croppedimage);
         $resizeObj -> croppedimage(300,200,'exact');
         $resizeObj -> saveImage($smallimage, 100);
        unset($resizeObj);
        //unlink($croppedimage);
      /* -------------slider Upload----------------*/  
      if($_FILES['slider']['name']){
      move_uploaded_file($_FILES['slider']['tmp_name'],$path2);
        $resizeObj = new resize($path2);
        $resizeObj -> resizeImage(980,290,'exact');
        $resizeObj -> saveImage($pathslide, 100);
       }
      /* -------------audio Upload----------------*/
      if($_FILES['audio']['tmp_name']) { 
       move_uploaded_file($_FILES['audio']['tmp_name'],$path1);
       }
        
       $this->Newsmanager->create();
       $this->Newsmanager->save($_POST);
        $id=$this->Newsmanager->getLastInsertID();
       $this->loadModel('News_category');
       $cat=$_POST['category'];
       $cc='';
      foreach($cat as $ca){
        $arr1['cat_id']=$ca;
        $arr1['news_id']=$id;
       $this->News_category->create();
       $this->News_category->save($arr1);
    }
     $this->redirect('news');
      $this->Session->setFlash('News have been succesfully Added!!');
    }
    }
     
 }
 
 function editNews($id){
    $this->loadModel('Newsmanager');
      $dateObject = new DateTime(date('Y-m-d G:i:s'));
        $date=$dateObject->format('Y-m-d'); 
        $_POST['created_date']=$date;
    $arr['conditions']=array('id'=>$id);
   // $this->Newsmanager->id=$id;
    $q=$this->Newsmanager->find('first',$arr);
    $this->set('edit',$q);
     $this->loadModel('Categorymanager');
     $q= $this->Categorymanager->find('all',array('order' => array('display_order' => 'asc')));
     $this->set('order',$q);
     $this->loadModel('News_category');
     $arr1['conditions']=array('news_id'=>$id);
     $a=$this->News_category->find('all',$arr1);
     $this->set('list',$a);
    }
    
    function updateNews($id){
        
         $error=0;
       if(isset($_POST)){
      $timestamp = date('Y-m-d G:i:s');
    $_POST['created_date']=$timestamp;
    $this->loadModel('Newsmanager');
     $arr['conditions']=array('id'=>$id);
      $list=$this->Newsmanager->find('all',$arr);
       //echo $list['Newsmanager']['image'];die();
    foreach($list as $a){
    $a['Newsmanager']['slider'];
     $a['Newsmanager']['image_file'];
     $a['Newsmanager']['audio'];
     }
 
  if(isset($_FILES['image_file']['name'])&&$_FILES['image_file']['name']){
         
        $images=$_FILES['image_file']['name'];
        $arr=explode('.',$images);
        $ext=end($arr);
        $rand=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
         if($ext == 'jpg' || $ext == 'JPGE'||$ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $mainimage=APP.'/webroot/news/image/main/'.$rand;
        $largeimage=APP.'/webroot/news/image/thumb/'.$rand;
        $smallimage=APP.'/webroot/news/image/thumb1/'.$rand;
        $croppedimage=APP.'/webroot/news/image/croppedimage/'.$rand;
        $deletelarge=APP.'/webroot/news/image/thumb/'.$a['Newsmanager']['image_file'];
        $deletesmall=APP.'/webroot/news/image/thumb1/'.$a['Newsmanager']['image_file'];
        $deletecropped=APP.'/webroot/news/image/croppedimage/'.$a['Newsmanager']['image_file'];
        $deletemain=APP.'/webroot/news/image/main/'.$a['Newsmanager']['image_file'];
        }else{
             $this->Session->setFlash('Invalid Image Extension');    
               $error++;
 }
 $_POST['image_file']=$rand;
     }   
     if($_FILES['audio']['name']){
        
        $audio=$_FILES['audio']['name'];
      
        $arr=explode('.',$audio);
        $ext=end($arr);
        $randd=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
          if($ext == 'mp3' || $ext == 'wav')
                {
        $path1=APP.'/webroot/news/audio/'.$randd;
        if($a['Newsmanager']['audio']){
        $delaudio=APP.'/webroot/news/audio/'.$a['Newsmanager']['audio'];
        }else{
             $delaudio='';
        }
       
        } 
        $_POST['audio']=$randd;
            
        }
    
     
        if(isset($_FILES['slider']['name'])&& $_FILES['slider']['name']){
        $slider=$_FILES['slider']['name'];
        if(!empty($_FILES['slider']['name'])){ 
        $arr=explode('.',$slider);
        $ext=end($arr);
        $rand2=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        
        if($ext == 'jpg' || $ext == 'JPGE'||$ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $path2=APP.'/webroot/slider/main/'.$rand2;
        $pathslide=APP.'webroot/slider/'.$rand2;
     
       $delslider=APP.'/webroot/slider/'.$a['Newsmanager']['slider'];
         $delslidermain=APP.'/webroot/slider/main/'.$a['Newsmanager']['slider'];
        }
        }
        $_POST['slider']=$rand2;
    }
    if($error==0){
    
    /* -------------Image Upload----------------*/
      if(isset($_FILES['image_file']['name'])&&$_FILES['image_file']['name']){
       $x1=$_POST['x1'];
         $y1= $_POST['y1'];
        $w=$_POST['w'];
         $h=$_POST['h'];
  
      unlink($deletesmall);
     unlink($deletelarge);
     unlink($deletecropped);
     unlink($deletemain);
     // unlink($delimg);
  move_uploaded_file($_FILES['image_file']['tmp_name'],$mainimage);
       
       $resizeObj = new resize($mainimage);
         $resizeObj -> resizeImage($w, $h,'exact',$_POST['x1'],$_POST['y1']);
         $resizeObj -> saveImage($croppedimage, 100);
         unset($resizeObj);
          $resizeObj = new resize($croppedimage);
         $resizeObj -> croppedimage(600, 400,'exact');
         $resizeObj -> saveImage($largeimage, 100);
         unset($resizeObj);
          $resizeObj = new resize($croppedimage);
         $resizeObj -> croppedimage(300,200,'exact');
         $resizeObj -> saveImage($smallimage, 100);
        unset($resizeObj);
         }
        
      /* -------------slider Upload----------------*/  
      if(isset($_FILES['slider']['name'])&&$_FILES['slider']['name']){

        unlink($delslider);
        unlink($delslidermain);
      move_uploaded_file($_FILES['slider']['tmp_name'],$path2);
        $resizeObj = new resize($path2);
        $resizeObj -> resizeImage(980,290,'exact');
        $resizeObj -> saveImage($pathslide, 100);
        }
      /* -------------audio Upload----------------*/  
      if(isset($_FILES['audio']['tmp_name'])&&$_FILES['audio']['tmp_name']){
        if($delaudio!=''){
          //  die('yes audio');
            unlink($delaudio);
        }else{
          //  die('no audio');
        }
        move_uploaded_file($_FILES['audio']['tmp_name'],$path1);
    }
       $this->Newsmanager->id=$id;
       $this->Newsmanager->save($_POST);
       $this->loadModel('News_category');
       $cat=$_POST['category'];
       $cc='';
       $this->calldeletenewsCategory($id);
       
      foreach($cat as $ca){
       
        $arr1['cat_id']=$ca;
        $arr1['news_id']=$id;
       $this->News_category->create();
       $this->News_category->save($arr1);
    }
    $this->Session->setFlash('News have been succesfully updated'); 
     $this->redirect('news');
    }
    }
    }

    function deleteNews($id){
        
    $this->loadModel('Newsmanager');
    $arr['conditions']=array('id'=>$id);
    $q=$this->Newsmanager->find('first',$arr);
    
    $img=$q['Newsmanager']['image_file'];
    $path=APP.'/webroot/news/image/thumb1/'.$img;
    $ppath=APP.'/webroot/news/image/thumb/'.$img;
    $mainpath=APP.'/webroot/news/image/main/'.$img;
    $cropped=APP.'/webroot/news/image/croppedimage/'.$img;
    unlink($mainpath);
    unlink($path);
   unlink($ppath);
   unlink($cropped);
   $audio=$q['Newsmanager']['audio'];
    if($audio){
    $path1=APP.'/webroot/news/audio/'.$audio;
    unlink($path1);
   }
   
   
   $slider=$q['Newsmanager']['slider'];
    if($slider){
    $path2=APP.'/webroot/slider/'.$slider;
    unlink($path2);}
    
    $this->Newsmanager->delete($id);
    $this->calldeletenewsCategory($id);
    $this->Session->setFlash('News Have been successfully deleted!!'); 
    $this->redirect('news');
    }
      function calldeletenewsCategory($id){
        $this->loadModel('News_category');
        $arr['conditions']=array('news_id'=>$id);
        $q=$this->News_category->find('all',$arr);
        foreach($q as $del){
        $this->News_category->delete($del['News_category']['id']);
        }
           return true;
    }

    function setting()
    {
         $un= $this->Session->read('admin');
         $this->loadModel('Admin');
         $q=$this->Admin->find('first',array('conditions'=>array('username'=>$un)));
         $this->set('value',$q);
                      
    

    }
    function deletenewsCategory($id){
        $this->loadModel('News_category');
        $this->News_category->delete($id);
        $this->redirect('news_category');
        
    }
    
    function logout()
    {
        $this->Session->delete('admin');
        $this->redirect('/admin');
    }
    function update($id=0)
    {
         $this->loadModel('Admin');
         $arr['username']=$_POST['username'];
         $ar['email'] = $_POST['email'];
         if(isset($_POST['newpassword']) && $_POST['newpassword'])
         $arr['password']=$_POST['newpassword'];
         if(isset($_POST['pw']) && $_POST['pw'])
         {
            $check = $this->Admin->find('first',array('conditions'=>array('id'=>$id)));
            if($check['Admin']['password']!=$_POST['pw'])
            {
                $this->Session->setFlash('old password doesnot match');
                $this->redirect('/Dashboard/setting');
            }
            
         }
         $this->Session->write('admin',$arr['username']);
         $this->Admin->id = $id;
         $this->Admin->save($arr);
         $this->Session->setFlash('ur account have been updated');
         $this->redirect('/Dashboard/setting');
         
         
         
         
         
    }
    function category()
    {
        $this->loadModel('Categorymanager');
        $cat=$this->Categorymanager->find('all',array('order'=>array('display_order ASC')));
        $this->set('cat',$cat);
    }
    function addcategory($id=0)
    {   
       $this->loadModel('Categorymanager');
       if(isset($_POST['title']) && $_POST['title'])
       $arr['title']=$_POST['title'];
       $arr['slug']=$_POST['slug'];
       if($id==0)
       {
       $this->Categorymanager->create();
       $this->Categorymanager->save($arr);
       $this->redirect('/category');
       }
       $this->Categorymanager->id=$id;
       $this->Categorymanager->save($arr);
       $this->redirect('/category');

    
    }
    function del($id)
    {
        $this->loadModel('Categorymanager');
        $this->Categorymanager->delete($id);
        $this->redirect('/category');
    }
    function order()
    {
    $this->loadModel('Categorymanager');
    foreach($_POST['id'] as $v=>$k)
    {
        $this->Categorymanager->id=$k;
       $this->Categorymanager->saveField('display_order', ++$v);   
    }
    }
    function slider()
    {
        
    }
    function sliderImage()
    {
        $this->loadModel('Slider');
        $this->layout='blank';
        $name=$_FILES['image']['name'];
        $source = $_FILES['image']['tmp_name'];
        list($width, $height) = getimagesize($source);
        if($width>630 && $height>290)
        {
        $arr=explode('.',$name);
        $ext=end($arr);
        $rand=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        $path=APP.'/webroot/slider/'.$rand;
        move_uploaded_file($source,$path);
        $arr['image']=$rand;
        $this->Slider->create();
        $this->Slider->save($arr);
        $a=$this->webroot;
       
        echo '<img src="'.$a.'slider/'.$rand.'" />';
        die();
        }
        else{
        $this->Session->setFlash('plz uplode bigger size image');
         $this->redirect('/Dashboard/slider');
         }
    }
    function pagemanager()
    {
      $this->loadModel('Pagemanager');
      $q=$this->Pagemanager->find('all');
      $this->set('q',$q);  
    }
    function addpagemanager()
    {
        $this->loadModel('Pagemanager');
        $arr['description']=$_POST['des'];
        $arr['title']=$_POST['title'];
        if(isset($_POST['id']) &&$_POST['id'])
        {
            $id =$_POST['id'];
            $this->Pagemanager->id=$id;
            $this->Pagemanager->save($arr);            
        }
        else{
           $this->Pagemanager->create();
        $this->Pagemanager->save($arr); 
        }
        $q=$this->Pagemanager->find('all');
        $this->layout = 'blank';
        $this->set('q',$q);
    }
    function editpage()
    {
        $this->layout = 'blank';
        $id=$_POST['id'];
        $this->loadModel('Pagemanager');
        $q=$this->Pagemanager->find('first',array('conditions'=>array('id'=>$id))); 
        echo $q['Pagemanager']['title'];
        echo "_";
        echo $q['Pagemanager']['description'];
        echo "_";
        echo $q['Pagemanager']['id'];
        
        die();
    }
    function deletepage()
    {
        $this->layout = 'blank';
        $this->loadModel('Pagemanager');
        $this->Pagemanager->delete($_POST['id']);
        $q=$this->Pagemanager->find('all');
        $this->set('q',$q);
    }
    
    function getSlug(){
    
    $str=$_POST['title'];
    $this->layout='blank';
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    echo $clean;die();
    }
    function checkSlug($slug){
         $this->loadModel('Newsmanager');
       
       $arr['conditions']=array('slug'=>$slug);
       $q= $this->Newsmanager->find('first',$arr);
      
       
       if($q){
       $id=$q['Newsmanager']['id'];
        $slug=$slug.$id;
        
       }
        return $slug;
      
      
    }    

  }
  ?>