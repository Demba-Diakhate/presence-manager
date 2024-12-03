<?php 
include ('../models/postHistoryAttendance.php');
include_once ('../controllers/presenceControllers.php');
$apprenants = showStudentsController();


if(isset($_POST['submit'])){
    if(
        !isset($_POST['id_apprenant']) || !isset($_POST['statuts'])
    ){
        echo 'Remplir le formulaire.';
        return;
    }
    
    $id_apprenant = $_POST['id_apprenant'];
    $statuts = $_POST['statuts'];
    $date_presence = date('Y-m-d H:i:s');

    postHistoryAttendance($id_apprenant, $statuts, $date_presence);
    header("Location: showStudents.php"); 
}

try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=gestion_presence', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
// Recherche et filtre
$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? '';

$sql = "SELECT * FROM apprenants WHERE 1";

if ($search) {
    $sql .= " AND (nom LIKE '%$search%' OR prenom LIKE '%$search%' OR cohorte LIKE '%$search%')";
}elseif (empty($search)) {
    $sql;
}
if ($filter) {
    $sql .= " AND (cohorte LIKE '%$filter%')";
}

if ($filter) {
    $sql .= " AND cohorte = '$filter'";
}elseif (empty($filter)) {
    $sql;
}


$sql .= " ORDER BY nom ASC, prenom ASC ";

$result = $pdo->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de présence</title>
    <link rel ="stylesheet" href="../../public/output.css">
</head>
<body class="bg-gray-50">
    <header class="bg-stone-500 h-16 p-5">
        <nav>
            <ul class="flex justify-center items-center gap-4 text-white">
                <li><a href="showStudents.php">Home</a></li>
                <li><a href="historyAttendance.php">Historique</a></li>
                <li><a href="addStudents.php">Ajout</a></li>
            </ul>
        </nav>
    </header>
    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex md:space-x-3" method="get">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" name="search" value="<?= htmlspecialchars($search) ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" >
                            </div>
                            <button type="submit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">Rechercher</button>
                        </form>
                    </div>
                    <form method="get" class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="submit" class="flex items-center justify-center text-white bg-stone-500 hover:bg-stone-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Filtrer
                        </button>                        
                        <select id="filterDropdownButton" name="filter" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <option value="">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                </svg>
                                    Les cohortes
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </option>
                            <option value="Cohorte 1" >Cohorte 1</option>
                            <option value="Cohorte 2">Cohorte 2</option>
                        </select>                     
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Id</th>
                                <th scope="col" class="px-4 py-3">Prenom</th>
                                <th scope="col" class="px-4 py-3">Nom</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Telephone</th>
                                <th scope="col" class="px-4 py-3">Cohorte</th>
                                <th scope="col" class="px-4 py-3">Satuts</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Submit</span>
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && $result->rowCount() > 0): ?>
                                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr class="border-b dark:border-gray-700">
                                <form action="showStudents.php" method="post">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><input type="text" name="id_apprenant" value="<?= htmlspecialchars($row['id']) ?>" class="hidden"><?= htmlspecialchars($row['id']) ?></th>
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= htmlspecialchars($row['prenom']) ?></th>
                                    <td class="px-4 py-3"><?= htmlspecialchars($row['nom']) ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($row['email']) ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($row['telephone']) ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($row['cohorte']) ?></td>
                                    <td class="px-4 py-3">
                                        <select name="statuts" id="" class="border-none" required>
                                            <option value="">Prés.../Abs...</option>
                                            <option value="Present(e)">Present(e)</option>
                                            <option value="Absent(e)">Absent(e)</option>
                                        </select>
                                     </td>
                                    <td><button type="submit" name="submit">Submit</button></td>
                                </form>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="<?= htmlspecialchars($row['id']) ?>" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="<?= htmlspecialchars($row['id']) ?>" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                            </li>
                                            <li>
                                                <a href="updateStudents.php?id=<?= htmlspecialchars($row['id']) ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modifier</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="delete.php?id=<?= htmlspecialchars($row['id']) ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <!-- <tr class="">
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class="">Aucun résultat trouvé</td>
                                </tr> -->
                                <?php foreach ($result as $res):?>
                                    <tr class="border-b dark:border-gray-700">
                                        <form action="showStudents.php" method="post">
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><input type="text" name="id_apprenant" value="<?php echo $apprenant['id']; ?>" class="hidden"><?php echo $apprenant['id']; ?></th>
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $apprenant['prenom']; ?></th>
                                            <td class="px-4 py-3"><?php echo $res['nom']; ?></td>
                                            <td class="px-4 py-3"><?php echo $res['email']; ?></td>
                                            <td class="px-4 py-3"><?php echo $res['telephone']; ?></td>
                                            <td class="px-4 py-3"><?php echo $res['cohorte']; ?></td>
                                            <td class="px-4 py-3">
                                                <select name="statuts" id="" class="border-none" required>
                                                    <option value="">Prés.../Abs...</option>
                                                    <option value="present(e)">Present(e)</option>
                                                    <option value="absent(e)">Absent(e)</option>
                                                </select>
                                            </td>
                                            <td><button type="submit" name="submit">Submit</button></td>
                                        </form>
                                        <td class="px-4 py-3 flex items-center justify-end">
                                            <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="<?php echo $res['id']; ?>" class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                            <div id="<?php echo $res['id']; ?>" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="apple-imac-27-dropdown-button">
                                                    <li>
                                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                    </li>
                                                    <li>
                                                        <a href="updateStudents.php?id=<?php echo $res['id']; ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modifier</a>
                                                    </li>
                                                </ul>
                                                <div class="py-1">
                                                    <a href="delete.php?id=<?php echo $res['id']; ?>" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Supprimer</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
        </div>
        </section>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>