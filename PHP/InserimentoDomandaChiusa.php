<?php
// Connessione al database
$conn = new mysqli("localhost", "root", "", "Sondaggi23");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
// Verifica se il form è stato sottoposto tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Acquisizione dei valori forniti dall'utente tramite il metodo POST
    $id = $_POST['id'];
    $testo = $_POST['testo'];
    $punteggio = $_POST['punteggio'];
    $foto = $_POST['foto'];
    $testo_opzione = $_POST['testo_opzione'];

    // Preparazione dello statement
    $stmt = $conn->prepare("CALL CreazioneDomandaChiusa(?, ?, ?, ?, ?)");

    // Verifica della preparazione dello statement
    if (!$stmt) {
        echo "Errore durante la preparazione dello statement: " . $conn->error;
        exit;
    }

    // Bind dei parametri
    $stmt->bind_param("issis", $id, $testo, $punteggio, $foto, $testo_opzione);

        // Esecuzione dello statement
        if ($stmt->execute()) {
            // Recupero dell'ID della domanda appena creata
            $stmt->bind_result($new_domanda_id);
            $stmt->fetch();

            echo "Domanda creata con successo. ID: " . $new_domanda_id;
        } else {
            echo "Errore durante l'esecuzione dello statement: " . $stmt->error;
        }

    $stmt->close();
}
$conn->close();
?>
