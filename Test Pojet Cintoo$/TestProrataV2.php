
<html>
  <!--
 * Nom du fichier : TestProrataV2.php
 * Auteur : Baptiste PUCHAUX-LELOUP
 * Date de création : 2023-02-01
 * Version : 3.0 
 * Description : Récupéré des valeurs d'un abonnement dans une base de données afin de calculer un prorata

  -->
<header>
  <title>Calcule Porata</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="Resarch.js"></script>



      <img class="logo" src="navlogo2.webp" alt="Logo de votre site" onClick="window.location.href='TestProrataV2.php'">
      <h1 class="title">Prorata</h1>
      <INPUT type="button" value="Login" onClick="window.location.href='login.php'">
  
</header>
  <body>
    <form action="" method="post">
      <label for="subscription_name">Enter the Customer Name :</label>
      <select name="subscription_name" id="subscription_name">
          <option value="">Select Name</option>
    
<?php
////////////////////////////////////////////////////////////////////////////////////////////////
////////En developpement systeme de connexion de l'utilisateurs////////////////////////////////
//-- tester si l'utilisateur est connecté --
            session_start();
            if($_SESSION['username'] !== ""){
            $user = $_SESSION['username'];
            // afficher un message
            echo "Bonjour $user, vous êtes connecté";
            }
///////////////////////////////////////////////////////////////////////////////////////////////

            //Récupère les données d'une BDD
            $conn = mysqli_connect("localhost", "root", "", "testprorata");
            if ($conn->connect_error) {
             die("La connexion a échoué: " . $conn->connect_error);
            }
            $subscriptionQuery = "SELECT name FROM subscriptions ORDER BY name ASC";
            $subscriptionResult = mysqli_query($conn, $subscriptionQuery);
            while ($subscriptionRow = mysqli_fetch_assoc($subscriptionResult)) {
                $name = $subscriptionRow['name'];
                echo "<option value='$name'>$name</option>";
            }
            ?>


      </select>
            <!-- En developpement d'une barre de recherche pour afficher les noms présents dans la BDD pendant la frappe de carratère
            <input type="text" id="search">
          -->
            <!-- Boutton pour aller Show les Valeurs -->
            <input type="submit" name="submit" value="Show">
             <!-- Boutton pour aller a la page d'ajout d'un subscriber -->
        <INPUT type="button" value="Add Subscriber" onClick="window.location.href='ajouterSubscriber.php'">

      <!--<button type="submit" class="button" name="submit" value="Ajouter"><span>Afficher</span></button>
        <br><button type="buton" class="button" onClick="window.location.href='ajouterSubscriber.php'"><span>New Subscriber</span></button>
      -->
    </form>
    

  </body>
  
    <?php
    ////////Systeme de verification qu'une valeurs et bien selectionné////////////////
    if (isset($_POST['submit'])) {
        $subscriptionName = $_POST['subscription_name'];
        if ($subscriptionName == "") {
          echo '<span style="color:red; font-weight:bold; font-size: 30px;"><center>/!\ Please select a name /!\</center></span>';
        } else {
                $conn = mysqli_connect("localhost", "root", "", "testprorata");
                $subscriptionQuery = "SELECT id, name, start_date, end_date, new_end_date, capacity,capacity_uti, unit_price, new_price, tax_rate FROM subscriptions WHERE name = '$subscriptionName'";
                $subscriptionResult = mysqli_query($conn, $subscriptionQuery);
                $subscriptionRow = mysqli_fetch_assoc($subscriptionResult);
                $subscriptionId = $subscriptionRow['id'];
                $name = $subscriptionRow['name'];
                $startDate = $subscriptionRow['start_date'];
                $endDate = $subscriptionRow['end_date'];
                $newDateEnd = $subscriptionRow['new_end_date'];
                $capacity = $subscriptionRow['capacity'];
                $uticapacity = $subscriptionRow['capacity_uti'];
                $unitPrice = $subscriptionRow['unit_price'];
                $taxRate = $subscriptionRow['tax_rate'];
                $refundQuery = "SELECT SUM(amount) as total_refunds FROM refunds WHERE subscription_id = $subscriptionId";
                $creditDue= 0.00;
        
        
        $numberOfScans = $capacity;
        $pricePerUnit = 110;
        $pricePer500 = 500;
        
        if ($numberOfScans >= 500) {
        $numberOf500 = ceil($numberOfScans / 500);
        $totalCost = $numberOf500 * $pricePerUnit;
        } else {
        $totalCost = $numberOfScans * $pricePerUnit;
        }
        //echo "Le coût total pour " . $numberOfScans . " scans est de $" . $totalCost . "/mo <br>";

////////////////////////////////////////////////////////////////////////////////
// Récupérer la date de début et la date de fin de l'abonnement
$start_Date = new DateTime($subscriptionRow['start_date']);
$end_Date = new DateTime($subscriptionRow['end_date']);

// Calculer le nombre de jours restants dans l'abonnement
$now = new DateTime();
$remainingDays = $start_Date->diff($end_Date)->days;

// Calculer le prix total de l'abonnement
$totalPrice = $subscriptionRow['unit_price'];;

// Calculer le prorata
$prorata = ($totalPrice / 365) * $remainingDays;
$daterest = 365 - $remainingDays;

$creditDue = $totalPrice - $prorata;

//Calculer le pourcentage de scans utilisé
$percenuti = $uticapacity / $capacity *100;

// Afficher le prorata
echo "The pro rata cost for " . $daterest . " remaining days is to " .number_format($creditDue, 2)."€";  
        
      ?>
<!--////////////////////////////////////////////////////////////////////////////////Premier tableau -->      
            <table>
            <th colspan="2">Credit For Annual Plan</th>
            <tr>
              <th>Information</th>
              <th>Value</th>
            </tr>
            <tr>
              <td>Subscription ID</td>
              <td><?php echo $subscriptionId ?></td>
            </tr>
            <tr>
              <td>Name Organization</td>
              <td><?php echo $name ?></td>
            </tr>
            <tr>
              <td>Start Date</td>
              <td><?php echo $startDate ?></td>
            </tr>
            <tr>
              <td>Price</td>
              <td><?php echo " €" . $unitPrice ?></td>
            </tr>
            <tr>
              <td>End Date</td>
              <td><?php echo $endDate ?></td>
            </tr>
            <tr>
              <td>Capacity</td>
              <td><?php echo $uticapacity."/".$capacity." = ".number_format($percenuti, 2)."%" ?></td>
            </tr>
            
            <tr>
              <td>TVA</td>
              <td><?php echo $taxRate . "%" ?></td>
            </tr>
            <tr>
              <td>Credit Due</td>
              <td id="credit"><?php echo number_format($creditDue, 2)." €" ?></td>
            </tr>
            <tr>
            <tr>
              <td>remaining Days</td>
              <td><?php echo $remainingDays."j"?></td>
            </tr>
            
          </table>

    
    <?php 
    
    // Nouvelle date de fin d'abonnement pour le nouveau plan
    $newEndDate = new DateTime($subscriptionRow['new_end_date']);
    // Calculer le prorata pour le nouveau plan
    $newPrice = $subscriptionRow['new_price'];
    //$costprorata = $newPrice - $creditDue ;

    $newRemainingDays = $end_Date->diff($newEndDate)->days;
    $newProrata = ($newPrice / 365) * $newRemainingDays;
    $newDaterest = 365 - $newRemainingDays;
    $NewCreditDue = $newProrata - $creditDue;
    ?>
    <!--////////////////////////////////////////////////////////////////////////////////Deuxieme tableau -->
        <table>
          <tr>
            <th colspan="2">Pro-rated New PLan</th>
          </tr>
          <tr>
            <td>Upgrade Date</td>
            <td><?php echo $endDate ?></td>
          </tr>
          <tr>
            <td>New Price</td>
            <td><?php echo $newPrice." €" ?></td>
          </tr>
          <tr>
            <td>Sub End Date</td>
            <td><?php echo $newDateEnd ?></td>
          </tr>
          <tr>
            <td>New Capacity</td>
            <td><?php echo $capacity ?></td>
          </tr>
          <tr>
            <td>TVA</td>
            <td><?php echo $taxRate . "%" ?></td>
          </tr>
          <tr>
            <td>Pro-rated Cost</td>
            <td id="costProra"><?php echo number_format($newProrata, 2)." €" ?></td>
          </tr>
          <tr>
        </tr>
        </table>
        <!--////////////////////////////////////////////////////////////////////////////////Troisième tableau -->
        <table>
          <tr>
            <th colspan="2">To Put on Quote</th>
          </tr>
          <tr>
            <td>Credit</td>
            <td id="credit"><?php echo "-".number_format($creditDue, 2)." €" ?></td>
          </tr>
          <tr>
            <td>New Plan Pro-rated</td>
            <td id="costProra"><?php echo number_format($newProrata, 2)." €" ?></td>
          </tr>
          <tr>
            <td>Invoice to Customer</td>
            <td id="invoice"><?php echo number_format($NewCreditDue, 2)." €" ?></td>
          </tr>
          <tr>
            <td>Days Number</td>
            <td><?php echo $newRemainingDays ?></td>
          </tr>
        </table><br><br>
<?php }}?>

<div class="footer">
  <p>© 2022 Prorata Cintoo Cloud - all rights reserved.</p>
</div>
</html>