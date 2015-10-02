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
       //debug($_POST);die();
        $this->loadModel('Newsmanager');
        
        
        $images=$_FILES['image']['name'];
        if(!empty($_FILES['image']['name'])){
        $arr=explode('.',$images);
        $ext=end($arr);
        $rand=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        $path=APP.'/webroot/news/image/'.$rand;
        $thumbpath=APP.'/webroot/news/image/thumb/'.$rand;
         $thumbpath1=APP.'/webroot/news/image/thumb1/'.$rand;
        move_uploaded_file($_FILES['image']['tmp_name'],$path);
         $resizeObj = new resize($path);
                 $resizeObj -> resizeImage(250, 180,'exact');
                 $resizeObj -> saveImage($thumbpath, 100);
                 unset($resizeObj);
                 $resizeObj = new resize($path);
                 $resizeObj -> resizeImage(600, 432,'exact');
                $resizeObj -> saveImage($thumbpath1, 100);
                 unlink($path);
        }
        $_POST['image']=$rand;
        $audio=$_FILES['audio']['name'];
        if(!empty($_FILES['audio']['name'])){
        $arr=explode('.',$audio);
        $ext=end($arr);
        $randd=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        $path=APP.'/webroot/news/audio/'.$randd;
        move_uploaded_file($_FILES['audio']['tmp_name'],$path);
        
        }
        $_POST['audio']=$randd;
        
        $slider=$_FILES['slider']['name'];
        if(!empty($_FILES['slider']['name'])){
        $arr=explode('.',$slider);
        $ext=end($arr);
        $rand2=rand(100000,999999).'_'.rand(100000,999999).'.'.$ext;
        $path=APP.'/webroot/news/slider/'.$rand2;
        move_uploaded_file($_FILES['slider']['tmp_name'],$path);
         $thumbpath=APP.'/webroot/news/slider/thumb/'.$rand2;
         $thumbpath1=APP.'/webroot/news/slider/thumb1/'.$rand2;
        $resizeObj = new resize($path);
                 $resizeObj -> resizeImage(250, 180,'exact');
                 $resizeObj -> saveImage($thumbpath, 100);
                 unset($resizeObj);
                 $resizeObj = new resize($path);
                 $resizeObj -> resizeImage(940, 450,'exact');
                $resizeObj -> saveImage($thumbpath1, 100);
                 unlink($path);
        }
        $_POST['slider']=$rand2;
    
    
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
 }
    function editNews($id){
    $this->loadModel('Newsmanager');
    $this->Newsmanager->id=$id;
    $q=$this->Newsmanager->find('first');
    $this->set('edit',$q);
    }

    function deleteNews($id){
    $this->loadModel('Newsmanager');
    $arr['conditions']=array('id'=>$id);
    $q=$this->Newsmanager->find('first',$arr);
    $img=$q['Newsmanager']['image'];
    $path=APP.'/webroot/news/image/thumb/'.$img;
    unlink($path);
    $pathh=APP.'/webroot/news/image/thumb1/'.$img;
    unlink($pathh);
    
     $audio=$q['Newsmanager']['audio'];
    $path1=APP.'/webroot/news/audio/'.$audio;
    unlink($path1);
   
     $slider=$q['Newsmanager']['slider'];
    $path2=APP.'/webroot/news/slider/thumb/'.$slider;
    unlink($path2);
    $pathh2=APP.'/webroot/news/slider/thumb1/'.$slider;
    unlink($pathh2);
    $this->Newsmanager->delete($id);
    $this->calldeletenewsCategory($id);
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
    
  }
  ?> 