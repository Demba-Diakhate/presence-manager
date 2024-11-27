<?php 
function addStudents($prenom, $nom, $email,$telephone,$cohorte){
    include('db.php');
    $pdo = connect();
      
    $sqlQuery = 'INSERT INTO apprenants(prenom, nom, email, telephone, cohorte) VALUES (:prenom, :nom, :email, :telephone, :cohorte)';
        
    $insertRecipe = $pdo->prepare($sqlQuery);
        
    try {
        $insertRecipe->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':email' => $email,
            ':telephone' => $telephone,
             ':cohorte' => $cohorte,
        ]);
        
        echo "L'utilisateur a été ajouté avec succès !";
        
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>