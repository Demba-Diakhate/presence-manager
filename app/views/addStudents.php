<?php 
include_once ('../controllers/presenceControllers.php');
if(isset($_POST['send'])){
    if(
        !isset($_POST['firstNameInput']) || !isset($_POST['lastNameInput']) || !isset($_POST['email']) || !isset($_POST['telInput']) || !isset($_POST['cohorte'])
    ){
        echo 'Remplir le formulaire.';
        return;
    }
    $prenom = $_POST['firstNameInput'];
    $nom = $_POST['lastNameInput'];
    $email = $_POST['email'];
    $telephone = $_POST['telInput'];
    $cohorte = $_POST['cohorte'];
    addStudentsController($prenom,$nom,$email,$telephone,$cohorte);
    header("Location: showStudents.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un apprenant</title>
    <link rel="stylesheet" href="../../public/output.css">
</head>
<body class="bg-gray-50">
    <div class="container shadow-lg flex md:flex-row flex-col w-3/4 bg-white gap-1 mx-auto my-20">
        <form action="addStudents.php" method="POST" class="bg-white md:w-1/2 w-full flex flex-col md:p-6 gap-8 py-10">
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Prenom</label>
                <input 
                    type="text" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-300 focus:border-fuchsia-300 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-300 dark:focus:border-fuchsia-300"
                    name="firstNameInput" 
                    id="firstNameInput"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Nom</label>
                <input 
                    type="text" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-300 focus:border-fuchsia-300 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-300 dark:focus:border-fuchsia-300"
                    name="lastNameInput" 
                    id="lastNameInput"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Email</label>
                <input 
                    type="email" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-300 focus:border-fuchsia-300 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-300 dark:focus:border-fuchsia-300"
                    name="email" 
                    id="email"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Telephone</label>
                <input 
                    type="text" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-300 focus:border-fuchsia-300 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-300 dark:focus:border-fuchsia-300"
                    name="telInput" 
                    id="telInput"
                    required
                >
            </div>    
            <div class="flex gap-3 mx-auto">
                <div>
                   <select name="cohorte" id="cohorte" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-300 focus:border-fuchsia-300 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-300 dark:focus:border-fuchsia-300" required>
                        <option value="">Choisir une cohorte</option>
                        <option value="Cohorte 1">Cohorte 1</option>
                        <option value="Cohorte 2">Cohorte 2</option>
                   </select>
                </div>
            </div>
            <!-- <button class="text-white md:ml-[68%] mx-auto bg-stone-500 p-3 w-1/5" type="submit" name="send">Ajouter</button> -->
            <div class="flex flex-row gap-4 justify-end mr-14">
                <button class="text-white bg-fuchsia-900 font-bold px-5 py-2 rounded hover:bg-fuchsia-700" type="submit" name="send">Ajouter</button>
                <a href="./showStudents.php" class="text-gray-500 border border-gray-500 font-bold px-5 py-2 rounded hover:bg-gray-500 hover:text-white">Annuler</a>
            </div>

        </form>
        <div class="md:w-1/2 w-full p-10 bg-fuchsia-900 flex flex-col gap-0 justify-center items-center">
            <img src="../../public/images/wommate.png" class="w-5/6 h-48" alt="Wommate Technology">
            <h2 class="text-3xl font-bold text-cyan-600 my-10 text-center">Inscrivez vous</h2>
        </div>
    </div>
</body>
</html>