<?php
function updateStudents($id_update){
    
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=app_gestion_presence', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
    
    $sqlQuery = 'SELECT * FROM apprenants WHERE id = :id';

    $retrieveRecipeStatement = $pdo->prepare($sqlQuery);
    $retrieveRecipeStatement->execute([
        'id' => (int)$id_update,
    ]);
    return $recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);
} 
?>