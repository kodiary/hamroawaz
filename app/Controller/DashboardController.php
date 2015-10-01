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
      // var_dump($_POST);die();
            $this->loadModel('New');
            $arr['title']=$_POST['title'];
            $arr['newscontent']=$_POST['description'];
           $arr['region_id']=$_POST['select'];
            $this->New->create();
            $this->New->save($arr);
            $this->redirect('news');
            
     
    }
    
    function setting(){
        
    }
    function logout()
    {
        $this->Session->delete('admin');
        $this->redirect('/admin');
    }
    
  }
  ?> 