<?php

class Application_Model_DbTable_Foo extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';
    protected $_primary = 'id';


    public function getListOfUser()
    {
         $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $select  = $db->select()
                      ->from($_name,array('*'))
                      ->where(1);
        $data = $db->query($select)->fetchAll();
        return $data;         
    }
}