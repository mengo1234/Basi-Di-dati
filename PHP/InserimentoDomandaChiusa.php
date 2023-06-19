<?php
// Connessione al database
$conn = new mysqli("localhost", "root", "", "Sondaggi24");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
// Verifica se il form è stato sottoposto tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Acquisizione dei valori forniti dall'utente tramite il metodo POST
    $dominio = $_POST["dominio"];
    $codice = $_POST["codice"];
    $testo = $_POST['testo'];
    $punteggio = $_POST['punteggio'];
    $foto = $_POST['foto'];
    $testo_opzione1 = $_POST['testo_opzione1'];
    $testo_opzione2 = $_POST['testo_opzione3'];
    $testo_opzione3 = $_POST['testo_opzione3'];

    // Preparazione dello statement
    $stmt = $conn->prepare("CALL CreazioneDomandaChiusa(?, ?, ?, ?, ?, ?, ?, ?)");

    // Verifica della preparazione dello statement
    if (!$stmt) {
        echo "Errore durante la preparazione dello statement: " . $conn->error;
        exit;
    }

    // Bind dei parametri
    $stmt->bind_param("sisissss", $dominio, $codice, $testo, $punteggio, $foto, $testo_opzione1, $testo_opzione2, $testo_opzione3);

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
