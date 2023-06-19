<?php
// includere il file di connessione al database
$conn = new mysqli("localhost", "root", "", "Sondaggi24");

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // L'utente non è autenticato, mostra l'alert e reindirizza alla pagina desiderata
  echo '<script>alert("Devi effettuare l\'accesso per visualizzare questa pagina."); window.location.href = "AccediRegistrati.php";</script>';
  exit();
} else {
  // Recuperare tutte le informazioni dell'utente dal database
  $email = $_SESSION['email'];
  // Query per recuperare tutte le informazioni dell'utente dalla tabella Utente dove l'email corrisponde all'email dell'utente loggato
  $query = "SELECT u.email, u.nome, u.cognome, COUNT(s.nome) AS num_premi_vinti, SUM(p.punti) AS punti_totali
                                                                FROM Utente u
                                                                LEFT JOIN Storico s ON u.email = s.email
                                                                LEFT JOIN Premio p ON s.nome = p.nome
                                                                WHERE u.email = '$email'";
  $result = mysqli_query($conn, $query);
  // Verifica del risultato della query
  if ($result && mysqli_num_rows($result) > 0) {
    // Estrazione dei dati dal risultato della query
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $cognome = $row['cognome'];
    $email = $row['email'];
    $num_premi_vinti = $row['num_premi_vinti'];
    $punti_totali = $row['punti_totali'];
   }
  }

  // Recupera l'elenco degli utenti registrati dal database
  $sql_users = "SELECT * FROM Utente WHERE email != '$email'";
  $result_users = mysqli_query($conn, $sql_users);

 /* if (mysqli_num_rows($result_users) > 0) {

    // Genera una riga della tabella per ogni utente
    while ($row_users = mysqli_fetch_assoc($result_users)) {
      echo '<tr>';
      echo '<td>' . $row_users['nome'] . '</td>';
      echo '<td>' . $row_users['email'] . '</td>';
      echo '<td>';
      echo '<select name="survey">';

      // Recupera l'elenco dei sondaggi dal database
      $sql_surveys = "SELECT * FROM Sondaggio";
      $result_surveys = mysqli_query($conn, $sql_surveys);

      if (mysqli_num_rows($result_surveys) > 0) {
        // Genera un'opzione nel menu a discesa per ogni sondaggio disponibile
        while ($row_surveys = mysqli_fetch_assoc($result_surveys)) {
          echo '<option value="' . $row_surveys['id'] . '">' . $row_surveys['nome'] . '</option>';
        }
      }

      echo '</select>';
      echo '</td>';
      echo '<td>';
      echo '<form action="invita.php" method="post">';
      echo '<input type="hidden" name="user_id" value="' . $row_users['id'] . '">';
      echo '<input type="submit" value="Invita">';
      echo '</form>';
      echo '</td>';
      echo '</tr>';
    }
  }
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="C:\xampp\htdocs\Basi-Di-dati-Ramo170623\Basi-Di-dati-Ramo170623\CSSPagineWeb\Profilo.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Profilo</title>
</head>

<body>
  <!-- freccia di ritorno -->
  <a href="C:\Users\Administrator\Desktop\Basi-Di-dati\Home.php" class="back-button">
    <i class="fas fa-arrow-left"></i>
  </a>

  <!-- Intestazione della pagina -->
<header>
  <h1>Profilo <a href="PartecipaSondaggio.php" class="sondaggi-link">Sondaggi</a></h1>
</header>

  <!-- Bottone "Dati Personali" -->
  <button onclick="showDatiPersonali()">Dati Personali</button>

  <!-- Bottone "Invita a Sondaggio" -->
  <button onclick="showInvitaSondaggio()">Invita a Sondaggio</button>

  <!-- Bottone "Premi" -->
  <button onclick="showPremi()">Premi Ottenuti</button>

  <!-- Tabella Dati Personali (inizialmente nascosta) -->
  <div id="datiPersonaliTable" style="display: none;">
    <h2>Dati Personali</h2>
    <table>
      <tbody>
        <tr>
          <th>Nome</th>
          <td><?php echo $nome; ?></td>
        </tr>
        <tr>
          <th>Cognome</th>
          <td><?php echo $cognome; ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo $email; ?></td>
        </tr>
         <tr>
         <th>Premi vinti:</th>
         <td><?php echo $num_premi_vinti; ?></td>
         </tr>
         <tr>
          <th>Punti totali:</th>
          <td><?php echo $punti_totali; ?></td>
         </tr>
      </tbody>
    </table>
  </div>

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
      <?php
        if (mysqli_num_rows($result_users) > 0) {

            // Genera una riga della tabella per ogni utente
            while ($row_users = mysqli_fetch_assoc($result_users)) {
              echo '<tr>';
              echo '<td>' . $row_users['nome'] . '</td>';
              echo '<td>' . $row_users['email'] . '</td>';
              echo '<td>';
              echo '<select name="survey">';

              // Recupera l'elenco dei sondaggi dal database
              $sql_surveys = "SELECT * FROM Sondaggio";
              $result_surveys = mysqli_query($conn, $sql_surveys);

              if (mysqli_num_rows($result_surveys) > 0) {
                // Genera un'opzione nel menu a discesa per ogni sondaggio disponibile
                while ($row_surveys = mysqli_fetch_assoc($result_surveys)) {
                  echo '<option value="' . $row_surveys['id'] . '">' . $row_surveys['nome'] . '</option>';
                }
              }

              echo '</select>';
              echo '</td>';
              echo '<td>';
              echo '<form action="invita.php" method="post">';
              echo '<input type="hidden" name="user_id" value="' . $row_users['id'] . '">';
              echo '<input type="submit" value="Invita">';
              echo '</form>';
              echo '</td>';
              echo '</tr>';
            }
          }
          ?>
      </tbody>
    </table>
  </div>

  <!-- Tabella Premi Ottenuti (inizialmente nascosta) -->
<div id="premiOttenutiTable" style="display: none;">
  <h2>Premi Ottenuti</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Descrizione</th>
        <th>Foto</th>
        <th>Punti Necessari</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Premio 1</td>
        <td><img src="foto1.jpg" alt="Foto Premio 1"></td>
        <td>100</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Premio 2</td>
        <td><img src="foto2.jpg" alt="Foto Premio 2"></td>
        <td>200</td>
      </tr>
    </tbody>
  </table>
</div>

  <!-- Script JavaScript per mostrare/nascondere le tabelle -->
  <script>
    function showDatiPersonali() {
      document.getElementById("datiPersonaliTable").style.display = "block";
      document.getElementById("invitaSondaggioTable").style.display = "none";
      document.getElementById("premiOttenutiTable").style.display = "none";
    }

    function showInvitaSondaggio() {
      document.getElementById("datiPersonaliTable").style.display = "none";
      document.getElementById("invitaSondaggioTable").style.display = "block";
      document.getElementById("premiOttenutiTable").style.display = "none";
    }

    function showPremi() {
    document.getElementById("datiPersonaliTable").style.display = "none";
    document.getElementById("invitaSondaggioTable").style.display = "none";
    document.getElementById("premiOttenutiTable").style.display = "block";
  }
  </script>
</body>

</html>
