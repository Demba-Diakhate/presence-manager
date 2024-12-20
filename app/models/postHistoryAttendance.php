<?php 

function postHistoryAttendance($id_apprenant, $statuts, $date_presence){
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=gestion_presence', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }

    $sqlQuery = 'INSERT INTO presences(id_apprenant, statuts, date_presence) VALUES (:id_apprenant, :statuts, :date_presence)';
    $insertRecipe = $pdo->prepare($sqlQuery);
    
    try {
        $insertRecipe->execute([
            ':id_apprenant' => $id_apprenant,
            ':statuts' => $statuts,
            ':date_presence' => $date_presence
        ]);
    
        echo "L'utilisateur a été ajouté avec succès !";
    
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>