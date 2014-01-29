<?php

class AuthController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout()->setLayout("site");
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }

    public function loginAction() {
      $this->_helper->layout()->disableLayout(); 
      $this->_helper->viewRenderer->setNoRender(true);
      $this->db =  Zend_Registry::get("db");
      $ret=array();
      $auth = Zend_Auth::getInstance();
      $ret["path"]="/home";
      if ($auth->hasIdentity()){
         // var_dump($auth->getIdentity());
          $ret["access"]="grant";
      }else{
      if ($this->getRequest()->isPost()) {
          $data = $this->getRequest()->getParams();
         $username = $data['username'];
         $password = $data['password'];
         

         $adapter = new Zend_Auth_Adapter_DbTable($this->db,'utenti','username','password');

         $adapter->setIdentity($username);
         $adapter->setCredential($password);
         $result = $auth->authenticate($adapter);

         if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $storage = $auth->getStorage();
            $storage ->write($user);
           // $this->_redirect('/index');
            $ret["access"]="grant";
            
         }  else {
             $ret["path"]="/auth";
              $ret["access"]="denied";
         }
      }
     // $this->_redirect('/index');
         

      }
       echo json_encode($ret);
   }
    public function logoutAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        Zend_Auth::getInstance()->clearIdentity();
        //$this->_helper->redirector('index'); // back to login page
        echo $data="sei sloggato";

    }


}



