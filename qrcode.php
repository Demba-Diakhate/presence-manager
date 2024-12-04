<?php
include('phpqrcode/qrlib.php'); //On inclut la librairie au projet
$lien='https://localhost/presence-manager/app/views/showStudents.php'; // Vous pouvez modifier le lien selon vos besoins
QRcode::png($lien, 'image-qrcode.png'); // On crée notre QR Code
echo '<img src="' . 'image-qrcode.png' . '" alt="QR Code">'; // Afficher l'image
?>