<?php
    include_once "db.php";
    function showStudents(){

    //     $dataFiltered = $_GET;
    // if (isset($dataFiltered['filter_cohorte']) && !empty($dataFiltered['type_cohorte'])) {

    //     $cohorteFiltered = $dataFiltered['type_cohorte'];
    //     $pdo = connect();
    //     $sqlQuery = "SELECT * FROM apprenants WHERE cohorte='$cohorteFiltered'";
    //     $recipesStatement = $pdo->prepare($sqlQuery);
    //     $recipesStatement->execute();
    //     $apprenants = $recipesStatement->fetchAll();
    //     return $apprenants;

    // } else {

        $pdo = connect();
        $sqlQuery = 'SELECT * FROM apprenants';
        $recipesStatement = $pdo->prepare($sqlQuery);
        $recipesStatement->execute();
        $apprenants = $recipesStatement->fetchAll();
        return $apprenants;

    }
    // }
?>