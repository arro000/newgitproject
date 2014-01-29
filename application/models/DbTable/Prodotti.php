<?php

class Application_Model_DbTable_Prodotti extends Zend_Db_Table_Abstract
{
    protected $_name = 'prodotti';
    
    public function countProducts(){
        $select = $this->select();
        $select->from($this,array("COUNT(ID)"));
        return $this->fetchRow($select);
    }
    public function searchProducts($val){
       // $val="'%".$val."%'";
        $select = $this->select();
        $select->from($this)
                ->where("prodotto like ?","%{$val}%");
        
        return $this->fetchAll($select);
    
    }
    public function deleteProducts($id){
        $where = $this->getAdapter()->quoteInto('id = ?',$id);
        $this->delete($where);
    }
            
    
}
