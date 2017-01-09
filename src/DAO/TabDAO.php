<?php


namespace fc\DAO;


use fc\Domain\Tab;


class TabDAO extends DAO

{
    public function findAll() {

        $sql = "select * from t_tabs order by tab_id asc ";

        $result = $this->getDb()->fetchAll($sql);


        // Convert query result to an array of domain objects

        $tabs = array();

        foreach ($result as $row) {

            $tabId = $row['tab_id'];

            $tabs[$tabId] = $this->buildDomainObject($row);

        }

        return $tabs;
    }


    public function findByUrl($url){

        $sql = "select * from t_entries natural join t_tabs where tab_url = ? order by entry_id asc ";

        $result = $this->getDb()->fetchAll($sql, array($url));

        // Convert query result to an array of domain objects

        $entries = array();

        foreach ($result as $row) {

            $entryId = $row['entry_id'];

            $entries[$entryId] = $this->buildDomainObject($row);
        }

        return $entries;
    }

    public function getByUrl($url){
        $sql = "select * from t_tabs where tab_url = ?";

        $result = $this->getDb()->fetchAll($sql, array($url));

        foreach ($result as $row) {

            $tab = $this->buildDomainObject($row);
        }

        return $tab;
    }

    public function getById($id){
        $sql = "select * from t_tabs where tab_id = ?";

        $result = $this->getDb()->fetchAll($sql, array($id));

        foreach ($result as $row) {

            $tab = $this->buildDomainObject($row);
        }

        return $tab;
    }


    public function save(Tab $tab) {
        $entryData = array(
            'tab_name' => $tab->getName(),
            'tab_content' => $tab->getContent(),
            'tab_url' => $tab->getUrl()
            );

        if ($tab->getId()) {
            // The tab has already been saved : update it
            $this->getDb()->update('t_tabs', $entryData, array('tab_id' => $tab->getId()));
        } else {
            // The tab has never been saved : insert it
            $this->getDb()->insert('t_tabs', $entryData);
            // Get the id of the newly created tab and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $tab->setId($id);
        }
    }


    protected function buildDomainObject($row) {

        $tab = new Tab();

        $tab->setId($row['tab_id']);

        $tab->setName($row['tab_name']);

        $tab->setUrl($row['tab_url']);

        $tab->setContent($row['tab_content']);

        return $tab;

    }

}