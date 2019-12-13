<?php


class ConnectionFactory
{
    private $base;
    public function makeConnection(array  $conf){

        try {
            $pdo = new PDO('mysql:host='.$conf['host'].'; dbname='.$conf['name'].'', $conf['user'], $conf['pass']);
            $this->base = $pdo;
        }

        catch(exception $e) {

            die('Erreur '.$e->getMessage());

        }
        return $pdo;
    }

    public function getConnection(){
        return $this->base;
    }
}