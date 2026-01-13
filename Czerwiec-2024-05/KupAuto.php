<?php
    $conn = new mysqli(hostname:"localhost", username:"root", password:"", database:"KupAuto");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komis aut</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header><h1><em>KupAuto!</em> Internetowy Komis Samochodowy</h1></header>
    <main class="first">
        <?php
        $sql = "SELECT samochody.model, samochody.rocznik, samochody.przebieg, samochody.paliwo, samochody.cena, samochody.zdjecie FROM samochody WHERE samochody.id = 10;";
        $result = $conn -> query(query: $sql);
        while($row = $result -> fetch_assoc()) {
            echo "<img src='$row[zdjecie]' alt='oferta dnia'>";
            echo "<h4>Oferta Dnia: Toyota $row[model]</h4>";
            echo "<p>Rocznik: $row[rocznik], przebieg: $row[przebieg], rodzaj paliwa: $row[paliwo]</p>";
            echo "<h4>Cena: $row[cena]</h4>";
        }
        ?>
    </main>
    <main class="second">
        <h2>Oferty Wyróżnione</h2>
        <?php
        $sql = "SELECT marki.nazwa, samochody.model, samochody.rocznik, samochody.cena, samochody.zdjecie FROM marki JOIN samochody on marki.id=samochody.marki_id WHERE samochody.wyrozniony = 1;";
        $result = $conn -> query(query: $sql);
        while($row = $result -> fetch_assoc()) {
            echo "<div>";
                echo "<img src='$row[zdjecie]' alt='$row[model]'>";
                echo "<h4>$row[nazwa] $row[model]</h4>";
                echo "<p>Rocznik: $row[rocznik]</p>";
                echo "<h4>Cena: $row[cena]</h4>";
            echo "</div>";
        }
        ?>
    </main>
    <main class="second">
        <h2>Wybierz markę</h2>
        <form action="KupAuto.php" method="post">
            <select name="listaRozwijana" id="">
                <?php
                $sql = "SELECT marki.nazwa FROM marki;";
                $result = $conn -> query(query: $sql);
                while($row = $result -> fetch_assoc()) {
                    echo "<option value='$row[nazwa]'>$row[nazwa]</option>";
                }
                ?>
            </select>
            <input type="submit" name="wyszukaj" value="Wyszukaj">
        </form>
        <?php
        if(isset($_POST['wyszukaj'])) {
            $marka = $_POST['listaRozwijana'];
            $sql = "SELECT samochody.model, samochody.cena, samochody.zdjecie FROM samochody JOIN marki on samochody.marki_id=marki.id WHERE marki.nazwa = '$marka';";
            $result = $conn -> query(query: $sql);
            while($row = $result -> fetch_assoc()) {
                echo "<div>";
                    echo "<img src='$row[zdjecie]' alt='$row[model]'>";
                    echo "<h4>$marka $row[model]</h4>";
                    echo "<h4>Cena: $row[cena]</h4>";
                echo "</div>";
            }
        }
        ?>
    </main>
    <footer>
        <p>Strone wykonał: Lukaszeku</p>
        <p><a href="http:/firmy.pl/komis">Znajdź nas także</a></p>
    </footer>
</body>
</html>
<?php
$conn -> close()
?>