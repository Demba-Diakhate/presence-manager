<?php
    include_once "db.php";
    function showStudents(){

        $pdo = connect();
        $sqlQuery = 'SELECT * FROM apprenants';
        $recipesStatement = $pdo->prepare($sqlQuery);
        $recipesStatement->execute();
        $apprenants = $recipesStatement->fetchAll();
        return $apprenants;

    }
   
?>