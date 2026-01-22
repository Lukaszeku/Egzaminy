<?php $conn = new mysqli(hostname:'localhost', username:'root', password:'', database:'zgloszenia')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZGŁOSZENIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><h1>Zgłoszenia wydarzeń</h1></header>
    <main>
        <section class="left">
            <h2>Personel</h2>
            <form action="" method="post">
                <input type="radio" name="inputRadio" value="policjant" id="" checked>Policjant
                <input type="radio" name="inputRadio" value="ratownik"  id="">Ratownik
                <button type="submit" name="show">Pokaż</button>
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                </tr>
                    <?php
                        if(isset($_POST['inputRadio'])) {
                            $checked = $_POST['inputRadio'];
                        } else {
                            $checked = 'policjant';
                        }
                        $sql = "SELECT personel.id, personel.imie, personel.nazwisko FROM personel WHERE personel.status = '$checked';";
                        $result = $conn -> query(query: $sql);
                        echo "<h3>Wybrano opcje $checked</h3>";
                        while($row = $result -> fetch_assoc()) {
                            echo "<tr><td>$row[id]</td><td>$row[imie]</td><td>$row[nazwisko]</td></tr>";
                        }
                    ?>
            </table>
        </section>
        <section class="right">
            <h2>Nowe Zgłoszenie</h2>
            <ol>
                <?php
                $sql = "SELECT personel.id, personel.nazwisko FROM personel LEFT JOIN rejestr on personel.id=rejestr.id_personel WHERE rejestr.id_personel is null;";
                $result = $conn -> query(query: $sql);
                while($row = $result -> fetch_assoc()) {
                    echo "<li>$row[id] $row[nazwisko]</li>";
                }
                ?>
            </ol>
            <form action="" method="post">
                <label for="">Wybierz id z listy
                    <input type="number" name="inputNumber">
                </label>
                <button type="submit" name="add">Dodaj zgłoszenie</button>
            </form>
            <?php
            if(isset($_POST['add'])) {
                $number = $_POST['inputNumber'];
                $sql = "INSERT INTO rejestr (data, id_personel, id_pojazd) VALUES (CURRENT_DATE(), $number, 14);";
                $conn -> query(query: $sql);
            }
            ?>
        </section>
    </main>
    <footer><p>Strone wynonał: Lukaszeku</p></footer>
</body>
</html>