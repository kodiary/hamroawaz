<?php
    App::uses('CakeEmail', 'Network/Email');
class ArchivepageController extends AppController
{
    function index($slug,$date)
    {
        
      
       // $cachedate=$convert->format('Y-m-d');
        //$this->set('cachedate',$cachedate);
        $this->set('date',$date);
        $this->set('title','HamroawazPage');
        $this->loadModel('Categorymanager');
        $this->loadModel('Newsmanager');
        $pcat=$this->Categorymanager->find('all');
         $this->set('cat',$pcat);
        $catname = $this->Categorymanager->find('first',array(
        'conditions'=>array('slug'=>$slug)
        ));
        //debug($catname['Categorymanager']['id']);die();
        $this->set('catname',$catname);
        $slider=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$date)));
         $this->set('slider',$slider);
        $q=$this->Newsmanager->find('all',array(
                                'conditions'=>array('created_date'=>$date),
                               'order' => array('id' => 'DESC'),
                               'limit'=>5
                               ));
                $this->set('val',$q);
        
        $this->loadModel('News_category');
        $qcat=$this->News_category->find('all',array(
                                'conditions'=>array('cat_id'=>$catname['Categorymanager']['id']),
                               ));
                               
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
    function getHeadline($id,$date){
         
        $convert=new DateTime($date);
        $date=$convert->format('Y-m-d');
        $this->loadModel('Newsmanager');
         $q=$this->Newsmanager->find('all',array('conditions'=>array('id'=>$id,'created_date'=>$date),'order' => array('id' => 'DESC')));
        
         return $q;
         
            }
            
     function getCategory(){
      
         $this->loadModel('Categorymanager');
        $q=$this->Categorymanager->find('all',array(
                               'order' => array('id' => 'ASC'),
                               'limit'=>4
                               ));
        return $q;
    }
    function getNewsId($id){
 $this->loadModel('News_category');
         $arr['conditions']=array('cat_id'=>$id);
    $q=$this->News_category->find('all',$arr);
   // debug($q);die();
    
        return $q;

     }
     function getNewsContent($id){
        $current=strtotime(date('Y-m-d G:i:s'));
       $checktime=strtotime(date('Y-m-d G:i:s',mktime(10,0,0, date("m") , date("d"),date("Y"))));
       $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $yesterday = date("Y-m-d", mktime(0,0,0, date("m") , date("d")-1,date("Y")));
         $this->loadModel('Newsmanager');
         if($checktime>=$current){
     $arr['conditions']=array('id'=>$id,'created_date'=>$yesterday);
        $q=$this->Newsmanager->find('all',$arr);
      
        return $q;
        }else{
              $arr['conditions']=array('id'=>$id,'created_date'=>$today);
        $q=$this->Newsmanager->find('all',$arr);
        return $q;
        }
             
    }
  
}
?>