<?php
function showStudentsController(){
    include_once ('../models/showStudents.php');
    $apprenants = showStudents();
    return $apprenants;
}

function addStudentsController($prenom,$nom,$email,$telephone,$cohorte){       
         
    include_once('../models/addStudents.php');
    addStudents($prenom,$nom,$email,$cohorte,$telephone);

}

function historyAttendanceController(){
    include_once ('../models/historyAttendance.php');
    $apprenants = historyAttendance();
    return $apprenants;
}


?>