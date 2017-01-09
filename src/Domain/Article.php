<?php


namespace fc\Domain;


class Article 

{

    private $id;

    private $title;

    private $content;

    private $date;

    private $contentHTML;

    private $keywords = array();

    private $kwConv;








/*    public function changeToHTML(){

    }

*/













    public function getId() {

        return $this->id;

    }


    public function setId($id) {

        $this->id = $id;

    }


    public function getTitle() {

        return $this->title;

    }


    public function setTitle($title) {

        $this->title = $title;

    }


    public function getContent() {

        return $this->content;

    }


    public function setContent($content) {

        $this->content = $content;

    }


    public function getDate() {

        return $this->date;

    }


    public function setDate($date) {

        $this->date = $date;

    }



    public function getContentHTML(){
        return $this->contentHTML;
    }

    public function setContentHTML($content){
        $this->contentHTML = $contentHTML;
    }


    public function getKeyword(){
        return $this->keywords;
    }

    public function setKeyword($keyword){
        $this->keywords = $keyword;
    }


    public function getKeywords(){
        return $this->keywords;
    }

    public function setKeywords($keywords){
        $this->keywords = $keywords;
    }

    public function getKwConv(){
        return $this->kwConv;
    }

    public function setKwConv($kwConv){
        $this->kwConv = $kwConv;
    }


}