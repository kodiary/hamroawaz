<?php
    App::uses('CakeEmail', 'Network/Email');
class ArchiveController extends AppController
{
    function index($date)
    {
        //echo $date;die();
       
if(!($cachedate = Cache::read('cached_date'))) {
    Cache::write('cached_date', $date);
//$selectedate = Cache::read('cached_date');
}else{
     Cache::delete('cached_date');
     Cache::write('cached_date', $date);
}
$convert = new DateTime($date);
 $date=$convert->format('Y-m-d');

       $this->set('title','HamroAwaz');
       $this->loadModel('Categorymanager');
       $this->loadModel('Newsmanager');
       $qcat=$this->Categorymanager->find('all');
       $this->set('cat',$qcat);
       $arr['conditions']=array('created_date'=>$date);
       $slider=$this->Newsmanager->find('all',$arr);
       $this->set('slider',$slider);   
       $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$date),'order' => array('id' => 'DESC'),'limit'=>5));
       
         $this->set('val',$q);
         $this->set('date',$date);
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
    function getHeadline($date,$standard='0',$classname='0'){
       
        $this->loadModel('Newsmanager');
        
            if($standard=='0' && $classname=='0'){
        $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$date),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
       return $q;}else{
        if($classname=='0'){
         $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$date,'national'=>$standard),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
       return $q;}else{
        $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$date,'national'=>1,$classname=>$standard),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
       return $q;
       }
       }
        
 }
    
     function getCategory(){
      
         $this->loadModel('Categorymanager');
        $q=$this->Categorymanager->find('all',array(
                               'order' => array('id' => 'ASC'),
                               'limit'=>4
                               ));
        return $q;
    }
    
    
    
    function getNewsId($id,$date,$standard='0',$classname='0'){
      
 $this->loadModel('News_category');
 $this->loadModel('Newsmanager');
         $arr['conditions']=array('cat_id'=>$id);
    $q=$this->News_category->find('all',$arr);
    
if($q){
    
    foreach($q as $check){
        $nid=$check['News_category']['news_id'];
        
        if($classname=='0'&& $standard=='0'){
       $collect[]=$this->Newsmanager->find('first',array('conditions'=>array('id'=>$nid,'created_date'=>$date)));
      // debug($collect);die();
       }
       elseif($classname=='0'){
         $collect[]=$this->Newsmanager->find('first',array('conditions'=>array('id'=>$nid,'created_date'=>$date,'national'=>$standard)));
       }
       else{
         $collect[]=$this->Newsmanager->find('first',array('conditions'=>array('id'=>$nid,'created_date'=>$date,'national'=>1,$classname=>$standard)));
       }
    }
    $collect=array_filter($collect);
   //debug($collect);die();
    if(!empty($collect)){
        return $q;
    }
      }  

     }
     function getNewsContent($id,$date,$standard='0',$classname='0'){
       
       $this->loadModel('Newsmanager');
            if($standard=='0' && $classname=='0'){
        $arr['conditions']=array('id'=>$id,'created_date'=>$date);
        $arr['limit']=8;
        $q=$this->Newsmanager->find('all',$arr);
            return $q;
            }else{
                if($classname=='0'){
                $arr['conditions']=array('id'=>$id,'created_date'=>$date,'national'=>$standard);
                $arr['limit']=8;
        $q=$this->Newsmanager->find('all',$arr);
            return $q;}else{
                $arr['conditions']=array('id'=>$id,'created_date'=>$date,'national'=>1,$classname=>$standard);
                $arr['limit']=8;
        $q=$this->Newsmanager->find('all',$arr);
            return $q;
            }
            }
        
   
    }
    
        
        function Newsheadline($id){
       $this->loadModel('Newsmanager');
        $arr['conditions']=array('id'=>$id,'created_date'=>$yesterday);
        $q=$this->Newsmanager->find('all',$arr);
            return $q;
       
        }
        
        function newstandard(){
           // die('here');
        $this->layout='blank';    
       $standard=$_POST['standard'];
       $date=$_POST['date'];
      // echo $date = preg_replace('~\x{00a0}~u', ' ', $date);die();
       $convert = new DateTime($date);
      $date=$convert->format('Y-m-d');
       $this->set('title','HamroAwaz');
       $this->loadModel('Categorymanager');
       $this->loadModel('Newsmanager');
       $qcat=$this->Categorymanager->find('all');
       $this->set('cat',$qcat);
       $this->set('standard',$standard);
       $this->set('date',$date);
      // echo "response";die();
      
        }
        function checkstandard($standard,$date,$classname='0'){
            $this->loadModel('Newsmanager');
                    
             if($classname== '0'){
             $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$date,'national'=>$standard),'order' => array('id' => 'DESC'),'limit'=>5));
             return $q;
            }else{
       $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$date,'national'=>1,$classname=>$standard),'order' => array('id' => 'DESC'),'limit'=>5));
        
         return $q;
    }
   }
        function checkslider($standard,$date,$classname='0'){
            $this->loadModel('Newsmanager');
       if($classname=='0'){
       $arr['conditions']=array('created_date'=>$date,'national'=>$standard);
       $slider=$this->Newsmanager->find('all',$arr);
       return $slider;
       }else{
        $arr['conditions']=array('created_date'=>$date,'national'=>1,$classname=>$standard);
       $slider=$this->Newsmanager->find('all',$arr);
       return $slider;
       }
        
        }
        
       function newsubstandard(){
            
       $standard=$_POST['sub'];
       $classname=$_POST['classname'];
       $date=$_POST['date'];
       $this->set('title','HamroAwaz');
       $this->loadModel('Categorymanager');
       $this->loadModel('Newsmanager');
       $qcat=$this->Categorymanager->find('all');
       $this->set('cat',$qcat);
       $this->set('standard',$standard);
       $this->set('classname',$classname);
       $this->set('date',$date);
      
        }
        
 
 function checkview(){
    $title=$_POST['title'];
    $this->layout='blank'; 
    $this->loadModel('Newsmanager');
    $result=$this->Newsmanager->find('first',array('conditions'=>array('title'=>$title)));
    $view=$result['Newsmanager']['views'];
    $id=$result['Newsmanager']['id'];
    $view++;
    $data = array('id' => $id, 'views' =>$view);
    $this->Newsmanager->save($data);
   
 }
 
 function get_client_ip_server() {
	$ipaddress = '';
	if ($_SERVER['HTTP_CLIENT_IP'])
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if($_SERVER['HTTP_X_FORWARDED_FOR'])
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if($_SERVER['HTTP_X_FORWARDED'])
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if($_SERVER['HTTP_FORWARDED_FOR'])
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if($_SERVER['HTTP_FORWARDED'])
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if($_SERVER['REMOTE_ADDR'])
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';

	return $ipaddress;
}

function findmostView($date,$standard='0',$classname='0'){
    
    $this->loadModel('Newsmanager');
   
    if($standard=='0' && $classname=='0'){
    $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$date,'views !='=>'0')));
    }
    elseif($standard!='0' && $classname=='0'){
        $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$date,'national'=>$standard,'views !='=>'0')));
    }else{
        $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$date,'national'=>1,$standard=>$classname,'views !='=>'0')));
    }
    if(!empty($q)){
        $count=$this->Newsmanager->find('count',array('conditions'=>array('created_date'=>$date,'views !='=>'0')));
            foreach($q as $mostview){
                $arr[0]=$mostview['Newsmanager']['views'];
                $arr[1]=$mostview['Newsmanager']['id'];
                $assoc[]=$arr;
                        }
 
    rsort($assoc);
    for($i=0;$i<=$count-1;$i++){
        $resarr[]=$this->Newsmanager->find('first',array('conditions'=>array('views'=>$assoc[$i][0],'id'=>$assoc[$i][1])));
             }
  
    return $resarr;
      }else{
    $result='NULL';
    return $result;
        }
    }

function getDates(){
    $this->loadModel('Newsmanager');
    $result=$this->Newsmanager->find('all');
  foreach($result as $res){
    $date[]=$res['Newsmanager']['created_date'];
  }
$mindate= min($date);
$maxdate=max($date);
$min=explode('-',$mindate);
$max=explode('-',$maxdate);
return array($min, $max);
}

function days_in_month()
{
    
        $this->layout='blank';
 $month=$_POST['month'];
   
     $year=$_POST['year']; 
    echo  $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);

die();
} 

function months_in_string($month_int){
    switch($month_int){
        case '1': $month_string='January';
        break;
        case '2': $month_string='February';
        break;
        case '3': $month_string='March';
        break;
        case '4': $month_string='April';
        break;
        case '5': $month_string='May';
        break;
        case '6': $month_string='June';
        break;
        case '7': $month_string='July';
        break;
        case '8': $month_string='August';
        break;
        case '9': $month_string='September';
        break;
        case '10': $month_string='October';
        break;
        case '11': $month_string='November';
        break;
        case '12': $month_string='December';
        break;
    }
    return $month_string;
}

function checkDate(){
    $this->layout='blank';
   $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $date=$_POST['date'];
       
      $convert = new DateTime($date);
 $date=$convert->format('Y-m-d');
 
       if($date==$today){
        echo 'true';die();
       }else{
        echo 'false';die();
       }
}


    
  
}
?>