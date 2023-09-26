<?php

class koneksi{

    private $host = "localhost:3308";
    private $db   = "sistem_match";
    private $user = "root";
    private $pass = "";

    protected $koneksi;
    public function __construct()
    {
        try {
            $this->koneksi = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user,$this->pass);
            $this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $this->koneksi;
    }
}