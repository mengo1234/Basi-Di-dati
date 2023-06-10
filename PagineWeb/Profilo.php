<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="C:\Users\Administrator\Desktop\Basi-Di-dati\CSSPagineWeb\Profilo.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Profilo</title>
    <?php

    $mysqli=new mysqli("localhost","root","", "sondaggi23");
    $query= "SELECT * FROM utente";
    $res= $mysqli->query($query) or die (mysqli_error($con));
    $result= $mysqli->query($query) or die (mysqli_error($con));
    while ($rowS= mysqli_fetch_array($result)){

        $mail=$rowS["email"];
        $nome=$rowS["nome"];
        $cognome=$rowS["cognome"];
        $anno=$rowS["anno"];
        $luogoNascita=$rowS["luogoNascita"];
        $totaleBonus=$rowS["totaleBonus"];
    }
    ?>


</head>




   <!-- freccia di ritorno -->
   <a href="C:\Users\Administrator\Desktop\Basi-Di-dati\Home.html" class="back-button">
   <i class="fas fa-arrow-left"></i> </a>

  <!-- Intestazione della pagina -->
  <h1>Profilo</h1>

</p>
  <!-- Bottone "Dati Personali" -->
  <button onclick="showDatiPersonali()">Dati Personali</button>

  <!-- Bottone "Invita a Sondaggio" -->
  <button onclick="showInvitaSondaggio()">Invita a Sondaggio</button>

  <!-- Tabella Dati Personali (inizialmente nascosta) -->
<div id="datiPersonaliTable">
    <h2>Dati Personali</h2>
    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "sondaggi23");

        // Recupera l'email dell'utente corrente (puoi passare questa variabile come parametro alla pagina)
        $email = $_GET['email'];

        // Esegue una query per recuperare i dati dell'utente
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        // Mostra i dati dell'utente
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['cognome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }

        // Chiude la connessione al database
        mysqli_close($conn);
        ?>
        </tbody>
    </table>
</div>

<script>
    // Nasconde tutte le righe della tabella tranne quella con l'email dell'utente corrente
    var email = "<?php echo $email ?>";
    var rows = document.querySelectorAll("#datiPersonaliTable tbody tr");
    rows.forEach(function(row) {
        row.style.display = "none";
        if (row.querySelector("td:last-child").textContent == email) {
            row.style.display = "table-row";
        }
    });
</script>

  <!-- Tabella Invita a Sondaggio (inizialmente nascosta) -->



  <div id="invitaSondaggioTable" style="display: none;">
    <h2>Invita a Sondaggio</h2>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> <?php
              $inc=0;
              while ($row= mysqli_fetch_array($res)) {
                  echo "mail:".($inc+1)."<br><a href='#' onclick=\"document.getElementById('email".$inc."').submit(); return false;\">".$row["email"]."</a><form id='email".$inc."' method='post' action='salva_click.php'><input type='hidden' name='email' value='".$row["email"]."'></form><br>";
                  $inc++;
              }
              ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Script JavaScript per mostrare/nascondere le tabelle -->
  <script>
    function showDatiPersonali() {
      document.getElementById("datiPersonaliTable").style.display = "block";
      document.getElementById("invitaSondaggioTable").style.display = "none";
    }

    function showInvitaSondaggio() {
      document.getElementById("datiPersonaliTable").style.display = "none";
      document.getElementById("invitaSondaggioTable").style.display = "block";
    }
  </script>

</body>

</html>
