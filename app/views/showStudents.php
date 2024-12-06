<?php 

// Show all students
include_once ('../controllers/presenceControllers.php');
$apprenants = showStudentsController();


// Post history attendance
if(isset($_POST['submit'])){
    var_dump($_POST);
    $postSubmit = $_POST['submit'];
    $id_apprenant = $_POST['id_apprenant'];
    $statuts = $_POST['statuts'];
    $date_presence = $_POST['date_presence'];
    postHistoryAttendanceController($postSubmit, $id_apprenant, $statuts, $date_presence);
};


// Search and Filter
$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? '';
include_once('../models/search.php');
$result = searchShowStudents($search, $filter);

// Récupérer le chemin de la page active
$currentPage = basename($_SERVER['PHP_SELF']);

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
    <header class=" bg-fuchsia-900 h-20 p-5 flex justify-between items-center">
        <div>
            <img src="../../public/images/wommate.png" class="h-16" alt="Logo Wommate">
        </div>
        <nav>
            <ul class="flex justify-center items-center gap-5 text-white">
                <li class="font-semibold <?= $currentPage === 'showStudents.php' ? 'bg-fuchsia-500 border border-fuchsia-500 text-white' : ' text-white'?> px-4 py-2 rounded hover:ring-2 hover:ring-fuchsia-500"><a href="showStudents.php">Liste apprenants</a></li>
                <li class="font-semibold <?= $currentPage === 'historyAttendance.php' ? ' text-white' : 'bg-fuchsia-800 border border-fuchsia-800 text-white'?> px-4 py-2 rounded hover:bg-fuchsia-700 hover:ring-2 hover:ring-fuchsia-500"><a href="historyAttendance.php">Historique de présence</a></li>
                <li class="flex items-center justify-center text-white bg-cyan-700 border border-cyan-700 hover:ring-2 hover:ring-cyan-500 font-semibold rounded text-sm px-8 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"><a href="addStudents.php">Ajouter</a></li>
            </ul>
        </nav>
    </header>
    <section class="dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto px-4 lg:px-12">
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
                                <input type="text" id="simple-search" name="search" value="<?= htmlspecialchars($search) ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-300 focus:border-fuchsia-300 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" >
                            </div>
                            <button type="submit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">Rechercher</button>
                        </form>
                    </div>
                    <form method="get" class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="submit" class="flex items-center justify-center text-white bg-fuchsia-900 hover:bg-fuchsia-800 focus:ring-4 focus:ring-fuchsia-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 " viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filtrer
                        </button>                        
                        <select id="filterDropdownButton" name="filter" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-fuchsia-300 focus:border-fuchsia-300 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
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
                                <th scope="col" class="px-4 py-3">Date</th>
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
                                        <select name="statuts" id="" class="rounded border-none focus:ring-gray-400" required>
                                            <option value="">Statut</option>
                                            <option value="Present(e)" class="text-cyan-700 font-semibold">Present(e)</option>
                                            <option value="Absent(e)" class="text-fuchsia-700 font-semibold">Absent(e)</option>
                                        </select>
                                     </td>
                                     <td class="px-4 py-3"><input type="date" name="date_presence" class="border rounded" required></td>
                                    <td><button type="submit" name="submit" class="flex items-center justify-center text-white bg-gray-400 hover:bg-fuchsia-800 focus:ring-4 focus:ring-fuchsia-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-400 dark:hover:bg-gray-400 focus:outline-none dark:focus:ring-gray-400">Submit</button></td>
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
                                <p class="text-center font-medium text-gray-700 dark:text-white">Aucun résultat trouvé.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 left-0 right-0 z-50 mx-[550px] my-60 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-stone-100 rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                            <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>



        </section>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>