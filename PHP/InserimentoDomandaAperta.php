<?php

// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Sondaggi23";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se il form è stato sottoposto tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Valori forniti dall'utente
    $id = $_POST["id"];
    $testo = $_POST["testo"];
    $punteggio = $_POST["punteggio"];
    $foto = $_POST["foto"];
    $risposta = $_POST["risposta"];

    // Preparazione della query per chiamare la stored procedure
    $query = "CALL CreazioneDomandaAperta(?, ?, ?, ?, ?)";

    // Preparazione dello statement
    $stmt = $conn->prepare($query);

    // Bind dei parametri
    $stmt->bind_param("isiss", $id, $testo, $punteggio, $foto, $risposta); /*i ed s sono gli specificatori dei parametri e si riferiscono alle tipologie di parametro in input che seguono se intero o stringa*/ 

    // Esecuzione dello statement
    $stmt->execute();

    // Recupero dell'ID della domanda appena creata
    $stmt->bind_result($new_domandaID);
    $stmt->fetch();

    echo "Domanda creata con successo. ID della domanda: " . $new_domandaID;

    // Chiusura dello statement
    $stmt->close();
}

// Chiusura della connessione
$conn->close();

?>
