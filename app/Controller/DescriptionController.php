<?php
    App::uses('CakeEmail', 'Network/Email');
class DescriptionController extends AppController{
    
    public function detail($id){
         $this->set('title','HamroawazDescription');
        $this->loadModel('Newsmanager');
        $arr['conditions']=array('id'=>$id);
        $query=$this->Newsmanager->find('first',$arr);
        
        $this->set('query',$query);
        $this->loadModel('Categorymanager');
       $pcat=$this->Categorymanager->find('all');
       
       $this->set('cat',$pcat);
       // $this->set('slider',$slider);   
        
        
        $q=$this->Newsmanager->find('all',array('order' => array('id' => 'DESC'),'limit'=>5));
        $this->set('val',$q);
        $this->loadModel('News_category');
        $qcat=$this->News_category->find('all',array('conditions'=>array('cat_id'=>$id)));
        $this->set('catvar',$qcat);
        
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
        $this->set('title','currency converter');
        
    }
    
}