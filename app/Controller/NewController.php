<?php

class NewController extends AppController
{
    function index()
    {
        $this->set('title','HamroAwaz');
        $this->loadModel('Categorymanager');
        $this->loadModel('Slider');
        $q=$this->Categorymanager->find('all');
        $slider=$this->Slider->find('all');
        $this->set('cat',$q);
        $this->set('slider',$slider);   
    }
    function currency()
    {

    }
    
}