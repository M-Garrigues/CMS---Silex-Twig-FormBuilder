<?php


namespace fc\Domain;


class Tab 

{

    private $id;

    private $name;

    private $url;

    private $entries = array();

    private $nbEntries = 0;

    private $content;



    public function getId() {

        return $this->id;

    }


    public function setId($id) {

        $this->id = $id;

    }


    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }



    public function getName() {

        return $this->name;

    }


    public function setName($name) {

        $this->name = $name;

    }


    public function geturl() {

        return $this->url;

    }


    public function seturl($url) {

        $this->url = $url;
         }
    
    public function setEntries($entries)
    {
        $this->entries = $entries;

        $this->nbEntries = count($entries);
    }


    public function getNbEntries(){
        return $this->nbEntries;
    }

    public function getEntries(){
        return $this->entries;
    }
}