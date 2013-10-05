<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author Andre
 */
include_once '../DAO/class.PostDAO.php';
class Post {
    private $id;
    private $author;
    private $x;
    private $y;
    private $url;
    private $type;
    private $dataPost;
    private $numViews;
    private $description;
    private $sponsored;
    private $title;
    private $thumb;
    
    public function getThumb() {
        return $this->thumb;
    }

    public function setThumb($thumb) {
        $this->thumb = $thumb;
    }

        
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function getY() {
        return $this->y;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getDataPost() {
        return $this->dataPost;
    }

    public function setDataPost($dataPost) {
        $this->dataPost = $dataPost;
    }

    public function getNumViews() {
        return $this->numViews;
    }

    public function setNumViews($numViews) {
        $this->numViews = $numViews;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getSponsored() {
        return $this->sponsored;
    }

    public function setSponsored($sponsored) {
        $this->sponsored = $sponsored;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function __construct() {
        
    }
    
    public function updateViews(){
        
        PostDAO::updateViews($this);
        
    }
    
    public function colarNaParede(){
        
        PostDAO::colarNaParede($this);
    }
 
    public function toXML(){
        include '../model/class.XMLresponse.php';
        $responseXML= new XMLresponse();
        $responseXML->start();
        $responseXML->command(
                array("numViews" => $this->getNumViews(),
                      "tagPost" =>$this->getUrl(),
                      "dataPost" => $this->getDataPost(),
                      "descricao" => $this->getDescription(),
                      "nome"=>$this->getAuthor()->getfirstName(),
                      "lastname"=>$this->getAuthor()->getLastName(),
                      "image"=>$this->getAuthor()->getImage(),
                      "country"=>$this->getAuthor()->getCountry(),
                      "titulo"=>$this->getTitle(),
                      "tipo"=>$this->getType(),
                    ));
        $responseXML->end();
        
        return $responseXML;
    
    }
    
    
}

?>
