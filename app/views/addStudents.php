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
<body class="bg-[#BABABA]">
     <div class="container flex md:flex-row flex-col w-3/4 bg-white gap-1 mx-auto my-20">
        <form action="addStudents.php" method="POST" class="bg-white md:w-1/2 w-full flex flex-col md:p-6 gap-8 py-10">
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Prenom</label>
                <input 
                    type="text" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    name="firstNameInput" 
                    id="firstNameInput"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Nom</label>
                <input 
                    type="text" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    name="lastNameInput" 
                    id="lastNameInput"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Email</label>
                <input 
                    type="email" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    name="email" 
                    id="email"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Telephone</label>
                <input 
                    type="text" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    name="telInput" 
                    id="telInput"
                    required
                >
            </div>    
            <div class="flex gap-3 mx-auto">
                <div>
                   <select name="cohorte" id="cohorte" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        <option value="">Choisir un cohorte</option>
                        <option value="Cohorte 1">Cohorte 1</option>
                        <option value="Cohorte 2">Cohorte 2</option>
                   </select>
                </div>
            </div>
            <!-- <button class="text-white md:ml-[68%] mx-auto bg-stone-500 p-3 w-1/5" type="submit" name="send">Ajouter</button> -->
            <div class="flex flex-row gap-3 justify-end mr-12">
                <button class="text-white bg-stone-500 font-bold p-3 w-1/5" type="submit" name="send">Ajouter</button>
                <a href="./showStudents.php" class="text-black border border-black font-bold p-3 w-1/5">Annuler</a>
            </div>

        </form>
        <div class="md:w-1/2 w-full p-10 bg-stone-500 flex justify-center items-center">
            <h2 class="text-3xl font-bold text-white md:mt-28 my-28 text-center">Ajouter un apprenant</h2>
        </div>
     </div>
</body>
</html>