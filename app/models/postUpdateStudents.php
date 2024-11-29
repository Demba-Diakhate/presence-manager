<?php 
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=app_gestion_presence', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
$postData = $_POST;
var_dump($postData);

if (
    !isset($postData['id'])
    || !is_numeric($postData['id'])
    || empty($postData['firstNameInput'])
    || empty($postData['lastNameInput'])
    || empty($postData['email'])
    || empty($postData['telInput'])
    || empty($postData['cohorte'])
    || trim(strip_tags($postData['firstNameInput'])) === ''
    || trim(strip_tags($postData['lastNameInput'])) === ''
    || trim(strip_tags($postData['email'])) === ''
    || trim(strip_tags($postData['telInput'])) === ''
    || trim(strip_tags($postData['cohorte'])) === ''
) {
    echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}

$id = (int)$postData['id'];
$prenom = trim(strip_tags($postData['firstNameInput']));
$nom = trim(strip_tags($postData['lastNameInput']));
$email = trim(strip_tags($postData['email']));
$telephone = trim(strip_tags($postData['telInput']));
$cohorte = trim(strip_tags($postData['cohorte']));

$sqlQuery = 'UPDATE apprenants SET prenom = :prenom, nom = :nom, email = :email, telephone = :telephone, cohorte = :cohorte WHERE id = :id';
$insertRecipeStatement = $pdo->prepare($sqlQuery);
$insertRecipeStatement->execute([
    ':prenom' => $prenom,
    ':nom' => $nom,
    ':email' => $email,
    ':telephone' => $telephone,
    ':cohorte' => $cohorte,
    ':id' => $id,
]);
header("Location: ../views/showStudents.php");
?>