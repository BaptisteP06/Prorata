<html>
 <head>
 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 <link rel="stylesheet" href="log.css" media="screen" type="text/css" />
 <img class="logo" src="navlogo2.webp" alt="Logo de votre site" onClick="window.location.href='TestProrataV2.php'">
 </head>
 <body>
 <div id="container">
 <!-- zone de connexion -->
 
 <form action="verification.php" method="POST">
 <img id="mon-image" class="logo"  src="navlogo2.webp" alt="Logo de votre site">
 <h1>Connexion</h1>
 
 <label><b>Username</b></label>
 <input type="text" placeholder="Enter the username....." name="username" required>

 <label><b>Password</b></label>
 <input type="password" placeholder="Enter the password....." name="password" required>

 <input type="submit" id='submit' value='LOGIN' >
 <input type="button" id='submit' value='BACK' onClick="window.location.href='TestProrataV2.php'">
 <?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 </form>
 </div>
 </body>
</html>