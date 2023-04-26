<?php
//récupère les données du formulaire
$name = $_POST['name'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];
$newendDate = $_POST['new_end_date'];
$capacity = $_POST['capacity'];
$capacityuti = $_POST['capacity_uti'];
$unitPrice = $_POST['unit_price'];
$newPrice = $_POST['new_price'];

//connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "testprorata");

//insertion des données dans la table subscriptions
$insertQuery = "INSERT INTO subscriptions (name, start_date, end_date, new_end_date, capacity, capacity_uti, unit_price, new_price) VALUES ('$name', '$startDate', '$endDate', '$newendDate', $capacity, $capacityuti, $unitPrice, $newPrice)";

// Exécution de la requête
if(mysqli_query($conn, $insertQuery)) {
    echo "Valeurs ajoutées à la base";
    echo '<br><button onclick="window.location.href=\'TestProrataV2.php\'">Retourner à la page principale</button>';

  } else {
    echo "Erreur: " . mysqli_error($conn);
  }
  
  // Fermeture de la connexion à la base de données
  mysqli_close($conn);
  ?>
