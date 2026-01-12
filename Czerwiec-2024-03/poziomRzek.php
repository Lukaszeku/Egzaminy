<?php
    $conn = mysqli_connect('localhost','root','','rzeki')
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poziomy rzek</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="obraz1.png" alt="Mapa Polski">
    </header>
    <header>
        <h1>Rzeki w województwie dolnosląskim</h1>
    </header>
    <menu>
        <form action="poziomRzek.php" method="post">
            <label for="Wszystkie"><input type="radio" name="stan" value="wszystkie">Wszystkie</label>
            <label for="Ponad stan ostrzegawczy"><input type="radio" name="stan" value="ostrzegawczy">Ponad stan ostrzegawczy</label>
            <label for="Ponad stan alarmowy"><input type="radio" name="stan" value="alarmowy">Ponad stan alarmowy</label>
            <input type="submit" name="wyslij" value="Pokaż">
        </form>
    </menu>
    <section class="left">
        <h3>Stany na dzień 2022-05-05</h3>
        <table>
            <tr>
                <th>Wodomierz</th>
                <th>Rzeka</th>
                <th>Ostrzegawczy</th>
                <th>Alarmowy</th>
                <th>Aktualny</th>
            </tr>
                <?php
                    if(isset($_POST['stan'])) {
                        $stan = $_POST['stan'];
                        if ($stan == "wszystkie") {
                            $sql = "SELECT wodowskazy.nazwa, wodowskazy.rzeka, wodowskazy.stanOstrzegawczy, wodowskazy.stanAlarmowy, pomiary.stanWody FROM wodowskazy JOIN pomiary on wodowskazy.id=pomiary.wodowskazy_id WHERE pomiary.dataPomiaru = '2022-05-05'";
                        } elseif ($stan == "ostrzegawczy") {
                            $sql = "SELECT wodowskazy.nazwa, wodowskazy.rzeka, wodowskazy.stanOstrzegawczy, wodowskazy.stanAlarmowy, pomiary.stanWody FROM wodowskazy JOIN pomiary on wodowskazy.id=pomiary.wodowskazy_id WHERE pomiary.dataPomiaru = '2022-05-05' AND pomiary.stanWody > wodowskazy.stanOstrzegawczy;";
                        } elseif ($stan == "alarmowy") {
                            $sql = "SELECT wodowskazy.nazwa, wodowskazy.rzeka, wodowskazy.stanOstrzegawczy, wodowskazy.stanAlarmowy, pomiary.stanWody FROM wodowskazy JOIN pomiary on wodowskazy.id=pomiary.wodowskazy_id WHERE pomiary.dataPomiaru = '2022-05-05' AND pomiary.stanWody > wodowskazy.stanAlarmowy;";
                        }
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>$row[nazwa]</td><td>$row[rzeka]</td><td>$row[stanOstrzegawczy]</td><td>$row[stanAlarmowy]</td><td>$row[stanWody]</td></tr>";
                        }
                    }
                ?>
        </table>
    </section>
    <section class="right">
        <h3>Informacje</h3>
        <ul>
            <li>Brak ostrzeżeń o burzach z gradem</li>
            <li>Smog w mieście Wrocław</li>
            <li>Silny wiatr w Karkonoszach</li>
        </ul>
        <h3>Średnie stany wód</h3>
        <?php
            $sql = "SELECT pomiary.dataPomiaru, AVG(pomiary.stanWody) AS srednia_stanuWody FROM pomiary GROUP BY pomiary.dataPomiaru;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "$row[dataPomiaru], $row[srednia_stanuWody]<br>";
            }
        ?>
        <a href="https://komunikaty.pl">Dowiedz się więcej</a>
        <img src="obraz2.jpg" alt="rzeka">
    </section>
    <footer>
        <p>Strone wykonał: Lukaszeku</p>
    </footer>
    
</body>
</html>