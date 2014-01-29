<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Application_Model_DbTable_Ordini extends Zend_Db_Table_Abstract
{
    protected $_name = 'ordini';   

   public function getProdotti($id_fattura)
   {
        
        $select = $this->select();
        $select->from(array('o'=>'ordini'),'id_prodotti')
                ->where('id_prodotti = ?',$id_fattura);
        
        return $this->fetchAll($select);
    

   }
}
?>
