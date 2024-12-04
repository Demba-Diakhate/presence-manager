<?php 
include_once ('../models/updateStudents.php');
include_once ('../controllers/presenceControllers.php');
$id_update = updateStudentsController();
$recipe = updateStudents($id_update);
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
    <?php 
     ?>
     <div class="container flex md:flex-row flex-col w-3/4 bg-white gap-1 mx-auto my-20">
        <form action="../models/postUpdateStudents.php" method="POST" class="bg-white md:w-1/2 w-full flex flex-col md:p-6 gap-8 py-10">
            <input type="text" name="id" class="hidden" value="<?php echo($recipe['id']) ;?>">
            <div class="prenom flex flex-col w-3/4 md:mx-left mx-auto bg-transparent">
                <label for="name">Prenom</label>
                <input 
                    type="text" 
                    class="p-3 bg-[#BABABA]"
                    name="firstNameInput" 
                    id="firstNameInput"
                    value="<?php echo($recipe['prenom']) ;?>"
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
                    value="<?php echo($recipe['nom']) ;?>"
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
                    value="<?php echo($recipe['email']) ;?>"
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
                    value="<?php echo($recipe['telephone']) ;?>"
                    required
                >
            </div>    
            <div class="flex gap-3 mx-auto">
                <div>
                   <select name="cohorte" id="cohorte" class="border border-black p-0.5 rounded-lg" required>
                        <option value="<?php echo($recipe['cohorte']) ;?>"><?php echo($recipe['cohorte']) ;?></option>
                        <option value="cohorte1">Cohorte 1</option>
                        <option value="cohorte2">Cohorte 2</option>
                   </select>
                </div>
            </div>
            <div class="flex flex-row gap-3 justify-end mr-16">
                <button class="text-white bg-[#342E37] font-bold p-3 w-1/5" type="submit" name="send">Modifier</button>
                <a href="./showStudents.php" class="text-black border border-black font-bold p-3 w-1/5">Annuler</a>
            </div>
        </form>
        <div class="md:w-1/2 w-full p-10 bg-[#342E37] flex justify-center items-center">
            <h2 class="text-3xl font-bold text-white md:mt-28 my-28 text-center">Ajouter un apprenant</h2>
        </div>
     </div>
</body>
</html>