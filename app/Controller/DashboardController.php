<?php
App::uses('Resize','Lib');
App::load("Resize");
App::uses('Resizeslider','Lib');
App::load("Resizeslider");
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
      
      $error=0;
      if(isset($_POST)){
          $x1=$_POST['x1'];
         $y1=$_POST['y1'];
         $w=$_POST['w'];
         $h=$_POST['h'];
        $this->loadModel('Newsmanager');
        $images=$_FILES['image_file']['name'];
        
        $arr=explode('.',$images);
        
        $ext=end($arr);
        $rand=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        
         if($ext == 'jpg' || $ext == 'JPGE'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $path=APP.'/webroot/news/image/'.$rand;
        
        $thumbpath=APP.'/webroot/news/image/thumb/'.$rand;
        
         $thumbpath1=APP.'/webroot/news/image/thumb1/'.$rand;
        
        }else{
             $this->Session->setFlash('Invalid File Extension');  
             $error++;
                
 }
 $_POST['image_file']=$rand;
 
       $audio=$_FILES['audio']['name'];
        $arr=explode('.',$audio);
        $ext=end($arr);
        $randd=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        if($ext == 'mp3' || $ext == 'wav')
         {
        $path1=APP.'/webroot/news/audio/'.$randd;
          }else{
             $this->Session->setFlash('Invalid File Extension');    
              $error++;
        }
        $_POST['audio']=$randd;
      $slider=$_FILES['slider']['name'];
        if(!empty($_FILES['slider']['name'])){
        $arr=explode('.',$slider);
        $ext=end($arr);
        $rand2=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        if($ext == 'jpg' || $ext == 'JPGE'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $path2=APP.'/webroot/news/slider/'.$rand2;
         $_POST['slider']=$rand2;
 
       }
        else{
             $this->Session->setFlash('Invalid File Extension');    
             $error++;
            }
        }
      
    if($error==0){
        
        /* -------------Image Upload----------------*/
       
        move_uploaded_file($_FILES['image_file']['tmp_name'],$path);
        
         $resizeObj = new resize($path);
          $resizeObj -> resizeImage($w, $h,'exact');
         $resizeObj -> saveImage($thumbpath, 100);
         unset($resizeObj);
         $resizeObj = new resize($path);
         $resizeObj -> resizeImage(600, 432,'exact');
         $resizeObj -> saveImage($thumbpath1, 100);
         //unlink($path);
      /* -------------slider Upload----------------*/  
      if($_FILES['slider']['name']){
      move_uploaded_file($_FILES['slider']['tmp_name'],$path2);
       @chmod($path2, 0777);
         $thumbpath=APP.'/webroot/news/slider/thumb/'.$rand2;
         $thumbpath1=APP.'/webroot/news/slider/thumb1/'.$rand2;
        $resizeObj = new resize1($path2);
        $resizeObj -> resizeImage($w1,$h1,'landscape');
        $resizeObj -> saveImage($thumbpath, 100);
        unset($resizeObj);
        $resizeObj = new resize1($path2);
        $resizeObj -> resizeImage(940, 450,'landscape');
        $resizeObj -> saveImage($thumbpath1, 100);
       // unlink($path2);
       }
      /* -------------audio Upload----------------*/  
       move_uploaded_file($_FILES['audio']['tmp_name'],$path1);
        
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
    }
    }
      $this->redirect('news');
      $this->Session->setFlash('News have been succesfully Added!!');
 }
 
 function editNews($id){
    $this->loadModel('Newsmanager');
      
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
        //debug($_POST);die();
         $error=0;
       if(isset($_POST)){
        $_POST['x1'];
         $_POST['y1'];
        $w=$_POST['w'];
         $h=$_POST['h'];
        
         $this->loadModel('Newsmanager');
         $arr['conditions']=array('id'=>$id);
       $list=$this->Newsmanager->find('all',$arr);
       //echo $list['Newsmanager']['image'];die();
    foreach($list as $a){
    $a['Newsmanager']['slider'];
     $a['Newsmanager']['image_file'];
     $a['Newsmanager']['audio'];
     }
 
  if($_FILES['image_file']['name']){
          
        $images=$_FILES['image_file']['name'];
        $arr=explode('.',$images);
        $ext=end($arr);
        $rand=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
         if($ext == 'jpg' || $ext == 'JPGE'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $path=APP.'/webroot/news/image/'.$rand;
        
         $delimg=APP.'/webroot/news/image/thumb/'.$a['Newsmanager']['image_file'];
        $delimg1=APP.'/webroot/news/image/thumb1/'.$a['Newsmanager']['image_file'];
        }else{
             $this->Session->setFlash('Invalid File Extension');    
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
        $delaudio=APP.'/webroot/news/audio/'.$a['Newsmanager']['audio'];
      //  move_uploaded_file($_FILES['audio']['tmp_name'],$path1);
        }else{
             $this->Session->setFlash('Invalid File Extension');    
                $error++;
            
        }
     $_POST['audio']=$randd;
     }
        if($_FILES['slider']['name']){
        $slider=$_FILES['slider']['name'];
        if(!empty($_FILES['slider']['name'])){
        $arr=explode('.',$slider);
        $ext=end($arr);
        $rand2=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        if($ext == 'jpg' || $ext == 'JPGE'|| $ext == 'png'|| $ext == 'gif'|| $ext == 'JPG'|| $ext == 'PNG'|| $ext == 'GIF'){
        $path2=APP.'/webroot/news/slider/'.$rand2;
         $thumbpath=APP.'/webroot/news/slider/thumb/'.$rand2;
         $thumbpath1=APP.'/webroot/news/slider/thumb1/'.$rand2;
     $delslider=APP.'/webroot/news/slider/thumb/'.$a['Newsmanager']['slider'];
      $delslider1=APP.'/webroot/news/slider/thumb1/'.$a['Newsmanager']['slider'];
        }else{
             $this->Session->setFlash('Invalid File Extension');    
                $error++;
            
        }
        }
        $_POST['slider']=$rand2;
    }
    if($error==0){
    
    /* -------------Image Upload----------------*/
       //unlink($delimg);
       //unlink($delimg1);
       
  if($_FILES['image_file']['name']){
        move_uploaded_file($_FILES['image_file']['tmp_name'],$path);
      
        $thumbpath=APP.'/webroot/news/image/thumb/'.$rand;
         $thumbpath1=APP.'/webroot/news/image/thumb1/'.$rand;
         $resizeObj = new resize($path);
          $resizeObj -> resizeImage($w,$h,'exact');
         $resizeObj -> saveImage($thumbpath, 100);
         unset($resizeObj);
         $resizeObj = new resize($path);
         $resizeObj -> resizeImage(600, 432,'exact');
         $resizeObj -> saveImage($thumbpath1, 100);
         }
        // unlink($path);
      /* -------------slider Upload----------------*/  
      if($_FILES['slider']['name']){
      unlink($delslider);
      unlink($delslider1);
      move_uploaded_file($_FILES['slider']['tmp_name'],$path2);
       chmod($path2, 0777);
         $thumbpath=APP.'/webroot/news/slider/thumb/'.$rand2;
         $thumbpath1=APP.'/webroot/news/slider/thumb1/'.$rand2;
        $resizeObj = new resize1($path2);
        $resizeObj -> resizeImage($w1,$h1,'landscape');
        $resizeObj -> saveImage($thumbpath, 100);
        unset($resizeObj);
        $resizeObj = new resize1($path2);
        $resizeObj -> resizeImage(940, 450,'landscape');
        $resizeObj -> saveImage($thumbpath1, 100);
        //unlink($path2);
        }
      /* -------------audio Upload----------------*/  
      if($_FILES['audio']['tmp_name']){
       unlink($delaudio);
       move_uploaded_file($_FILES['audio']['tmp_name'],$path1);
    }
       $this->Newsmanager->id=$id;
       $this->Newsmanager->save($_POST);
       $this->loadModel('News_category');
       $cat=$_POST['category'];
       $cc='';
      foreach($cat as $ca){
        $arr1['cat_id']=$ca;
        $arr1['news_id']=$id;
       //$this->News_category->create();
       $this->News_category->save($arr1);
    }
    
    }
    //debug($arr1);die();
    $this->Session->setFlash('News have been succesfully updated'); 
     $this->redirect('news');
    }
    }

    function deleteNews($id){
        
    $this->loadModel('Newsmanager');
    $arr['conditions']=array('id'=>$id);
    $q=$this->Newsmanager->find('first',$arr);
    
    $img=$q['Newsmanager']['image_file'];
    $path=APP.'/webroot/news/image/thumb/'.$img;
    unlink($path);
    $pathh=APP.'/webroot/news/image/thumb1/'.$img;
    unlink($pathh);
    
     $audio=$q['Newsmanager']['audio'];
    $path1=APP.'/webroot/news/audio/'.$audio;
    unlink($path1);
   
     $slider=$q['Newsmanager']['slider'];
    $path2=APP.'/webroot/news/slider/thumb/'.$slider;
   // unlink($path2);
    $pathh2=APP.'/webroot/news/slider/thumb1/'.$slider;
    //unlink($pathh2);
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
        $cat=$this->Categorymanager->find('all');
        $this->set('cat',$cat);
    }
    function addcategory($id=0)
    {   
       $this->loadModel('Categorymanager');
       if(isset($_POST['title']) && $_POST['title'])
       $arr['title']=$_POST['title'];
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
    die();
    }
  }
  ?> 