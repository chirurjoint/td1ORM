<?php
class Categorie extends Model
{
    private $id;
    private $nom;
    private $descr;

    public function _construct($tab){
        parent::__construct($tab);
        if(array_key_exists('nom', $tab)){
            $this->nom = $tab['nom'];
        }
        if(array_key_exists('id', $tab)){
            $this->id = $tab['id'];
        }
        if(array_key_exists('descr', $tab)){
            $this->descr = $tab['descr'];
        }
    }

    public function articles(){
        $article = $this->has_many('Article','id_categ');
        $tab = [];
        foreach ($article as $article) {
            array_push($tab,$article);
        }
        return $tab;
    }

    public static function find($args, $select = '*'){
        if(func_num_args()==1 && is_int($args)==true){
            $query = Query::table('categorie');
            $query->select($select);
            $query->where(['id = '.$args]);
            $retour = $query->get();
            $tab = [];
            foreach ($retour as $categ) {
                array_push($tab,new Categorie($categ));
            }
        }
        elseif(func_num_args()==2 && is_int($args)==true){
            $query = Query::table('categorie');
            $elements = implode(',',$select);
            $query->select($select);
            $query->where(['id = '.$args]);
            $retour = $query->get();
            $tab = [];
            foreach ($retour as $categ) {
                array_push($tab,new Categorie($categ));
            }
        }elseif(func_num_args()==2 && is_array($args)==true){
            $query = Query::table('categrie');
            $elements = implode(',',$select);
            $query->select($select);
            $query->where($args);
            $retour = $query->get();
            $tab = [];
            foreach ($retour as $categ) {
                array_push($tab,new Categorie($categ));
            }
        }elseif (is_array($args)==true && func_num_args()==1) {
            $query = Query::table('categorie');
            $query->select(["*"]);
            $query->where($args);
            $retour = $query->get();
            $tab = [];
            foreach ($retour as $categ) {
                array_push($tab,new Categorie($categ));
            }
        }
        return $tab;
    }

    public static function first($args, $select = ['*']){
        $categs = Categorie::find($args,$select);
        return $categs[0];
    }

}