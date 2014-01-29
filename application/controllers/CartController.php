<?php

class CartController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout()->setLayout("cart");
        /* Initialize action controller here */
    }

    public function indexAction()
    {
                
    }
    
    public function setAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        
        $ret= array();
        $retord=array();
        
        if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getParams();
          //richiede l'id utente
          $auth = Zend_Auth::getInstance();
          $ide=$auth->getIdentity();
          $ret["id_utente"]=$ide->id;
         
          $ret["data"]=date(DATE_ATOM);
          $ret["totale"]=$data["paramtot"];
          $idArray=explode(" ",$data["paramid"]);
          //controlla array per l'inserimento
          foreach ($ret as $value) {
              if($value!="")$bool=true;              
          } 
          //inserisce array nella tabella
           if($bool){
            $this->db =zend_registry::get('db');
            $insert=$this->db->insert("fattura",$ret);
           
          }
          //richiede l'ultimo id fattura
          $sqlrequest = "select max(id) as Idmax from fattura";
          $result= $this->db->fetchAll($sqlrequest); 
          $retord["id_fattura"] =$result[0]["Idmax"];
          //inserisce righe prodotti negli ordini       
          
          foreach ($idArray as $key => $value) {
              if($value!=""){
              $retord["id_prodotto"]=$value;
              $insert=$this->db->insert("ordini",$retord);
                  
              }
          }         
          //var_dump();  
        
    }
    }
    public function getAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $fatture=new Application_Model_DbTable_Fattura();  
        $result = $fatture->fetchAll();
        //var_dump($result->toArray());
        echo json_encode($result->toArray());
    }
    public function getprodAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getParams();
            $ordini=new Application_Model_DbTable_Ordini();  
            $result = $ordini->getProdotti($data["idfattura"]);
            var_dump($result);
            echo json_encode($result->toArray());
            
        }
    }
}
   
    

?>
