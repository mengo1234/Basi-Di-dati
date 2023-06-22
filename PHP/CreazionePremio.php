<?php
// Connessione al database
$conn = new mysqli("localhost", "username", "password", "sondaggi24");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Acquisizione dei valori forniti dall'utente tramite il metodo POST
    $nome = $_POST['nome'];
    $descrizione = $_POST['descrizione'];
    $foto = $_POST['foto'];
    $punti = $_POST['punti'];

    // Creazione dello statement
    $stmt = $conn->prepare("CALL InserisciPremio(?, ?, ?, ?)");

    // Bind dei parametri
    $stmt->bind_param("sssi", $nome, $descrizione, $foto, $punti);

        // Esecuzione dello statement
        if ($stmt->execute()) {
            // Recupero dell'ID del premio appena inserito
            $result = $conn->query("SELECT LAST_INSERT_ID() AS id");
            $row = $result->fetch_assoc();
            $idPremio = $row['id'];

            echo "Premio inserito con successo. ID del premio: " . $idPremio;
        } else {
            echo "Errore durante l'inserimento del premio: " . $stmt->error;
        }

    // Chiusura dello statement e della connessione
    $stmt->close();
}
$conn->close();
?>
