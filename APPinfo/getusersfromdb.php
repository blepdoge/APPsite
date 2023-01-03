<?php
    // Connexion a notre bdd
    $db = new mysqli('localhost', 'root', '', 'mydb');

    // check si il y a un erreur de co
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    //si qqc est passé en param get, on l'affecte a une variable, sinon, display tout
    if (isset($_GET['userSearchBar']) && !empty($_GET['userSearchBar'])) {
      // Sanitize les inputs pour eviter une injection sql
      $search = $db->real_escape_string($_GET['userSearchBar']);

      // Generer la requete SQL en cherchant par nom ou prenom
      $searchquery = "SELECT prenom, nom, email, adminPerm FROM users WHERE nom = '" . $search . "'OR prenom = '" . $search . "' ";
    } else {
      // si rien de renvoyé alors on affiche tout
      $searchquery = "SELECT * FROM users ORDER BY nom asc";
    }

    // faire la requete sql en fonction de la query plus haut
    $resultSearch = $db->query($searchquery);

    // recheck pour des erreurs encore
    if (!$resultSearch) {
      die("Query failed: " . $db->error);
    }

    if($resultSearch->num_rows==0){
      echo '<img src="assets/images/empty.png" width="128" height="128" style="margin-top:50px">
      <h2 style="margin-top:80px">Pas de résultat correspondant, essayez autre chose...<h2>';
    }else{
    // on loop a travers tous les rangées renvoyées par sql et on fait des divs a chaque fois, avec le nom de la box
    while ($user = $resultSearch->fetch_assoc()) {
      

      if ($user["adminPerm"] == 1) {
        $adminPermission = "Administrateur";
      } else {
        $adminPermission = "Utilisateur";
      }
      echo '<table>
      <tr class="conteneurline">
        <td width="60"><img src="assets/images/personne.png" alt="Logo personne" width="30" height="30" /></td>
        <td width="200"><p>' . $user["prenom"] . '</p></td>
        <td width="200"><p>' . $user["nom"] . '</p></td>
        <td width="60" class="seperate"><p>I</p></td>
        <td width="400"><p>' . $user["email"] . '</p></td>
        <td width="200"><p>' . $adminPermission . '</p></td>
        <td width="60"><img class="disablednotadmin" src="assets/images/parametre.png" alt= "Logo param" width="30" height="30" /></td>
        <td width="30"><img class="disablednotadmin" src="assets/images/supprimer.png" alt= "Logo delete" width="30" height="30" /></td>
      </tr>
    </table>';
    }}

    // Fermeture de la bdd
    $db->close();

    ?>