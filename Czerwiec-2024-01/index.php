<?php
$conn = mysqli_connect('localhost', 'root', '', 'motory')

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Motocykle</title>
</head>
<body>
    <img src="motor.png" alt="motocykl" class="motor">
    <header>
        <h1>Motocykle - moja pasja</h1>
    </header>
    <article>
        <h2>Gdzie pojechać?</h2>
        <?php
        $sql = "SELECT wycieczki.nazwa, wycieczki.poczatek, wycieczki.opis, zdjecia.zrodlo FROM wycieczki JOIN zdjecia on wycieczki.zdjecia_id=zdjecia.id;";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            echo "<dl>
                    <dt>$row[nazwa], rozpoczyna się w $row[poczatek], <a href='$row[zrodlo].jpg'>zobacz zdjecie</a></dt>
                    <dd>$row[opis]</dd>
                 </dl>";
        }
        ?>
    </article>
    <aside>
        <h2>Co kupić?</h2>
        <ol>
            <li>Honda CBR125R</li>
            <li>Yamaha YBR125</li>
            <li>Honda VFR800i</li>
            <li>Honda CBR1100XX</li>
            <li>BMW R1200GS LC</li>
        </ol>
    </aside>
    <aside>
        <h2>Statystyki</h2>
        <p>Wpisanych wycieczek: 
            <?php
            $sql = "SELECT count(id) AS ilosc_wycieczek FROM `wycieczki`";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "$row[ilosc_wycieczek]";
            }
            ?>
        </p>
        <p>UŻytkowników forum: 200</p>
        <p>Przesłanych zdjęć: 1300</p>
    </aside>
    <footer><p>Strone wykonał: 12312312312</p></footer>
</body>
</html>