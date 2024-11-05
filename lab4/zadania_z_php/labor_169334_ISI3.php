<?php
    $nr_indeksu = '169334';
    $nrGrupy = 'ISI 3';

    echo 'Konrad Markowski '.$nr_indeksu.' grupa: '.$nrGrupy.'<br /><br />';

    echo 'Zastosowanie metody include() <br />';

    echo "a) Demonstracja metody include() i require_once():<br>";
    
    include('example.php');
    require_once('example_once.php');

    echo "<br>";

    echo "b) Demonstracja warunków if, else, elseif, switch:<br>";

    $number = 7;

    echo "Używając if/elseif/else:<br>";
    if ($number < 5) {
        echo "Liczba jest mniejsza niż 5.<br>";
    } elseif ($number == 5) {
        echo "Liczba jest równa 5.<br />";
    } else {
        echo "Liczba jest większa niż 5.<br />";
    }

    echo "Używając switch:<br />";
    switch ($number) {
        case 1:
            echo "Liczba to 1.<br />";
            break;
        case 7:
            echo "Liczba to 7.<br />";
            break;
        default:
            echo "Liczba to inna wartość.<br />";
    }
    echo "<br />";

    echo "c) Demonstracja pętli while() i for():<br />";

    // Pętla while
    echo "Pętla while:<br />";
    $i = 0;
    while ($i < 5) {
        echo "i = $i<br />";
        $i++;
    }

    // Pętla for
    echo "Pętla for:<br />";
    for ($j = 0; $j < 5; $j++) {
        echo "j = $j<br />";
    }
    echo "<br />";

    echo "d) Typy zmiennych \$_GET, \$_POST, \$_SESSION:<br />";

    // $_GET
    if (isset($_GET['name'])) {
        echo 'GET: Witaj ' . htmlspecialchars($_GET['name']) . '<br />';
    } else {
        echo 'GET: Brak danych w \$_GET <br />';
    }

    // $_POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
        echo 'POST: Witaj ' . htmlspecialchars($_POST['name']) . '<br />';
    } else {
        echo 'POST: Brak danych w \$_POST <br />';
    }

    // $_SESSION
    session_start();
    if (!isset($_SESSION['visit'])) {
        $_SESSION['visit'] = 0;
    }
    $_SESSION['visit']++;
    echo 'SESSION: Odwiedziłeś tę stronę ' . $_SESSION['visit'] . ' razy<br />';
?>
