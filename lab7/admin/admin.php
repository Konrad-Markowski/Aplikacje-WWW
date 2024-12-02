<?php
include 'cfg.php';

// Metoda: FormularzLogowania
function FormularzLogowania($error = '') {
    echo "<form method='post' action=''>
        <h3>Logowanie</h3>
        <p style='color: red;'>$error</p>
        <input type='text' name='username' placeholder='Login'><br>
        <input type='password' name='password' placeholder='Hasło'><br>
        <button type='submit'>Zaloguj</button>
    </form>";
}

// Logika logowania
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === $GLOBALS['login'] && $_POST['password'] === $GLOBALS['pass']) {
        $_SESSION['loggedin'] = true;
    } else {
        FormularzLogowania('Niepoprawny login lub hasło.');
        exit;
    }
}

// Sprawdzenie dostępu
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    FormularzLogowania();
    exit;
}

// Metoda: ListaPodstron
function ListaPodstron() {
    $conn = new mysqli("localhost", "root", "", "cms");
    $result = $conn->query("SELECT id, tytul FROM podstrony");
    echo "<h3>Lista Podstron</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Tytuł</th><th>Akcje</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['tytul']}</td>
            <td>
                <a href='admin.php?edit={$row['id']}'>Edytuj</a> | 
                <a href='admin.php?delete={$row['id']}'>Usuń</a>
            </td>
        </tr>";
    }
    echo "</table>";
}

// Metoda: EdytujPodstrone
function EdytujPodstrone($id) {
    $conn = new mysqli("localhost", "root", "", "cms");
    $result = $conn->query("SELECT * FROM podstrony WHERE id=$id LIMIT 1");
    $row = $result->fetch_assoc();
    echo "<form method='post'>
        <input type='text' name='title' value='{$row['tytul']}'><br>
        <textarea name='content'>{$row['tresc']}</textarea><br>
        <label><input type='checkbox' name='active' " . ($row['aktywna'] ? 'checked' : '') . "> Aktywna</label><br>
        <button type='submit'>Zapisz</button>
    </form>";
}

// Metoda: DodajNowaPodstrone
function DodajNowaPodstrone() {
    echo "<form method='post'>
        <input type='text' name='title' placeholder='Tytuł'><br>
        <textarea name='content' placeholder='Treść'></textarea><br>
        <label><input type='checkbox' name='active'> Aktywna</label><br>
        <button type='submit'>Dodaj</button>
    </form>";
}

// Metoda: UsunPodstrone
function UsunPodstrone($id) {
    $conn = new mysqli("localhost", "root", "", "cms");
    $conn->query("DELETE FROM podstrony WHERE id=$id LIMIT 1");
    echo "Podstrona została usunięta.";
}

// Obsługa akcji
if (isset($_GET['delete'])) {
    UsunPodstrone($_GET['delete']);
}
if (isset($_GET['edit'])) {
    EdytujPodstrone($_GET['edit']);
} else {
    ListaPodstron();
}
?>
