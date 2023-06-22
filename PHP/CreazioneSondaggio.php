<?php
// Connessione al database
$conn = new mysqli("localhost", "username", "password", "Sondaggi24");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se il form è stato sottoposto tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Acquisizione dei valori forniti dall'utente tramite il metodo POST
    $parolaChiave = $_POST['parolaChiave'];
    $titolo = $_POST['titolo'];
    $descrizione = $_POST['descrizione'];
    $dataCreazione = $_POST['dataCreazione'];
    $dataChiusura = $_POST['dataChiusura'];
    $maxUtenti = $_POST['maxUtenti'];
    $stato = $_POST['stato'];

    // Creazione dello statement preparato
    $stmt = $conn->prepare("CALL CreazioneSondaggio(?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Preparazione dello statement fallita: " . $conn->error);
    }

    // Bind dei parametri dello statement
    $stmt->bind_param("sssssis", $parolaChiave, $titolo, $descrizione, $dataCreazione, $dataChiusura, $maxUtenti, $stato);

    // Esecuzione dello statement
    if ($stmt->execute()) {
        // Recupero dell'ID del sondaggio appena creato
        $stmt->store_result();
        $stmt->bind_result($id);
        $stmt->fetch();

        echo "Sondaggio creato con successo. ID del sondaggio: " . $id;
    } else {
        echo "Errore durante la creazione del sondaggio: " . $stmt->error;
    }

    // Chiusura dello statement
    $stmt->close();
}

// Chiusura della connessione
$conn->close();
?>
