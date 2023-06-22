<?php
// Connessione al database
$conn = new mysqli("localhost", "username", "password", "sondaggi24");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se il form è stato sottoposto tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Acquisizione dei valori forniti dall'utente tramite il metodo POST
    $codFiscale = $_POST['codFiscale'];
    $sede = $_POST['sede'];

    // Creazione dello statement
    $stmt = $conn->prepare("CALL InserisciAzienda(?, ?)");

    // Bind dei parametri
    $stmt->bind_param("ss", $codFiscale, $sede);

    // Esecuzione dello statement
    $stmt->execute();

    // Recupero dell'ID generato per il nuovo record
    $idAzienda = $stmt->insert_id;

    // Chiusura dello statement
    $stmt->close();

    // Visualizza l'ID dell'azienda appena inserita
    echo "Nuova azienda inserita con ID: " . $idAzienda;
}

// Chiusura della connessione
$conn->close();
?>
