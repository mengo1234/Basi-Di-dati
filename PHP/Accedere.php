<?php
// Connessione al database
session_start();
$conn = new mysqli("localhost", "root", "", "Sondaggi24");

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se il form è stato sottoposto tramite il metodo POST

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $email = $_POST['email'];
       $password = $_POST['password'];


// Query per verificare le credenziali nel database
$sql = "SELECT * FROM Utente WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Credenziali corrette, reindirizzo alla pagina successiva
    $_SESSION['email'] = $email;
    $_SESSION['logged_in'] = true;
    header("Location: ../PagineWeb/Profilo.php");
    exit();
} else {
    // Credenziali errate, reindirizzo alla pagina di login
    echo 'login non riuscito!';
    header("Location: ../PagineWeb/AccediRegistrati.php");
   }

}
$conn->close();

?>