<?php
    App::uses('CakeEmail', 'Network/Email');
class NewController extends AppController
{
    function index()
    {
        $this->set('title','HamroAwaz');
        $this->loadModel('Categorymanager');
        $this->loadModel('Newsmanager');
        $qcat=$this->Categorymanager->find('all');
        $slider=$this->Newsmanager->find('all');
        $this->set('cat',$qcat);
        $this->set('slider',$slider);   
        
        
        $q=$this->Newsmanager->find('all',array(
                               'order' => array('id' => 'DESC'),
                               'limit'=>5
                               ));
        $this->set('val',$q);
    }
    
     function get_currency($from_Currency, $to_Currency, $amount) 
     {
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);

    $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_USERAGENT,
                 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('bld>', $rawdata);
    $data = explode($to_Currency, $data[1]);

    return round($data[0], 2);
    }
    function contact()
    {
        
    }
    function email()
    {
        $this->loadModel('Admin');
        $a=$this->Admin->find('first');
        $e= $a['Admin']['email'];
        $message="From:'".$_POST['name']."'</b>Subject:'".$_POST['sub']."'</br>Email:'".$_POST['email']."'</br>Feedback:'".$_POST['feedback']."'";
        $Email = new CakeEmail();
        $Email->from(array('me@example.com' => 'Hamroawaj'));
        $Email->to($e);
        $Email->subject('feedback');
        $Email->emailFormat('html');
        $Email->send($message);
        $this->Session->setFlash('ur message had been send');
        $this->redirect('/New/contact');
    }
    function currency()
    {
        
    }
    function getHeadline(){
      
         $this->loadModel('Newsmanager');
        $q=$this->Newsmanager->find('all',array(
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
        return $q;
    }
     function getCategory(){
      
         $this->loadModel('Categorymanager');
        $q=$this->Categorymanager->find('all',array(
                               'order' => array('id' => 'DESC'),
                               'limit'=>4
                               ));
        return $q;
    }
    function getNewsId($id){
         $this->loadModel('News_category');
          $q=$this->News_category->find('all',array('cat_id'=>$id));
                               
        return $q;
    }
    
}