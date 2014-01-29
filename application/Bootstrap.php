<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }
    
    protected function _initDb()
    {
        $db = $this->getPluginResource('db')->getDbAdapter();
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);        
        Zend_Registry::set('db', $db);
        Zend_Db_Table::setDefaultAdapter($db);
        return $db;
    }
    
    
    protected function _initAcl()
    {
        $acl = new Zend_Acl();
        $role=array('guest','admin','user');
        $resource=array('auth','index','home');
        foreach ($role as $role) {
            $acl->addRole(new Zend_Acl_Role($role));
        }
        foreach ($resource as $controller) {
            $acl->add(new Zend_Acl_Resource($controller));
        }
        $acl->allow('admin');
        $acl->allow('user');
        $acl->allow('user','home');
        $acl->deny('user','home','delete');
        $acl->deny('user','home','setprod');
        $acl->deny('guest','home');

        $registry = Zend_Registry::getInstance();
        $registry->set('acl', $acl);
      }
    
    
}
