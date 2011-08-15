<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
        
        //$result = $_REQUEST->db->fetchCol('SELECT name FROM Friend WHERE FKUserId = ?', 1);
        
        $friend = new Application_Model_FriendMapper();
        $this->view->entries = $friend->fetchAll();

    }


}

