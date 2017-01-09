<?php


namespace fc\DAO;


use fc\Domain\Entry;


class EntryDAO extends DAO

{

    /**

     * Return a list of all entries, sorted by date (most recent first).

     *

     * @return array A list of all entries.

     */

    public function findAllByTab($tab) {

        $sql = "select * from t_entries where tab_id = ? order by entry_id asc ";

        $result = $this->getDb()->fetchAll($sql, array($tab));

        // Convert query result to an array of domain objects

        $entries = array();

        foreach ($result as $row) {

            $entryId = $row['entry_id'];

            $entries[$entryId] = $this->buildDomainObject($row);

        }

        return $entries;

    }


    public function findByUrl($url) {

        $sql = "select * from t_entries where entry_url = ?";

        $result = $this->getDb()->fetchAll($sql, array($url));

        foreach ($result as $row) {

            $entry = $this->buildDomainObject($row);

        }
        return $entry;
    }


    public function findById($id) {

        $sql = "select * from t_entries where entry_id = ?";

        $result = $this->getDb()->fetchAll($sql, array($id));

        
        foreach ($result as $row) {

            $entry = $this->buildDomainObject($row);

        }
        return $entry;
    }


    public function findAll() {

        $sql = "select * from t_entries order by entry_id desc ";

        $result = $this->getDb()->fetchAll($sql);


        // Convert query result to an array of domain objects

        $entries = array();

        foreach ($result as $row) {

            $entryId = $row['entry_id'];

            $entries[$entryId] = $this->buildDomainObject($row);

        }

        return $entries;
    }



    public function save(Entry $entry) {
        $entryData = array(
            'entry_name' => $entry->getName(),
            'entry_content' => $entry->getContent(),
            'entry_url' => $entry->getUrl(),
            'tab_id' => $entry->getTabId()
            );

        if ($entry->getId()) {
            // The entry has already been saved : update it
            $this->getDb()->update('t_entries', $entryData, array('entry_id' => $entry->getId()));
        } else {
            // The entry has never been saved : insert it
            $this->getDb()->insert('t_entries', $entryData);
            // Get the id of the newly created entry and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $entry->setId($id);
        }
    }

    public function delete($id) {
        $this->deleteArticles($id);
        $this->getDb()->delete('t_entries', array('entry_id' => $id));
    }

    private function deleteArticles($id){

        $this->getDb()->delete('t_articles', array('entry_id' => $id));
    }


    /**

     * Creates an entry object based on a DB row.

     *

     * @param array $row The DB row containing entry data.

     * @return \fc\Domain\entry

     */

    protected function buildDomainObject($row) {

        $entry = new Entry();

        $entry->setId($row['entry_id']);

        $entry->setName($row['entry_name']);

        $entry->setContent($row['entry_content']);

        $entry->setUrl($row['entry_url']);

        $entry->setTabId($row['tab_id']);

        return $entry;

    }

}