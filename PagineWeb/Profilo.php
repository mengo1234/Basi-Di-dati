<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="C:\Users\Administrator\Desktop\Basi-Di-dati\CSSPagineWeb\Profilo.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Profilo</title>
</head>

<body>
    <!-- verifica se l'utente ha fatto il log in se no reindirizzamento a pagina di login-->
    <?php
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // L'utente non è autenticato, mostra l'alert e reindirizza alla pagina desiderata
        echo '<script>alert("Devi effettuare l\'accesso per visualizzare questa pagina."); window.location.href = "login.php";</script>';
        exit();
    }?>

   <!-- freccia di ritorno -->
   <a href="C:\Users\Administrator\Desktop\Basi-Di-dati\Home.php" class="back-button">
   <i class="fas fa-arrow-left"></i> </a>

  <!-- Intestazione della pagina -->
  <h1>Profilo</h1>

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
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cognome</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Mario</td>
          <td>Rossi</td>
          <td>mario@example.com</td>
        </tr>
        <tr>
          <td>Paola</td>
          <td>Verdi</td>
          <td>paola@example.com</td>
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
        <tr>
          <td>Giovanni</td>
          <td>giovanni@example.com</td>
        </tr>
        <tr>
          <td>Sara</td>
          <td>sara@example.com</td>
        </tr>
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