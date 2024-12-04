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

function postHistoryAttendanceController($postSubmit, $id_apprenant, $statuts){
    include_once('../models/postHistoryAttendance.php');
    if(isset($postSubmit)){
        if(
            !isset($id_apprenant) || !isset($statuts)
        ){
            echo 'Remplir le formulaire.';
            return;
        }
        
       
        $date_presence = date('Y-m-d H:i:s');
    
        postHistoryAttendance($id_apprenant, $statuts, $date_presence);
        header("Location: showStudents.php"); 
    };
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

function deleteStudentsController(){
include_once('../models/deleteStudents.php');
deleteStudents();

}

?>