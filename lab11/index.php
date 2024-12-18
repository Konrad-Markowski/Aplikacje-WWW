<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

// Klasa do zarządzania produktami
class Produkty {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->createTable();
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            tytul VARCHAR(255) NOT NULL,
            opis TEXT,
            data_utworzenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            data_modyfikacji TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            data_wygasniecia DATE,
            cena_netto DECIMAL(10,2),
            podatek DECIMAL(5,2),
            ilosc_magazyn INT,
            status_dostepnosci ENUM('dostepny', 'niedostepny') DEFAULT 'dostepny',
            zdjecie BLOB,
            gabaryt VARCHAR(100)
        )";

        if (!$this->conn->query($sql)) {
            die("Error creating table: " . $this->conn->error);
        }
    }

    public function DodajProdukt($tytul, $opis, $cena, $podatek, $ilosc, $status, $data_wygasniecia, $gabaryt) {
        $stmt = $this->conn->prepare("INSERT INTO products (tytul, opis, cena_netto, podatek, ilosc_magazyn, status_dostepnosci, data_wygasniecia, gabaryt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddisss", $tytul, $opis, $cena, $podatek, $ilosc, $status, $data_wygasniecia, $gabaryt);
        $stmt->execute();
        $stmt->close();
        echo "Produkt dodany pomyślnie!<br>";
    }

    public function UsunProdukt($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo "Produkt usunięty!<br>";
    }

    public function EdytujProdukt($id, $tytul, $opis, $cena, $ilosc) {
        $stmt = $this->conn->prepare("UPDATE products SET tytul=?, opis=?, cena_netto=?, ilosc_magazyn=? WHERE id=?");
        $stmt->bind_param("ssddi", $tytul, $opis, $cena, $ilosc, $id);
        $stmt->execute();
        $stmt->close();
        echo "Produkt zaktualizowany!<br>";
    }

    public function PokazProdukty() {
        $result = $this->conn->query("SELECT * FROM products");
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row['id'] . " - Tytuł: " . htmlspecialchars($row['tytul']) . " - Cena: " . $row['cena_netto'] . " PLN<br>";
        }
    }

    public function __destruct() {
        $this->conn->close();
    }
}

// Testowanie klasy
$produkty = new Produkty($servername, $username, $password, $dbname);

// Przykład dodawania produktu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dodaj'])) {
    $produkty->DodajProdukt($_POST['tytul'], $_POST['opis'], $_POST['cena_netto'], $_POST['podatek'], $_POST['ilosc'], $_POST['status'], $_POST['data_wygasniecia'], $_POST['gabaryt']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pokaz'])) {
    $produkty->PokazProdukty();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Produktami</title>
</head>
<body>
    <h1>Dodaj Produkt</h1>
    <form method="POST" action="">
        <label>Tytuł: <input type="text" name="tytul" required></label><br>
        <label>Opis: <textarea name="opis"></textarea></label><br>
        <label>Cena Netto: <input type="number" step="0.01" name="cena_netto" required></label><br>
        <label>Podatek: <input type="number" step="0.01" name="podatek" required></label><br>
        <label>Ilość w magazynie: <input type="number" name="ilosc" required></label><br>
        <label>Status: 
            <select name="status">
                <option value="dostepny">Dostępny</option>
                <option value="niedostepny">Niedostępny</option>
            </select>
        </label><br>
        <label>Data wygaśnięcia: <input type="date" name="data_wygasniecia"></label><br>
        <label>Gabaryt: <input type="text" name="gabaryt"></label><br>
        <button type="submit" name="dodaj">Dodaj Produkt</button>
    </form>

    <h1>Lista Produktów</h1>
    <form method="POST" action="">
        <button type="submit" name="pokaz">Pokaż Produkty</button>
    </form>
</body>
</html>
