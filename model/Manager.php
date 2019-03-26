<?php

namespace FredLab\tp5_caddy_race\Model;

class Manager {
    
    private $db; 
    
    protected function dbConnect() {
        if ($this->db == null) {
            $this->db = new \PDO('mysql:host=localhost;dbname=caddyrace;charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        };
        return $this->db;
    }
}
