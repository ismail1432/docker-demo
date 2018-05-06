<?php

try
{
    $langages = [];
    $bdd = new \PDO('mysql:host=mydockersql;dbname=docker_demo;charset=utf8', 'root', 'dockpwd');

    if(isset($_GET['remove'])) {
        $bdd->prepare('DELETE FROM langage WHERE id = '.$_GET['remove']);
    }
    if(isset($_GET['create'])) {
        $query = $bdd->prepare("INSERT INTO `langage` (`id`, `name`) VALUES (NULL, 'php'), (NULL, 'java'), (NULL, 'javascript'), (NULL, 'ruby'), (NULL, 'c')");
        $query->execute();
    }

    $req = $bdd->query('SELECT * FROM langage');

    if($req) {
        $langages = $req->fetchAll();
    }
}
catch (Exception $e)
{
    echo('Erreur : ' . $e->getMessage(). '<br><br><br>');
}