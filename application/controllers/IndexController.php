<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
                
    }
    
    public function calcAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $res=null;
        $data = $this->getRequest()->getParams();
        
        if(!isset($data["oper"]))
            $data["oper"]=null;
            switch ($data["oper"])
            {
                case 'sum':
                    $res=$data["param0"]+$data["param1"];
                    break;   
                case 'sub':
                    $res=$data["param0"]-$data["param1"];
                    break;   
                case 'mul':
                    $res=$data["param0"]*$data["param1"];
                    break; 
                case 'div':
                    if($data["param0"]!=0)
                         if($data["param1"]!=0) $res=$data["param0"]/$data["param1"];
                    else $res= "error division by 0";
                    
                
                    break;  
                default:
            }
            
           echo $res;
    }
    
    public function sqrtAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $res=null;
        $data = $this->getRequest()->getParams();
        if(!isset($data["param"]))
               $data["param"]=null;
        $res=sqrt($data["param"]);
        echo $res;        
        
    }
     public function invAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $res=null;
        $data = $this->getRequest()->getParams();
        if(!isset($data["param"]))
               $data["param"]=null;
        $res=$data["param"]*(-1);
        echo $res;        
        
    }
    public function percAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $res=null;
        $data = $this->getRequest()->getParams();
        if(!isset($data["param0"]) )
               $data["param0"]=null;
        if(!isset($data["param1"]) )
               $data["param1"]=null;
        $res=($data["param0"]*$data["param1"])/100;
        echo $res;        
        
    }
    public function reciprocAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $res=null;
        $data = $this->getRequest()->getParams();
        if(!isset($data["param"]))
               $data["param"]=null;
        $res=1/$data["param"];
        echo $res;     
    }
    
    
    
}

    
?>
