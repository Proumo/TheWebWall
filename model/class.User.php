<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author Andre
 */
include '../DAO/class.UserDAO.php';

class User {
    private $user_id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $country;
    private $image;
    
    public function __construct() {
        }
    
    
public function getUser_id() {
    return $this->user_id;
}

public function setUser_id($user_id) {
    $this->user_id = $user_id;
}

public function getFirstName() {
    return $this->firstName;
}

public function setFirstName($firstName) {
    $this->firstName = $firstName;
}

public function getLastName() {
    return $this->lastName;
}

public function setLastName($lastName) {
    $this->lastName = $lastName;
}

public function getLastName_1() {
    return $this->lastName;
}

public function setLastName_1($lastName) {
    $this->lastName = $lastName;
}

public function getEmail() {
    return $this->email;
}

public function setEmail($email) {
    $this->email = $email;
}

public function getPassword() {
    return $this->password;
}

public function setPassword($password) {
    $this->password = $password;
}

public function getCountry() {
    return $this->country;
}

public function setCountry($country) {
    $this->country = $country;
}

public function getImage() {
    return $this->image;
}

public function setImage($image) {
    $this->image = $image;
}

public function create(){
    
    
    UserDAO::create($this);
    
}
public function alreadyThere(){
    
    UserDAO::alreadyThere($this);
}

public function update($new){
    
    UserDAO::update($this,$new);
}

public function toXML(){
    include'class.XMLresponse.php';
    $resposta= new XMLresponse();
        $resposta->start();
        $resposta->command(
                array("firstName" => $this->firstName,
                      "lastName" =>$this->lastName,
                      "country" => $this->country,
                      "image" => $this->image,
                    ));
        $resposta->end();
        
        return $resposta;
    
}



}
?>
