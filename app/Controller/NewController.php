<?php
    App::uses('CakeEmail', 'Network/Email');
class NewController extends AppController
{
    function index()
    {
        


       $current=strtotime(date('Y-m-d G:i:s'));
       $checktime=strtotime(date('Y-m-d G:i:s',mktime(10,0,0, date("m") , date("d"),date("Y"))));
       $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $yesterday = date("Y-m-d", mktime(0,0,0, date("m") , date("d")-1,date("Y")));
       $this->set('title','HamroAwaz');
       $this->loadModel('Categorymanager');
       $this->loadModel('Newsmanager');
       $qcat=$this->Categorymanager->find('all');
       $this->set('cat',$qcat);
       if($checktime>=$current ){
       $arr['conditions']=array('created_date'=>$yesterday);
       $slider=$this->Newsmanager->find('all',$arr);
       $this->set('slider',$slider);   
       $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$yesterday),'order' => array('id' => 'DESC'),'limit'=>5));
         $this->set('val',$q);
           
        }
       if($checktime < $current ){
       $arr['conditions']=array('created_date'=>$today);
       $slider=$this->Newsmanager->find('all',$arr);
       $this->set('slider',$slider);   
       //die('lalustine');
       $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$today),'order' => array('id' => 'DESC'),'limit'=>5));
         $this->set('val',$q);
        }
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
    function getHeadline($standard='0',$classname='0'){
        $current=strtotime(date('Y-m-d G:i:s'));
       $checktime=strtotime(date('Y-m-d G:i:s',mktime(10,0,0, date("m") , date("d"),date("Y"))));
       $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $yesterday = date("Y-m-d", mktime(0,0,0, date("m") , date("d")-1,date("Y")));
        $this->loadModel('Newsmanager');
         if($checktime>=$current ){
            if($standard=='0' && $classname=='0'){
        $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$yesterday),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
       return $q;}else{
        if($classname=='0'){
         $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$yesterday,'national'=>$standard),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
       return $q;}else{
        $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$yesterday,'national'=>1,$classname=>$standard),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
       return $q;
       }
       }
        }else{
            if($standard=='0' && $classname=='0'){
            $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$today),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
          return $q;
          }else{
            if($classname=='0'){
          $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$today,'national'=>$standard),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
                               return $q;
            }else{
                $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$today,'national'=>1,$classname=>$standard),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
                               return $q;
            }
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
    
    
    
    function getNewsId($id){
        
 $this->loadModel('News_category');
 
         $arr['conditions']=array('cat_id'=>$id);
    $q=$this->News_category->find('all',$arr);
   // debug($q);die();
    
        return $q;

     }
     function getNewsContent($id,$standard='0',$classname='0'){
        $current=strtotime(date('Y-m-d G:i:s'));
       $checktime=strtotime(date('Y-m-d G:i:s',mktime(10,0,0, date("m") , date("d"),date("Y"))));
       $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $yesterday = date("Y-m-d", mktime(0,0,0, date("m") , date("d")-1,date("Y")));
       $this->loadModel('Newsmanager');
        if($checktime>=$current){
            if($standard=='0' && $classname=='0'){
        $arr['conditions']=array('id'=>$id,'created_date'=>$yesterday);
        $arr['limit']=8;
        $q=$this->Newsmanager->find('all',$arr);
            return $q;
            }else{
                if($classname=='0'){
                $arr['conditions']=array('id'=>$id,'created_date'=>$yesterday,'national'=>$standard);
                $arr['limit']=8;
        $q=$this->Newsmanager->find('all',$arr);
            return $q;}else{
                $arr['conditions']=array('id'=>$id,'created_date'=>$yesterday,'national'=>1,$classname=>$standard);
                $arr['limit']=8;
        $q=$this->Newsmanager->find('all',$arr);
            return $q;
            }
            }
        }else{
            if($standard=='0' && $classname=='0'){
            $arr['conditions']=array('id'=>$id,'created_date'=>$today);
            $arr['limit']=8;
            // debug($arr);die();
            $q=$this->Newsmanager->find('all',$arr); 
        return $q;
        }else{
            if($classname=='0'){
             $arr['conditions']=array('id'=>$id,'created_date'=>$today,'national'=>$standard);
             $arr['limit']=8;
            
            $q=$this->Newsmanager->find('all',$arr); 
        return $q;}else{
             $arr['conditions']=array('id'=>$id,'created_date'=>$today,'national'=>1,$classname=>$standard);
             $arr['limit']=8;
            $q=$this->Newsmanager->find('all',$arr); 
        return $q;
        }
        }
}              
   
    }
    function headLinefilter(){
        
        $id=$_POST['id'];
        
       $newsid=$this->getNewsId($id);
    $this->layout='blank';
      if(!empty($newsid)){
               
                  /*  foreach($newsid as $nid){
        $news=$nid['News_category']['news_id'];
        $q=$this->Newsmanager->find('all',array(
        'conditions'=>array('is_headline'=>1,'created_date'=>$yesterday,'id'=>$news),
                               'order' => array('id' => 'DESC'),
                               'limit'=>3
                               ));
                               //debug($q);die();
        $this->set('value',$q);
        }*/
        $this->set('value',$newsid);
        }else{
            $this->set('value','empty');
        }
       
        }
        
        function Newsheadline($id){
            
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
        
        function newstandard(){
            
       $standard=$_POST['standard'];
       $this->set('title','HamroAwaz');
       $this->loadModel('Categorymanager');
       $this->loadModel('Newsmanager');
       $qcat=$this->Categorymanager->find('all');
       $this->set('cat',$qcat);
       $this->set('standard',$standard);
      
        }
        function checkstandard($standard,$classname='0'){
            
            $this->loadModel('Newsmanager');
            $current=strtotime(date('Y-m-d G:i:s'));
       $checktime=strtotime(date('Y-m-d G:i:s',mktime(10,0,0, date("m") , date("d"),date("Y"))));
       $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $yesterday = date("Y-m-d", mktime(0,0,0, date("m") , date("d")-1,date("Y")));
     //  echo $classname;
             if($classname== '0'){
      
                 if($checktime>=$current ){
           $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$yesterday,'national'=>$standard),'order' => array('id' => 'DESC'),'limit'=>5));
             return $q;
               
            }
           if($checktime < $current ){
          $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$today,'national'=>$standard),'order' => array('id' => 'DESC'),'limit'=>5));
             return $q;
        }
        }else{
            
             if($checktime>=$current ){
       $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$yesterday,'national'=>1,$classname=>$standard),'order' => array('id' => 'DESC'),'limit'=>5));
         return $q;
           
        }
       if($checktime < $current ){
    $q=$this->Newsmanager->find('all',array('conditions'=>array('created_date'=>$today,'national'=>1,$classname=>$standard),'order' => array('id' => 'DESC'),'limit'=>5));
         return $q;
        }
        }
            
            
        }
        function checkslider($standard,$classname='0'){
            $this->loadModel('Newsmanager');
            $current=strtotime(date('Y-m-d G:i:s'));
       $checktime=strtotime(date('Y-m-d G:i:s',mktime(10,0,0, date("m") , date("d"),date("Y"))));
       $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $yesterday = date("Y-m-d", mktime(0,0,0, date("m") , date("d")-1,date("Y")));
       if($classname=='0'){
             if($checktime>=$current ){
       $arr['conditions']=array('created_date'=>$yesterday,'national'=>$standard);
       $slider=$this->Newsmanager->find('all',$arr);
       return $slider;
           
        }
       if($checktime < $current ){
       $arr['conditions']=array('created_date'=>$today,'national'=>$standard);
       $slider=$this->Newsmanager->find('all',$arr);
       return $slider;  
      
        }
        }else{
             if($checktime>=$current ){
       $arr['conditions']=array('created_date'=>$yesterday,'national'=>1,$classname=>$standard);
       $slider=$this->Newsmanager->find('all',$arr);
       return $slider;
           
        }
       if($checktime < $current ){
       $arr['conditions']=array('created_date'=>$today,'national'=>1,$classname=>$standard);
       $slider=$this->Newsmanager->find('all',$arr);
       return $slider;  
      
        }
        }
        
        }
        
         function newsubstandard(){
            
       $standard=$_POST['sub'];
       $classname=$_POST['classname'];
       $this->set('title','HamroAwaz');
       $this->loadModel('Categorymanager');
       $this->loadModel('Newsmanager');
       $qcat=$this->Categorymanager->find('all');
       $this->set('cat',$qcat);
       $this->set('standard',$standard);
       $this->set('classname',$classname);
      
        }
        //function checksubnewstandard($standard,classname)
 
 function checkview(){
    $title=$_POST['title'];
    $this->layout='blank';
    
   // echo $_SERVER['REMOTE_ADDR'];die();    
 /*   $ip=$this->get_client_ip_server();
    echo $ip;die();
    $this->loadModel('Ipaddress');
    
    if($ip=='UNKNOWN'){
    $result=$this->Ipaddress->find('first',array('conditions'=>array('ip'=>$ip)));
    if(empty($result)){
    $arr['ip']=$ip;
    $this->Ipaddress->create();
    $this->Ipaddress->save($arr);*/    
    $this->loadModel('Newsmanager');
    $result=$this->Newsmanager->find('first',array('conditions'=>array('title'=>$title)));
    $view=$result['Newsmanager']['views'];
    $id=$result['Newsmanager']['id'];
    $view++;
    $data = array('id' => $id, 'views' =>$view);
    $this->Newsmanager->save($data);
    //}
    
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

function findmostView(){
    $this->loadModel('Newsmanager');
    $q=$this->Newsmanager->find('all');
    $count=$this->Newsmanager->find('count');
  
   //$arr=array();
foreach($q as $mostview){
  $arr[]=$mostview['Newsmanager']['views'];
   
}

rsort($arr);

for($i=0;$i<=$count-1;$i++){
    if($arr[$i]!=0){
$resarr[]=$this->Newsmanager->find('first',array('conditions'=>array('views'=>$arr[$i])));
  }
}
//debug($resarr);die();
return $resarr;
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



function resizeMarkup($markup, $dimensions)
{
$w = $dimensions['width'];
$h = $dimensions['height'];

$patterns = array();
$replacements = array();
if( !empty($w) )
{
$patterns[] = '/width="([0-9]+)"/';
$patterns[] = '/width:([0-9]+)/';

$replacements[] = 'width="'.$w.'"';
$replacements[] = 'width:'.$w;
}

if( !empty($h) )
{
$patterns[] = '/height="([0-9]+)"/';
$patterns[] = '/height:([0-9]+)/';

$replacements[] = 'height="'.$h.'"';
$replacements[] = 'height:'.$h;
}

return preg_replace($patterns, $replacements, $markup);
}

function embedcode(){
    $this->layout='blank';
    $embedcode=$_POST['embed'];
    $youtube = $this->resizeMarkup($embedcode, array(
'width'=>300,
'height'=>250
));
echo $youtube;die();
}

function checkDate(){
    $this->layout='blank';
    $dateObject = new DateTime(date('Y-m-d G:i:s'));
       $today=$dateObject->format('Y-m-d');
       $date=$_POST['date'];
       
      $convert = new DateTime($date);
 $date=$convert->format('Y-m-d');
 //echo $date;die();
       if($date==$today){
        echo 'true';die();
       }else{
        echo 'false';die();
       }
}

    
  
}
?>