<?php
// Funkcja PokazPodstrone wyświetla zawartość strony na podstawie ID
function PokazPodstrone($id) {
    // Załącz plik konfiguracyjny z połączeniem do bazy danych
    include('cfg.php');
    global $link; // Deklaracja globalnej zmiennej $link

    // Oczyszczanie $id, aby zapobiec atakom SQL Injection
    $id_clear = intval($id); // Zamiana na liczbę całkowitą

    // Przygotowanie zapytania SQL
    $query = "SELECT page_content FROM page_list WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($link, $query); // Przygotowanie zapytania

    if (!$stmt) {
        die("Błąd przygotowania zapytania: " . mysqli_error($link));
    }

    // Powiązanie parametru
    mysqli_stmt_bind_param($stmt, "i", $id_clear);

    // Wykonanie zapytania
    mysqli_stmt_execute($stmt);

    // Pobranie wyniku
    $result = mysqli_stmt_get_result($stmt);

    // Wywoływanie strony z bazy
    if ($result && mysqli_num_rows($result) === 0) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $row = mysqli_fetch_assoc($result);
        $web = $row['page_content'];
    }

    // Zamknięcie zapytania
    mysqli_stmt_close($stmt);

    return $web; // Zwrócenie zawartości strony
}
?>