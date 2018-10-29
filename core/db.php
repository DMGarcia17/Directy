<?php

require_once 'criptografia.php';

class db extends cripto
{
    public $db;
    public $cr;
    public function __construct()
    {
        $this->cr = new cripto();
        $pass = $this->cr->decrypt('S3UzUXVqTGdoNmFLQm1mZmFJVlRMQT09Ojoa8c3DNU5eca8DQA0JrU52');
        $this->db = new PDO('mysql:host=localhost;dbname=foodapp', 'admin', $pass);
    }
}
