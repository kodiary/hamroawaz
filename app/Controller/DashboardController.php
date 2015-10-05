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
       
    }
     function addNews(){
       
       $arr['is_headline']=$_POST['headline'];    
       debug($arr);die();   
            
           
     
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
  }
  ?> 