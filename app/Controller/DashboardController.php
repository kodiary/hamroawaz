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
    
    function setting(){
        
    }
    function logout()
    {
        $this->Session->delete('admin');
        $this->redirect('/admin');
    }
    
  }
  ?> 