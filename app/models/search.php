<?php 
function searchHistoryAttendance($search){
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=app_gestion_presence', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
    // Recherche et filtre
    $sql = "SELECT apprenants.prenom, apprenants.nom, apprenants.email, apprenants.telephone, apprenants.cohorte, presences.statuts, presences.date_presence, presences.heure_save 
            FROM presences
            JOIN apprenants ON presences.id_apprenant = apprenants.id  WHERE 1";
    
    if ($search) {
        $sql .= " AND (apprenants.nom LIKE '%$search%' OR apprenants.prenom LIKE '%$search%' OR apprenants.email LIKE '%$search%' OR apprenants.cohorte LIKE '%$search%' OR apprenants.telephone LIKE '%$search%' OR presences.statuts LIKE '%$search%' OR presences.date_presence LIKE '%$search%')";
    }elseif (empty($search)) {
        $sql;
    }
    
    $sql .= " ORDER BY presences.date_presence DESC, apprenants.nom ASC, apprenants.prenom ASC";
    
    $result = $pdo->query($sql);
    return $result;
}


function searchShowStudents($search, $filter){
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=app_gestion_presence', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
    // Recherche et filtre
    
    $sql = "SELECT * FROM apprenants WHERE 1";
    
    if ($search) {
        $sql .= " AND (nom LIKE '%$search%' OR prenom LIKE '%$search%' OR email LIKE '%$search%' OR telephone LIKE '%$search%' OR cohorte LIKE '%$search%')";
    }elseif (empty($search)) {
        $sql;
    }
    if ($filter) {
        $sql .= " AND (cohorte LIKE '%$filter%')";
    }
    
    
    $sql .= " ORDER BY nom ASC, prenom ASC ";
    
    $result = $pdo->query($sql);
    return $result;
}
?>