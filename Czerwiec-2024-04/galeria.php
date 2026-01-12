<?php $conn = mysqli_connect('localhost','root','','galeria');?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Zdjęcia</h1></header>
    <section class="left">
        <h2>Tematy zdjęć</h2>
        <ol>
            <li>Zwierzęta</li>
            <li>Krajobrazy</li>
            <li>Miasta</li>
            <li>Przyroda</li>
            <li>Samochody</li>
        </ol>
    </section>
    <section class="middle">
        <?php
            $sql = "SELECT zdjecia.plik, zdjecia.tytul, zdjecia.polubienia, autorzy.imie, autorzy.nazwisko FROM zdjecia JOIN autorzy on zdjecia.autorzy_id=autorzy.id ORDER BY `autorzy`.`nazwisko` ASC;";
            $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)) {
                    echo "<div>";
                        echo "<img src='$row[0]' alt='zdjęcie'>";
                        echo "<h3>$row[1]</h3>";

                        if($row[2] > 40) {
                            echo "<p>Autor: $row[3] $row[4].<br>Wiele osób polubiło ten obraz</p>";
                        }
                        else {
                            echo "<p>Autor: $row[3] $row[4].</p>";
                        }

                        echo "<a href='$row[0]' download='$row[0]'>Pobierz</a>";

                    echo "</div>";
                }
        ?>
    </section>
    <section class="right">
        <h2>Najbardziej lubiane</h2>
        <?php
        $sql = "SELECT zdjecia.tytul, zdjecia.plik FROM zdjecia WHERE zdjecia.polubienia >= 100;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<img src='$row[plik]' alt='$row[tytul]'>";
        }
        ?>
        <strong>Zobacz wszystkie nasze zdjęcia</strong>
    </section>
    <footer><h5>Strone wykonał: Lukaszeku</h5></footer>
</body>
</html>
<?php mysqli_close($conn) ?>