<?php 
// View all students attendenced

// include_once ('../controllers/presenceControllers.php');
// $apprenants = historyAttendanceController();


// Search students attendances
$search = $_GET['search'] ?? '';
include_once ('../models/search.php');
$result = searchHistoryAttendance($search);
$result->execute();

$organizedData = [];   
if ($result && $result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $date = $row['date_presence']; 
        if (!isset($organizedData[$date])) {
            $organizedData[$date] = []; 
        }
        $organizedData[$date][] = $row; 
    }
}

// Récupérer le chemin de la page active
$currentPage = basename($_SERVER['PHP_SELF']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des présences</title>
    <link rel="stylesheet" href="../../public/output.css">
</head>
<body class="bg-gray-50">
    <header class=" bg-fuchsia-900 h-20 p-5 flex justify-between items-center">
        <div>
            <img src="../../public/images/wommate.png" class="h-16" alt="Logo Wommate">
        </div>
        <div class="z-50 mt-32 -mr-8 md:z-0 md:mt-0 md:-mr-0 bg-inherit md:bg-inherit hidden md:block w-full md:w-auto md:order-1">
             <ul class="flex flex-row justify-center items-center gap-5 text-white md:flex md:justify-center md:items-center md:gap-5 md:flex-row">
                <li class="font-semibold <?= $currentPage === 'showStudents.php' ? ' text-white' : 'bg-fuchsia-800 border border-fuchsia-800 text-white' ?> px-4 py-2 rounded hover:bg-fuchsia-700 hover:ring-2 hover:ring-fuchsia-500"><a href="showStudents.php">Liste apprenants</a></li>
                <li class="font-semibold <?= $currentPage === 'historyAttendance.php' ? 'bg-fuchsia-500 border border-fuchsia-500 text-white' : ' text-white' ?> px-4 py-2 rounded hover:ring-2 hover:ring-fuchsia-500"><a href="historyAttendance.php">Historique de présence</a></li>
                <li class="flex items-center justify-center w-24 text-white bg-cyan-700 border border-cyan-700 hover:ring-2 hover:ring-cyan-500 font-medium rounded text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"><a href="addStudents.php">Ajouter</a></li>
            </ul>
        </div>
        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
    </header>
        <div class="z-50 -mt-1 pb-3 py-auto pt-3 md:z-0 md:pt-0 md:pl-0 md:pb-0 md:mt-0 md:-mr-0 bg-fuchsia-900 md:bg-inherit hidden md:hidden w-full md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col justify-center items-center gap-5 text-white md:flex md:justify-center md:items-center md:gap-5 md:flex-row">
                <li class="font-semibold w-5/12 flex items-center justify-center <?= $currentPage === 'showStudents.php' ? ' text-white' : 'bg-fuchsia-800 border border-fuchsia-800 text-white' ?> px-4 py-2 rounded hover:bg-fuchsia-700 hover:ring-2 hover:ring-fuchsia-500"><a href="showStudents.php">Liste apprenants</a></li>
                <li class="font-semibold w-5/12 flex items-center justify-center <?= $currentPage === 'historyAttendance.php' ? 'bg-fuchsia-500 border border-fuchsia-500 text-white' : ' text-white' ?> px-4 py-2 rounded hover:ring-2 hover:ring-fuchsia-500"><a href="historyAttendance.php">Historique de présence</a></li>
                <li class="flex items-center justify-center w-5/12 text-white bg-cyan-700 border border-cyan-700 hover:ring-2 hover:ring-cyan-500 font-medium rounded text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"><a href="addStudents.php">Ajouter</a></li>
            </ul>
        </div>
    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto px-4 lg:px-12">
            <div class="bg-white pb-5 w-12/12 dark:bg-gray-800 relative shadow-md sm:rounded-lg">
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
                                <input type="text" id="simple-search" name="search" value="<?= htmlspecialchars($search) ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-300 focus:border-fuchsia-300 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" >
                            </div>
                            <button type="submit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">Rechercher</button>
                        </form>
                    </div>
                    
                </div>
                <div class="overflow-x-auto">                    
                    <?php if (!empty($organizedData)): ?>
                        <?php foreach ($organizedData as $date => $rows): ?>
                            <h2 class="font-bold text-lg mt-10 mb-2 ml-4">Jour : <?= htmlspecialchars($date) ?></h2>
                            <table class="w-full text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Prenom</th>
                                        <th scope="col" class="px-4 py-3">Nom</th>
                                        <th scope="col" class="px-4 py-3">Email</th>
                                        <th scope="col" class="px-4 py-3">Telephone</th>
                                        <th scope="col" class="px-4 py-3">Cohorte</th>
                                        <th scope="col" class="px-4 py-3">Satuts</th>
                                        <th scope="col" class="px-4 py-3">Heure</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800">                               
                                    <?php foreach ($rows as $row): ?>
                                        <tr class="border-b dark:border-gray-700">                               
                                            <td class="px-4 py-3"><?= htmlspecialchars($row['prenom']) ?></td>
                                            <td class="px-4 py-3"><?= htmlspecialchars($row['nom']) ?></td>
                                            <td class="px-4 py-3"><?= htmlspecialchars($row['email']) ?></td>
                                            <td class="px-4 py-3"><?= htmlspecialchars($row['telephone']) ?></td>
                                            <td class="px-4 py-3"><?= htmlspecialchars($row['cohorte']) ?></td>                                    
                                            <td class="px-4 py-3"><?= htmlspecialchars($row['statuts']) ?></td>                                    
                                            <td class="px-4 py-3"><?= htmlspecialchars($row['heure_save']) ?></td>                                 
                                        </tr>                                    
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endforeach; ?>
                    <?php else: ?>                                
                        <p class="text-center font-medium text-gray-700 dark:text-white">Aucun résultat trouvé.</p>
                    <?php endif; ?>                                     
                </div>
            </div>
    </section>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>