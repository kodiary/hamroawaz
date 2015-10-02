<?php
class AdminController extends AppController
{
    function index()
    {
        if($this->Session->read('admin'))
        {
            $this->redirect('/dashboard'); //to redirect to different controller use '/' before the controller name.heredashboard is controller.and if dashboard ko some function like index is to be accesed its followed by '/index'
        }
        else
        {
            $this->redirect('login'); //login funtion
        }
    }
    
    function login()
    {
        $this->layout="login";
        if($this->Session->read('admin'))
        {
            $this->redirect('/dashboard'); 
        }
    }
    
    function loginVerify()
    {
        $this->loadModel('Admin');
        
        if(isset($_POST) && $_POST)
        {
            $q=$this->Admin->find('first',array('conditions'=>array('username'=>$_POST['un'] , 'password'=>$_POST['pw'])));
            if($q)
            {
                $this->Session->write('admin',$_POST['un']);
            }
            $this->redirect('login'); 
                      
        }
        
        
    }
}

?>