<?php
function showStudentsController(){
    include_once ('../models/showStudents.php');
    $apprenants = showStudents();
    return $apprenants;
}

function addStudentsController($prenom,$nom,$email,$telephone,$cohorte){       
         
    include_once('../models/addStudents.php');
    addStudents($prenom,$nom,$email,$telephone,$cohorte);

}

function historyAttendanceController(){
    include_once ('../models/historyAttendance.php');
    $apprenants = historyAttendance();
    return $apprenants;
}

function updateStudentsController(){
    $getData = $_GET;

    if (!isset($getData['id']) || !is_numeric($getData['id'])) {
        echo('Il faut un identifiant pour la modification.');
        return;
    }

    return $id_update = $getData['id'];
}

?>