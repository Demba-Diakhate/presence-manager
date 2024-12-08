<?php 
function connect() {
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=gestion_presence', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
    return $pdo;
}

?>