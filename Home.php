<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Home.css">
    <title>Applicativo Web</title>
</head>
<body>

    <!-- Titolo e contenitore della tabella -->
    <h1>WALL OF FAME</h1>
    <div id="table-container">

        <?php
                /* Connessione al database e esecuzione della query */
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Sondaggi23";

            $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connessione al database fallita: " . $conn->connect_error);
                }

                    /* Creazione della vista ordinata in base al totBonus decrescente */
            $query = "CREATE OR REPLACE VIEW VistaUtente AS SELECT * FROM Utente ORDER BY totaleBonus DESC";
            $result = $conn->query($query);
        ?>

        <?php

            echo '<h1>Benvenuto!</h1>';

            echo '
                <!-- Menù di selezione -->
                <div id="menu">
                    <select onchange="navigate()">
                        <option value="default" selected>Seleziona</option>
                        <option value="login-register">Accedi/Registrati</option>
                        <option value="profile">Profilo</option>
                        <option value="quiz">Partecipa a un QUIZ</option>
                        <option value="Crea Sondaggio">Crea un Quiz</option>
                    </select>
                </div>';

        ?>

        <table>
            <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Luogo di Nascita</th>
                <th>Totale Punti</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /* Generazione delle righe della tabella con i dati ottenuti dalla query */
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["cognome"] . "</td>";
                    echo "<td>" . $row["luogoNascita"] . "</td>";
                    echo "<td>" . $row["totaleBonus"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nessun dato presente nel database</td></tr>";
            }

            $conn->close();
            ?>
            </tbody>
        </table>
    </div>

    <script>
        function navigate() {
            var select = document.getElementById("menu").getElementsByTagName("select")[0];
            var selectedOption = select.options[select.selectedIndex].value;

            // Effettua la navigazione in base all'opzione selezionata
            switch (selectedOption) {
                case "login-register":
                    // Effettua il redirect alla pagina di accesso/registrazione
                    window.location.href = "PagineWeb/AccediRegistrati.php";
                    break;
                case "profile":
                    // Effettua il redirect alla pagina del profilo utente
                    window.location.href = "PagineWeb/Profilo.php";
                    break;
                case "quiz":
                    // Effettua il redirect alla pagina per partecipare a un quiz
                    window.location.href = "PagineWeb/PartecipaSondaggio.php";
                    break;
                case "Crea Sondaggio":
                    // Effettua il redirect alla pagina per creare un quiz
                    window.location.href = "PagineWeb/CreaSondaggio.php";
                    break;
            }
        }
    </script>


</body>
</html>
