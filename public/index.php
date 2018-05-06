<?php

require 'connexion.php';

echo "<h1>Hello from Docker</h1>";

if(!empty($langages)) {
    echo "<ul>";
    foreach ($langages as $langage) {
    $id = $langage['id'];
        echo '<li> Id '.$langage['id'].': '. ucfirst($langage['name']) .'  '.'<a href="?remove='.$id.'">click to remove</a> </li>';
    }
    echo "</ul>";
}
else {
    echo "<h2>No langages</h2>";
    echo '<p><a href="?database">Create DataBase ?</a></p>';
    echo '<p><a href="?create">Create Data ?</a></p>';

}
