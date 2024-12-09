<?php
function PokazKontakt() {
    echo '<form action="contact.php" method="post">
        <label for="temat">Temat:</label>
        <input type="text" id="temat" name="temat" required><br><br>
        
        <label for="tresc">Treść:</label>
        <textarea id="tresc" name="tresc" required></textarea><br><br>
        
        <label for="email">Twój Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <button type="submit" name="submit">Wyślij</button>
    </form>';
}

function WyslijMailKontakt($odbiorca) {
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
        echo "[Nie wypełniłeś pól!]";
        PokazKontakt();
    } else {
        $mail['subject'] = $_POST['temat'];
        $mail['body'] = $_POST['tresc'];
        $mail['sender'] = $_POST['email'];
        $mail['recipient'] = $odbiorca;

        $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-Version: 1.0\n";
        $header .= "Content-Type: text/plain; charset=utf-8\n";
        $header .= "Content-Transfer-Encoding: 8bit\n";

        if (mail($mail['recipient'], $mail['subject'], $mail['body'], $header)) {
            echo "[Wiadomość wysłana]";
        } else {
            echo "[Błąd wysyłania wiadomości]";
        }
    }
}

function PrzypomnijHaslo($odbiorca) {
    $mail['subject'] = "Przypomnienie hasła";
    $mail['body'] = "Twoje hasło do panelu admina: haslo123"; // Hasło stałe - tylko do celów demonstracyjnych
    $mail['sender'] = "no-reply@twojastrona.pl";
    $mail['recipient'] = $odbiorca;

    $header = "From: Admin <" . $mail['sender'] . ">\n";
    $header .= "MIME-Version: 1.0\n";
    $header .= "Content-Type: text/plain; charset=utf-8\n";
    $header .= "Content-Transfer-Encoding: 8bit\n";

    if (mail($mail['recipient'], $mail['subject'], $mail['body'], $header)) {
        echo "[Hasło wysłane]";
    } else {
        echo "[Błąd wysyłania hasła]";
    }
}

// Obsługa formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    WyslijMailKontakt('admin@twojastrona.pl'); // Zastąp adresem docelowym
}
?>
