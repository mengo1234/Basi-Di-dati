<?php
// Recupera l'indirizzo email dal form
if(isset($_POST['email'])) {
    $email = $_POST['email'];

    // Esegui qui il codice per salvare l'informazione del click su questa email
    // Ad esempio, puoi aggiungere una riga al database o scrivere un file di log

    // Esempio: aggiungi una riga alla tabella 'clicks' nel database
    $conn = mysqli_connect("localhost", "root", "", "progetto23");
    $query = "INSERT INTO clicks (email) VALUES ('$email')";
    mysqli_query($conn, $query);
    mysqli_close($conn);
}
?>