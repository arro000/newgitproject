<?php

class Application_Model_DbTable_Fattura extends Zend_Db_Table_Abstract
{
    protected $_name = 'fattura';   

   public function getProdotti($id_fattura)
   {
        
        $select = $this->select();
        $select->from(array('o'=>'ordini'),'id_prodotti')
                ->where('id_prodotti = ?',$id_fattura);
        
        return $this->fetchAll($select);
    

   }
}


