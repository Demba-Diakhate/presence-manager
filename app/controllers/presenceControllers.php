<?php
function showStudentsController(){
    include_once ('../models/showStudents.php');
    $apprenants = showStudents();
    return $apprenants;
}

function addStudentsController($prenom,$nom,$email,$cohorte,$telephone){       
         
    include_once('../models/addStudents.php');
    addStudents($prenom,$nom,$email,$cohorte,$telephone);

}


?>