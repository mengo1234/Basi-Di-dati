<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gioca</title>
</head>

<body>
  <?php
  // Verifica se è presente il parametro "tipologia" nella query string
  if (isset($_GET['tipologia'])) {
    // Recupera il valore del parametro "tipologia"
    $tipologia = $_GET['tipologia'];

    // Connessione al database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sondaggi24";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connessione al database fallita: " . $conn->connect_error);
    }

    // Query per recuperare i dati in base alla tipologia
    $query = "SELECT * FROM Sondaggio WHERE dominio = '$tipologia'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      // Recupera la riga dei dati
      $row = $result->fetch_assoc();
      
      // Recupera i valori dei campi dal database
      $domanda = $row['domanda'];
      $foto = $row['foto'];
      $opzione1 = $row['opzione1'];
      $opzione2 = $row['opzione2'];
      $opzione3 = $row['opzione3'];

      // Genera il form con i dati recuperati
      echo '<h1>Gioca</h1>';
      echo '<form action="risposta.php" method="post">';
      echo '<label for="domanda">Domanda:</label>';
      echo '<p id="domanda">' . $domanda . '</p>';
      echo '<br>';
      echo '<label for="foto">Foto:</label>';
      echo '<img src="' . $foto . '" alt="Foto domanda">';
      echo '<br>';
      echo '<input type="radio" id="opzione1" name="risposta" value="opzione1">';
      echo '<label for="opzione1">' . $opzione1 . '</label>';
      echo '<br>';
      echo '<input type="radio" id="opzione2" name="risposta" value="opzione2">';
      echo '<label for="opzione2">' . $opzione2 . '</label>';
      echo '<br>';
      echo '<input type="radio" id="opzione3" name="risposta" value="opzione3">';
      echo '<label for="opzione3">' . $opzione3 . '</label>';
      echo '<br>';
      echo '<input type="submit" value="Invia Risposta">';
      echo '</form>';
    } else {
      echo '<p>Nessun dato trovato per la tipologia specificata.</p>';
    }

    $conn->close();
  } else {
    echo '<p>Parametro "tipologia" non fornito.</p>';
  }
  ?>
</body>

</html>
