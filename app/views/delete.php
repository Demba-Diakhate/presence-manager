<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=app_gestion_presence', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('Il faut un identifiant pour la suppression.');
    return;
}

$sqlDeletePresences = "DELETE FROM presences WHERE id_apprenant = :id_apprenant";
$stmtPresences = $pdo->prepare($sqlDeletePresences);
$stmtPresences->execute([
    ':id_apprenant' => $getData['id']
]);

$sqlQuery = 'DELETE FROM apprenants WHERE id = :id';
$deleteRecipeStatement = $pdo->prepare($sqlQuery);
$deleteRecipeStatement->execute([
    'id' => (int)$getData['id'],
]) or die(print_r($mysqlClient->errorInfo()));

header("Location: showStudents.php");
?>