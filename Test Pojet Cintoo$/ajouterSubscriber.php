
<link rel="stylesheet" type="text/css" href="formulaire.css">
<img class="logo" src="navlogo2.webp" alt="Logo de votre site" onClick="window.location.href='TestProrataV2.php'">
<form action="traitementAjoutSubscriber.php" method="post">
    <table>
    <th colspan="2" class="Title">Form to Add</th>
        <tr>
            <td><label for="name">Name :</label></td>
            <td><input type="text" name="name" id="name" required><br></td>
        </tr>
        <tr>
            <td><label for="start_date">Start Date :</label></td>
            <td><input type="date" name="start_date" id="start_date" required><br></td>
        </tr>
            <td><label for="end_date">End Date :</label></td>
            <td><input type="date" name="end_date" id="end_date" required><br></td>
        <tr>
        </tr>
            <td><label for="new_end_date">New End Date :</label></td>
            <td><input type="date" name="new_end_date" id="new_end_date" required><br></td>
        </tr>
        <tr>
            <td><label for="capacity">Capacity :</label></td>
            <td><input type="number" name="capacity" id="capacity"><br></td>
        </tr>
        <tr>
            <td><label for="capacity_uti">Capacity Used :</label></td>
            <td><input type="number" name="capacity_uti" id="capacity_uti"><br></td>
        </tr>
        <tr>
            <td><label for="unit_price">Price :</label></td>
            <td><input type="number" name="unit_price" id="unit_price" required><br></td>
        </tr>
        <tr>
            <td><label for="new_price">New Price:</label></td>
            <td><input type="number" name="new_price" id="new_price" required><br></td>
            </tr>
        <tr>
            <td><button type="submit" class="button" name="submit" value="Ajouter""><span>Add</span></button></td>
            <td><button type="button" class="button" value="Retour" onClick="window.location.href='TestProrataV2.php'"><span>Back</span></button></td>
        </tr>
        
           
</table>
</form>
