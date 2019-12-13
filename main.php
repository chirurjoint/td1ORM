<?php
include 'Model.php';
include 'Article.php';
include 'Categorie.php';
include 'Query.php';
include 'ConnectionFactory.php';


$query = Query::table('article');
$query->select(['*']);
$query->where(['id = 65']);
$retour = $query->get();
foreach ($retour as $key => $value) {
    echo "\n==============================\n";
    echo "\n".$value['id']."\n";
    echo "\n".$value['nom']."\n";
    echo "\n".$value['descr']."\n";
    echo "\n".$value['tarif']."\n";
    echo "\n".$value['id_categ']."\n";}
    echo "\n==============================\n";


$query = Query::table('article');
$query->select(['*']);
$query->where(['tarif > 12','nom = "biclou"']);
$retour = $query->get();
foreach ($retour as $key => $value) {
    echo "\n==============================\n";
    echo "\n".$value['id']."\n";
    echo "\n".$value['nom']."\n";
    echo "\n".$value['descr']."\n";
    echo "\n".$value['tarif']."\n";
    echo "\n".$value['id_categ']."\n";
    echo "\n==============================\n";


}


$tab = [
    'id'=>445,
    'nom'=>'zinzin',
    'descr'=>"tres bien",
    'tarif'=>12,
    'id_categ'=> 1
];
$article = new Article($tab);
$article->insert();
$article_search = Article::find(445);
echo "\n==============================\n";
echo "\nArticle :".$article_search[0]->id."\n";
echo "\nNom: ".$article_search[0]->nom."\n";
echo "\nDescription: ".$article_search[0]->descr."\n";
echo "\nTarif: ".$article_search[0]->tarif."\n";
echo "\nId Categorie: ".$article_search[0]->id_categ."\n";
echo "\n==============================\n";


$article_first_search = Article::first(445);
echo "\n==============================\n";
echo "\nArticle :".$article_first_search ->id."\n";
echo "\nNom: ".$article_first_search->nom."\n";
echo "\nDescription: ".$article_first_search->descr."\n";
echo "\nTarif: ".$article_first_search->tarif."\n";
echo "\nId Categorie: ".$article_first_search->id_categ."\n";
echo "\n==============================\n";


$tab = [
    'id'=>999,
    'nom'=>'zinzin222',
    'descr'=>"tres bien2222222",
    'tarif'=>12,
    'id_categ'=> 1
];
$article = new Article($tab);
$article->insert();
$article_first_delete = Article::first(999);
echo "\n==============================\n";
echo "\nArticle :".$article_first_delete ->id."\n";
echo "\nNom: ".$article_first_delete->nom."\n";
echo "\nDescription: ".$article_first_delete->descr."\n";
echo "\nTarif: ".$article_first_delete->tarif."\n";
echo "\nId Categorie: ".$article_first_delete->id_categ."\n";
echo "\n==============================\n";

$article_first_delete->delete();


echo "\n-------------- FINDER POUR LA FONCTION ALL -------------\n";
$articles = Article::all();
foreach ($articles as $article) {
    echo "\n==============================\n";
    echo "\nArticle :".$article ->id."\n";
    echo "\nNom: ".$article->nom."\n";
    echo "\nDescription: ".$article->descr."\n";
    echo "\nTarif: ".$article->tarif."\n";
    echo "\nId Categorie: ".$article->id_categ."\n";
    echo "\n==============================\n";
}

echo "\n-------------- FINDER POUR LA FONCTION FIND AVEC PARAMETTRE -------------\n";

$articles = Article::find(['tarif > 12'],['nom','tarif']);
foreach ($articles as $article) {
    echo "\n==============================\n";
    //echo "\n".$article ->id."\n"; n'est pas compter dans la recherche
    echo "\n".$article->nom."\n";
    //echo "\n".$article->descr."\n"; n'est pas compter dans la recherche
    echo "\n".$article->tarif."\n";
    //echo "\n".$article->id_categ."\n"; n'est pas compter dans la recherche
    echo "\n==============================\n";
}

echo "\n-------------- FINDER POUR LA FONCTION FIRST AVEC PARAMETTRE -------------\n";

$articles = Article::first(['tarif > 12'],['nom','tarif']);
echo "\n==============================\n";
//echo "\n".$article ->id."\n"; n'est pas compter dans la recherche
echo "\n".$articles->nom."\n";
//echo "\n".$article->descr."\n"; n'est pas compter dans la recherche
echo "\n".$articles->tarif."\n";
//echo "\n".$article->id_categ."\n"; n'est pas compter dans la recherche
echo "\n==============================\n";


echo "\n-------------- Methodes has_many() -------------\n";
$categorie = Categorie::first(1);
$articles = $categorie->has_many('Article','id_categ');

foreach ($articles as $article) {
    echo "\n==============================\n";
    echo "\nArticle :".$article->id."\n";
    echo "\nNom: ".$article->nom."\n";
    echo "\nDescription: ".$article->descr."\n";
    echo "\nTarif: ".$article->tarif."\n";
    echo "\nId Categorie: ".$article->id_categ."\n";
    echo "\n==============================\n";
}




echo "\n-------------- Methode belongs_to() -------------\n";
$article = Article::first(65);
$categ = $article->belongs_to('Categorie','id_categ');
echo "\n==============================\n";
echo "\nArticle :".$categ->id."\n";
echo "\nNom: ".$categ->nom."\n";
echo "\nDescription: ".$categ->descr."\n";
echo "\n==============================\n";






echo "\n-------------- Methode article() -------------\n";
$categ = Categorie::first(1);
$articles = $categ->articles();
foreach ($articles as $article) {
    echo "\n==============================\n";
    echo "\nArticle :".$article ->id."\n";
    echo "\nNom: ".$article->nom."\n";
    echo "\nDescription: ".$article->descr."\n";
    echo "\nTarif: ".$article->tarif."\n";
    echo "\nId Categorie: ".$article->id_categ."\n";
    echo "\n==============================\n";
}





echo "\n-------------- Methode categorie() -------------\n";
$article = Article::first(65);
$categorie = $article->categorie();
echo "\n==============================\n";
echo "\nCategorie : ".$categorie->id."\n";
echo "\nNom: ".$categorie->nom."\n";
echo "\nDescription: ".$categorie->descr."\n";
echo "\n==============================\n";




?>
