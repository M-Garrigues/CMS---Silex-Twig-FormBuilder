<?php


namespace fc\Domain;


class Entry 

{

    private $id;

    private $name;

    private $content;

    private $url;

    private $contentHTML;

    private $articles;

    private $tabId;





    public function getId() {

        return $this->id;

    }


    public function setId($id) {

        $this->id = $id;

    }


    public function getName() {

        return $this->name;

    }


    public function setName($name) {

        $this->name = $name;

    }


    public function getContent() {

        return $this->content;

    }


    public function setContent($content) {

        $this->content = $content;

    }


    public function geturl() {

        return $this->url;

    }


    public function seturl($url) {

        $this->url = $url;

    }


    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    public function getArticles(){
        return $this->articles;
    }



    public function getTabId() {

        return $this->tabId;

    }


    public function setTabId($tabId) {

        $this->tabId = $tabId;

    }

}