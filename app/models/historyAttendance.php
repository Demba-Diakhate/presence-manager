<?php
    include_once "db.php";
    function historyAttendance(){
        $pdo = connect();
        $sqlQuery = 'SELECT apprenants.prenom, apprenants.nom, apprenants.email, apprenants.telephone, apprenants.cohorte, presences.statuts 
             FROM presences 
             JOIN apprenants ON presences.id_apprenant = apprenants.id 
             ';
        $recipesStatement = $pdo->prepare($sqlQuery);
        $recipesStatement->execute();
        $apprenants = $recipesStatement->fetchAll();
        return $apprenants;
    }
?>