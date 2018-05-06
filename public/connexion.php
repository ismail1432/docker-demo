<?php

function connectToDatabase()
{
    try {
        $bdd = new \PDO('mysql:host=mydockersql;dbname=docker_demo;charset=utf8', 'root', 'dockpwd');
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    return $bdd;
}

function runQuery($sql)
{
    $bdd = connectToDatabase();

    $query = $bdd->prepare($sql);
    $query->execute();
}


if (isset($_GET['remove'])) {
    $removeId = $_GET['remove'];
    runQuery("DELETE FROM langage WHERE id = $removeId");
}
if (isset($_GET['create'])) {
    runQuery("INSERT INTO `langage` (`id`, `name`) VALUES (NULL, 'php'), (NULL, 'java'), (NULL, 'javascript'), (NULL, 'ruby'), (NULL, 'c')");
}

$bdd = connectToDatabase();
$req = $bdd->query('SELECT * FROM langage');

if ($req) {
    $langages = [];
    $langages = $req->fetchAll();
}
