<?php


namespace fc\DAO;


use fc\Domain\Article;


class ArticleDAO extends DAO

{

    /**

     * Return a list of all articles, sorted by date (most recent first).

     *

     * @return array A list of all articles.

     */


    public function findKeywords($article){

        $id = $article->getId();

        $sql = "select * from t_keywords natural join r_kw_articles where article_id = ?";

        $resKw = $this->getDb()->fetchAll($sql, array($id));

        $kws = array();
        foreach ($resKw as $key=>$row) {
            array_push($kws, $row['kw_kw']);
        }

        $kwconv = "";

        foreach ($kws as $key => $word) {
            $kwconv = $kwconv.$word."/";
        }

        $article->setKwConv($kwconv);
        $article->setKeywords($kws);

    }

    public function findAllByEntry($entry) {

        $sql = "select * from t_articles where entry_id = ? order by article_id desc ";

        $result = $this->getDb()->fetchAll($sql, array($entry));

        // Convert query result to an array of domain objects

        $articles = array();

        foreach ($result as $row) {

            $articleId = $row['article_id'];

            $articles[$articleId] = $this->buildDomainObject($row);

            //$this->findKeywords($articles[$articleId]);

        }

        return $articles;

    }

    public function findAllByEntryURL($url) {

        $sql = "select * from t_articles natural join t_entries where entry_url = ? order by article_id desc ";

        $result = $this->getDb()->fetchAll($sql, array($url));

        // Convert query result to an array of domain objects

        $articles = array();

        foreach ($result as $row) {

            $articleId = $row['article_id'];

            $articles[$articleId] = $this->buildDomainObject($row);

            //$this->findKeywords($articles[$articleId]);

        }

        return $articles;

    }


    public function findAll() {

        $sql = "select * from t_articles order by article_id desc ";

        $result = $this->getDb()->fetchAll($sql);


        // Convert query result to an array of domain objects

        $articles = array();

        foreach ($result as $row) {

            $articleId = $row['article_id'];

            $articles[$articleId] = $this->buildDomainObject($row);

            //$this->findKeywords($articles[$articleId]);

        }

        return $articles;
    }

    public function findById($id) {

        $sql = "select * from t_articles where article_id = ?";

        $result = $this->getDb()->fetchAll($sql, array($id));


        foreach ($result as $row) {

            $article = $this->buildDomainObject($row);

        }

        return $article;
    }



    public function save(Article $article) {
        $articleData = array(
            'article_title' => $article->getTitle(),
            'article_content' => $article->getContent(),
            'article_date' => $article->getDate(),
            );

        if ($article->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('t_articles', $articleData, array('article_id' => $article->getId()));



        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('t_articles', $articleData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $article->setId($id);
        }
    }


    

    protected function buildDomainObject($row) {

        $article = new Article();

        $article->setId($row['article_id']);

        $article->setTitle($row['article_title']);

        $article->setContent($row['article_content']);

        $article->setDate($row['article_date']);

        $this->findKeywords($article);


        return $article;

    }

}