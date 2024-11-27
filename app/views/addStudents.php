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
    addStudentsController($prenom,$nom,$email,$cohorte,$telephone);
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
                    class="p-3 bg-[#BABABA]"
                    name="firstNameInput" 
                    id="firstNameInput"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Nom</label>
                <input 
                    type="text" 
                    class="p-3 bg-[#BABABA]"
                    name="lastNameInput" 
                    id="lastNameInput"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Email</label>
                <input 
                    type="email" 
                    class="p-3 bg-[#BABABA]"
                    name="email" 
                    id="email"
                    required
                >
            </div>
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Telephone</label>
                <input 
                    type="" 
                    class="p-3 bg-[#BABABA]"
                    name="telInput" 
                    id="telInput"
                    required
                >
            </div>    
            <div class="flex gap-3 mx-auto">
                <div>
                   <select name="cohorte" id="cohorte" class="border border-black p-0.5 rounded-lg">
                        <option value="cohorte1">Cohorte 1</option>
                        <option value="cohorte2">Cohorte 2</option>
                   </select>
                </div>
            </div>
            <button class="text-white md:ml-[68%] mx-auto bg-[#342E37] p-3 w-1/5" type="submit" name="send">Ajouter</button>
        </form>
        <div class="md:w-1/2 w-full p-10 bg-[#342E37] flex justify-center items-center">
            <h2 class="text-3xl font-bold text-white md:mt-28 my-28 text-center">Ajouter un apprenant</h2>
        </div>
     </div>
</body>
</html>