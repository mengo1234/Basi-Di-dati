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
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $anno = $_POST['anno'];
    $luogoNascita = $_POST['luogoNascita'];
    $ruolo = $_POST['ruolo'];
    $costo = $_POST['costo'];
    $numSondaggi = $_POST['numSondaggi'];
    $dataInizioAbbonamento = $_POST['dataInizioAbbonamento'];
    $dataFineAbbonamento = $_POST['dataFineAbbonamento'];

    // Preparazione dello statement
    $stmt = $conn->prepare("CALL InserisciUtente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind dei parametri
    $stmt->bind_param("sssisssiss", $email, $nome, $cognome, $anno, $luogoNascita, $ruolo, $costo, $numSondaggi, $dataInizioAbbonamento, $dataFineAbbonamento);
    /*i ed s sono gli specificatori dei parametri e si riferiscono alle tipologie di parametro in input che seguono se intero o stringa*/ 

        // Esecuzione dello statement
        if ($stmt->execute()) {
            // Recupero dell'ID dell'utente appena creato
            $stmt->bind_result($new_userID);
            $stmt->fetch();

            echo "Utente inserito con successo. ID dell'utente: " . $new_userID;
        } else {
            echo "Errore durante l'inserimento dell'utente: " . $stmt->error;
        }

    // Chiusura dello statement
    $stmt->close();
}
// Chiusura della connessione
$conn->close();
?>
