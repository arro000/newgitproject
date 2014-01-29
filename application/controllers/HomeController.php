<?php

class homeController extends Zend_Controller_Action
{
    public function init()
    {
        
      $this->_helper->layout()->setLayout("site");
        
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }
    public function getcredAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $ret=array();
        //sleep(5);
        if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getParams();
          $auth = Zend_Auth::getInstance();
          $ret=$auth->getIdentity();
        }
        echo json_encode($ret);
    }
    
    public function preDispatch(){

        $resource = 'home';
        $privilege = $this->_request->getActionName();
        
        $auth = Zend_Auth::getInstance();
        $registry = Zend_Registry::getInstance();
        $acl=$registry->get("acl"); 
        
        If($auth->hasIdentity()){
            $ret=$auth->getIdentity();     
            
         if (!$acl->isAllowed($ret->ruolo,$resource, $privilege)){ 
                 $this->_redirect();
                 echo "only admin can use this function";
         }
            
        }else{        
            if (!$acl->isAllowed("guest",$resource, $privilege)) $this->_redirect();
        }   
    }
    
    public function getprodAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $prodotti=new Application_Model_DbTable_Prodotti();   
//        $this->db =zend_registry::get('db');
//        $select = $this->db->select()
//             ->from('prodotti');
//        $stmt = $select->query();
        $result = $prodotti->fetchAll();
        //var_dump($result->toArray());
       
        echo json_encode($result->toArray());
        
    }
    
    public function setprodAction()
    {
        
        $ret=array();
        $bool=false;
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getParams();
          var_dumP($data);
          $ret["prodotto"]=$data["prodotto"];
          $ret["costo"]=$data["costo"];
          $ret["iva"]=($data["costo"]*21)/100;
          foreach ($ret as $value) {
              if($value!="")$bool=true;
              
          }
          if($bool){
            $this->db =zend_registry::get('db');
            $insert=$this->db->insert("prodotti",$ret);
          }
        
        }
        
    }
    
    public function searchAction()
    {
        $ret=0;
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $prodotti=new Application_Model_DbTable_Prodotti();   
        if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getParams();
         // $ret=$data["param"];
//        $this->db =zend_registry::get('db');
//        $select = $this->db->select()
//             ->from('prodotti');
//        $stmt = $select->query();
        $result = $prodotti->searchProducts($data["param"]);
        }
        //var_dump($result->toArray());
       
        echo json_encode($result->toArray());
        
    }
    
    public function deleteAction()
    {
        
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $prodotti=new Application_Model_DbTable_Prodotti();   
        if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getParams();
          
          $ret=$data["id"];
//        $this->db =zend_registry::get('db');
//        $select = $this->db->select()
//             ->from('prodotti');
//        $stmt = $select->query();
        $result = $prodotti->deleteProducts($ret);
        }
        //var_dump($result->toArray());
       
       
        
    }
    public function adminAction()
    {
        
    }
}
?>
