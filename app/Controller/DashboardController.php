<?php
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
        $this->loadModel('Region');
          //$arr['conditions']=array('region.parent_id!='=>0);
        $q=$this->Region->find('all',array('conditions'=>array('Region.parent_id !='=>0)));
        $this->set('value',$q);
    }
     function addNews(){
      // var_dump($_POST);die();
            $this->loadModel('New');
            $arr['title']=$_POST['title'];
            $arr['newscontent']=$_POST['description'];
           $arr['region_id']=$_POST['select'];
            $this->New->create();
            $this->New->save($arr);
            $this->redirect('news');
            
     
    }
    function category(){
          $this->loadModel('Region');
          $arr['conditions']=array('region.parent_id'=>0);
        $q=$this->Region->find('all',$arr);
        $this->set('value',$q);
    }
    function addCategory(){
       // var_dump($_POST);die();
            $this->loadModel('Region');
            $arr['regioncategory']=$_POST['regionname'];
           $arr['parent_id']=$_POST['select'];
            $this->Region->create();
            $this->Region->save($arr);
            $this->redirect('category');
            
     
    }
    function setting()
    {
         $un= $this->Session->read('admin');
         $this->loadModel('Admin');
         $q=$this->Admin->find('first',array('conditions'=>array('username'=>$un)));
         $this->set('value',$q);
                      
    
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