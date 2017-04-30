<?php

class conexion{
    private $server = "localhost";
    private $user = "root";
    private $pass = "";
    private $dataBase = "restaurante";

    /**
     * @return string
     */
    public function getServer(){
        return $this->server;
    }

    /**
     * @param string $server
     */
    public function setServer($server){
        $this->server = $server;
    }

    /**
     * @return string
     */
    public function getUser(){
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user){
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPass(){
        return $this->pass;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass){
        $this->pass = $pass;
    }

    /**
     * @return string
     */
    public function getDataBase(){
        return $this->dataBase;
    }

    /**
     * @param string $dataBase
     */
    public function setDataBase($dataBase){
        $this->dataBaseb = $dataBase;
    }

}