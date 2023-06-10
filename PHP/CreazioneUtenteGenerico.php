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
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $anno = $_POST['anno'];
    $luogoNascita = $_POST['luogoNascita'];

    // Creazione dello statement
    $stmt = $conn->prepare("CALL CreazioneUtente(?, ?, ?, ?, ?)");

    // Bind dei parametri
    $stmt->bind_param("sssis", $email, $nome, $cognome, $anno, $luogoNascita);

    // Esecuzione dello statement
    $stmt->execute();

    // Recupero dell'ID dell'Utente appena creato
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $newUserId = $row['new_user_id'];

    // Verifica se l'inserimento è avvenuto con successo
    if ($newUserId) {
        echo "Utente inserito con successo. ID: " . $newUserId;
    } else {
        echo "Errore durante l'inserimento dell'utente.";
    }

    // Chiusura dello statement
    $stmt->close();
}

// Chiusura della connessione
$conn->close();
?>
