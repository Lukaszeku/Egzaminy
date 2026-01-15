<?php
$conn = new mysqli(hostname:'localhost',username:'root',password:'',database:'bazar')
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>Zdrowy bazarek</title>
</head>
<body>
    <header><h1>Zdrowy bazarek</h1></header>
    <nav>
        <?php
        $sql = "SELECT towar.nazwa, towar.plik FROM towar LIMIT 10;";
        $result = $conn -> query(query: $sql);
        while($row = $result -> fetch_assoc()) {
            echo "<img src='$row[plik]' alt='$row[nazwa]'>";
        }
        ?>
    </nav>
    <main>
        <aside>
            <img src="market.png" alt="bazarek">
        </aside>
        <section>
            <p>Wybierz owoc lub warzywo i podaj jego wage</p>
            <form action="index.php" method="post">
                <select name="list" id="">
                    <?php
                    $sql = "SELECT towar.id, towar.nazwa FROM towar;";
                    $result = $conn -> query(query: $sql);
                    while($row = $result -> fetch_assoc()) {
                        echo "<option value='$row[id]'>$row[nazwa]</option>";
                    }
                    ?>
                </select>
                <input type="number" name="waga" id="">
                <input type="submit" name="zamowienie" value="Zamów">
            </form>
            <?php
            if(isset($_POST['zamowienie'])) {
                $id_towaru = $_POST['list'];
                $waga = $_POST['waga'];
                $sql = "SELECT towar.rodzaj, towar.nazwa, towar.cena FROM towar WHERE towar.id = $id_towaru;";
                $result = $conn -> query(query: $sql);
                while($row = $result -> fetch_assoc()) {
                    $wartosc = $waga * $row['cena'];
                    echo "$row[rodzaj] $row[nazwa] wartość: $wartosc";
                }

                $sql2 = "INSERT INTO zamowienie(id_towar, id_sklep, liczba_kg) VALUES ($id_towaru,2,$waga);";
                $conn -> query(query: $sql2);
            }

            ?>
        </section>
    </main>
    <footer><p>Strone opracował: </p></footer>
</body>
</html>
<?php
$conn -> close()
?>