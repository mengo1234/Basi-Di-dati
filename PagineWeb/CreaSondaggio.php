<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="C:\Users\Administrator\Desktop\Basi-Di-dati\CSSPagineWeb\CreaSondaggio.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Crea Sondaggio</title>
</head>

<body>
    <!-- verifica se l'utente ha fatto il log in se no reindirizzamento a pagina di lo-->
    <?php
    session_start();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // L'utente non è autenticato, mostra l'alert e reindirizza alla pagina desiderata
        echo '<script>alert("Devi effettuare l\'accesso per visualizzare questa pagina."); window.location.href = "PagineWeb/login.php";</script>';
        exit();
    }?>

   <!-- freccia di ritorno -->
  <a href="C:\Users\Administrator\Desktop\Basi-Di-dati\Home.php" class="back-button">
    <i class="fas fa-arrow-left"></i>
  </a>
  
  <!-- Intestazione della pagina -->
  <h1>Crea Sondaggio</h1>

  <!-- Bottoni per le domande -->
  <button onclick="showDomandaApertaForm()">Domanda Aperta</button>
  <button onclick="showDomandaChiusaForm()">Domanda Chiusa</button>

  <!-- Form per la domanda aperta (inizialmente nascosto) -->
  <div id="domandaApertaForm" style="display: none;" >
    <h2>Domanda Aperta</h2>
    <form method="POST" action="../PHP/InserimentoDomandaAperta.php">
        <!-- Menù di selezione -->
      <label for="tipoSondaggio">Tipologia Sondaggio:</label>
      <select id="tipoSondaggio">
        <option value="opzione1">Parola chiave 1 + Codice 1</option>
        <option value="opzione2">Parola chiave 2 + Codice 2</option>
        <option value="opzione3">Parola chiave 3 + Codice 3</option>
      </select>
      <label for="testo">Testo:</label>
      <input type="text" id="testo" name="testo">
      <br>
      <label for="punteggio">Punteggio:</label>
      <input type="text" id="punteggio" name="punteggio">
      <br>
      <label for="file">Carica un file:</label>
      <input type="file" id="file" name="file">
      <br>
      <input type="submit" value="Aggiungi Domanda">
      <br>      
    </form>
  </div>

  <!-- Form per la domanda chiusa (inizialmente nascosto) -->
  <div id="domandaChiusaForm" style="display: none;">
    <h2>Domanda Chiusa</h2>
    <form method="POST" action="../PHP/InserimentoDomandaChiusa.php">
        <!-- Menù di selezione -->
    <label for="tipoSondaggio">Tipologia Sondaggio:</label>
    <select id="tipoSondaggio">
      <option value="opzione1">Parola chiave 1 + Codice 1</option>
      <option value="opzione2">Parola chiave 2 + Codice 2</option>
      <option value="opzione3">Parola chiave 3 + Codice 3</option>
    </select>
      <label for="testo">Testo:</label>
      <input type="text" id="testo" name="testo">
      <br>
      <label for="punteggio">Punteggio:</label>
      <input type="text" id="punteggio" name="punteggio">
      <br>
      <label for="opzioneA">Opzione A:</label>
      <input type="text" id="opzioneA" name="testo_opzione1">
      <br>
      <label for="opzioneB">Opzione B:</label>
      <input type="text" id="opzioneB" name="testo_opzione2">
      <br>
      <label for="opzioneC">Opzione C:</label>
      <input type="text" id="opzioneC" name="testo_opzione3">
      <br>
      <input type="submit" value="Aggiungi Domanda">
      <br>
    </form>
  </div>

  <!-- Script JavaScript per mostrare/nascondere i form -->
  <script>
    function showDomandaApertaForm() {
      document.getElementById("domandaApertaForm").style.display = "block";
      document.getElementById("domandaChiusaForm").style.display = "none";
    }

    function showDomandaChiusaForm() {
      document.getElementById("domandaApertaForm").style.display = "none";
      document.getElementById("domandaChiusaForm").style.display = "block";
    }
  </script>
</body>

</html>
