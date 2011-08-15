<?php

    class Application_Model_FriendMapper
    {
        protected $_dbTable;
        
        public function setDbTable($dbTable)
        {
            if (is_string($dbTable)) {
                $dbTable = new $dbTable();
            }
            if (!$dbTable instanceof Zend_Db_Table_Abstract) {
                throw new Exception('Invalid table data gateway provided');
            }
            $this->_dbTable = $dbTable;
            return $this;
        }
        
        public function getDbTable()
        {
            if (null === $this->_dbTable) {
                $this->setDbTable('Application_Model_DbTable_Friend');
            }
            return $this->_dbTable;
        }
        
        public function save(Application_Model_Friend $guestbook)
        {
            $data = array(
                          'email'   => $guestbook->getEmail(),
                          'comment' => $guestbook->getComment(),
                          'created' => date('Y-m-d H:i:s'),
                          );
            
            if (null === ($id = $guestbook->getId())) {
                unset($data['id']);
                $this->getDbTable()->insert($data);
            } else {
                $this->getDbTable()->update($data, array('id = ?' => $id));
            }
        }
        
        public function find($id, Application_Model_Friend $friend)
        {
            $result = $this->getDbTable()->find($id);
            if (0 == count($result)) {
                return;
            }
            $row = $result->current();
            $freind->setFriendId($row->friendId)
            ->setName($row->name)
            ->setDateCreated($row->dateCreated);
        }
        
        public function fetchAll()
        {
            $resultSet = $this->getDbTable()->fetchAll();
            $entries   = array();
            foreach ($resultSet as $row) {
                $entry = new Application_Model_Friend();
                $entry->setFriendId($row->friendId)
                ->setName($row->name)
                ->setFKUserId($row->FKUserId)
                ->setDateCreated($row->dateCreated);
                $entries[] = $entry;
            }
            return $entries;
        }
    }

