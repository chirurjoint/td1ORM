<?php
abstract class Model    
{
    private  $tab;

    public function Model($tab_attr){
        $this->tab = $tab_attr;
    }

    public function save(){
        if($this instanceof Article){
            $con = new Query();
            $query2 = Query::table(strtolower(get_class($this)));
            $query2->insert($this);
        }
        else{
            $con = new Query();
            $query2 = Query::table(strtolower(get_class($this)));
            $query2->insert($this); 
        }
    }

    public function delete(){
        $query1 = Query::table(strtolower(get_class($this)));
        $query1->where(['id = '.$this->id]);
        $query1->delete();
    }

    public function insert(){
        $query2 = Query::table(strtolower(get_class($this)));
        $query2->insert($this);
    }

    public function belongs_to($object,$id){
        $query = Query::table(strtolower(get_class($this)));
        $query->where(['id = '.$this->id]);  
        $obj = $query->get();
        $query1 = Query::table(strtolower($object));
        $query1->where(['id = '.$obj[0][$id]]);
        $retour = $query1->get();
        $final_return = new $object($retour[0]);
        return $final_return;
    }

    public function has_many($object,$id){
        $query = Query::table(strtolower($object));
        $query->where([$id.' = '.$this->id]);  
        $objs = $query->get();
        $tab = [];
        foreach ($objs as $obj) {
            $zinzin = new $object($obj);
            array_push($tab,$zinzin);
        }
        return $tab;
    }


    public function __get($name){
        echo "Récupération de '$name'\n";

        if (array_key_exists($name, $this->tab)) {
            return $this->tab[$name];var_dump($categ);

        }
        else{
            $trace = debug_backtrace();
            trigger_error(
                'Propriété non-définie via __get() : ' . $name .
                ' dans ' . $trace[0]['file'] .
                ' à la ligne ' . $trace[0]['line'],
                E_USER_NOTICE);
            return null;
        }

    }

    public function __set($name, $value)
    {
        echo "Définition de '$name' à la valeur '$value'\n";
        $this->tab[$name] = $value;
    }

}