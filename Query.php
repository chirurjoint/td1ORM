<?php


class Query
{

    private $sqltable;
    private $fields = '*';
    private $where = null;
    private $args = [];
    private $sql;


    public static function table($table){
        $query  = new Query();
        $query->sqltable = $table;
        return $query;
    }

    public function delete(){
        $pdo = $this->run();
        $this->sql = 'delete from '.$this->sqltable.' '.$this->where.';';
        echo $this->sql;
        $statement = $pdo->prepare($this->sql);
        $statement->execute();
    }


    public function select(array $fields){
        $this->fields = implode(',', $fields);
        return $this;
    }

    public function insert($object){
        if($object instanceof Article){
            $tab = [
                ":id" => $object->id,
                ":nom" => $object->nom,
                ":descr" => $object->descr,
                ":tarif" => $object->tarif,
                ":id_categ" => $object->id_categ

            ];
            $this->sql = 'insert into '.$this->sqltable.' (`id`,`nom`,`descr`,`tarif`,`id_categ`) values (:id,:nom,:descr,:tarif,:id_categ);' ;     
            $pdo = $this->run(); 
            echo $this->sql;
            $statement = $pdo->prepare($this->sql);
            $statement->execute($tab);

        }else if ($object instanceof Categorie){

            $this->sql = 'insert into '.$this->sqltable.' (`id`,`nom`,`descr`) values ('.$object->id.','.$object->nom.','.$object->descr.');' ;     
            $pdo = $this->run(); 
            $statement = $pdo->prepare($this->sql);
            $statement->execute();
        }else {
            return null;
        }
    }

    public function where($args){   
        $size = sizeof($args);   
        foreach ($args as $arg){
            $elements = explode(' ',$arg);
            if($size >1){
                $this->where = $this->where ." ".$elements[0]." ".$elements[1]." ".$elements[2].' and ';
   
            }
            if ($size == 1){
                $this->where = $this->where." ".$elements[0]." ".$elements[1]." ".$elements[2];   

            }
            $size--;

        }
        $this->where = 'where '.$this->where;
        return $this;
    }

    public function run(){
        $conf = parse_ini_file('conf/db.conf.ini');
        $connect = new ConnectionFactory();
        try {
            $pdo = $connect->makeConnection($conf);
            
        }
        catch(exception $e) {
            die('Erreur '.$e->getMessage());
        }
        return $pdo;
         
    }

    public function get(){
        $pdo = $this->run();
        $this->sql  = 'select '.$this->fields.' from '.$this->sqltable.' '. $this->where. ';';
        $statement = $pdo->prepare($this->sql);
        echo $this->sql;
        $statement->execute();
        return $statement->fetchAll();


    }



}