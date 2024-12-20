<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oscary - Strona Główna</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

    <button class="sidebar-button" id="sidebarToggle">☰</button>

<div class="sidebar" id="sidebar">
    <br><br>
    <h2>Ustawienia koloru</h2>
    <div class="color-picker">
        <label for="buttonColor">Kolor:</label><br>
        <input type="color" id="buttonColor" name="buttonColor" value="#0000ff"><br><br>
    </div>
    <button id="resetColor">Przywróć oryginalny kolor</button>
</div>

    <div class="header">
        <h1>Filmy Oscarowe</h1>
    </div>

    <div class="menu">
        <table>
            <tr>
                <td><a href="./index.html">Strona główna</a></td>
                <td><a href="./html/winners.html">Zwycięzcy</a></td>
                <td><a href="./html/directors.html">Reżyserzy</a></td>
                <td><a href="./html/history.html">Historia</a></td>
                <td><a href="./html/contact.html">Kontakt</a></td>
                <td><a href="./html/test-block.html">Test block</a></td>
            </tr>
        </table>
    </div>

    <div class="main-content">
        <h2 id="clock"></h2>

        <h1>Oscary - ogólne informacje</h1>
        <p>Witamy na stronie poświęconej Oscarom, corocznej ceremonii, która nagradza najlepsze osiągnięcia w przemyśle filmowym.</p>
        
        <h2>Historia Oscarów</h2>
        <p>
            <img id="oscar-award" src="./assets/other/oscar-award-transparent.png" alt="Oscar Award">
            Nagroda Akademii Filmowej, znana jako Oscar, to prestiżowe wyróżnienie przyznawane corocznie przez Amerykańską Akademię Sztuki i Wiedzy Filmowej. Pierwsza ceremonia odbyła się 16 maja 1929 roku.
            Nagrody przyznawane są filmom, które były wyświetlane w amerykańskich kinach w poprzednim roku kalendarzowym. 
            Uroczystość wręczenia Oscarów odbywa się zazwyczaj wczesną wiosną, a większość wyróżnień trafia do filmów anglojęzycznych. 
            Od 2002 roku ceremonia odbywa się w Dolby Theatre w Hollywood.
            Oscary są uważane za jedną z najważniejszych nagród filmowych, mimo że koncentrują się głównie na amerykańskiej kinematografii. 
            Wraz z nagrodami Emmy, Grammy i Tony tworzą tzw. EGOT – zestaw czterech najważniejszych wyróżnień w amerykańskim przemyśle rozrywkowym.
        </p>
        <br>
        <h2>Najważniejsze kategorie</h2>
        <p>Wśród wielu kategorii, które są nagradzane podczas ceremonii, najbardziej znane to:</p>
        <ul>
            <li><b>Najlepszy Film:</b> Nagroda ta jest przyznawana filmowi, który zdobył najwyższe uznanie w danym roku.</li>
            <li><b>Najlepszy Reżyser:</b> Ta nagroda trafia do reżysera filmu, który wyróżnił się wyjątkowym warsztatem artystycznym.</li>
            <li><b>Najlepszy Aktor/Actorka:</b> Nagrody te są przyznawane najlepszym aktorom, którzy wykazali się wyjątkowym talentem w danym roku.</li>
            <li><b>Najlepszy Scenariusz:</b> Ta kategoria honoruje najlepsze scenariusze filmowe, zarówno oryginalne, jak i adaptowane.</li>
        </ul>

        <h2>Znane Filmy i Aktorzy</h2>
        <p>
            W historii Oscarów nie brakowało filmów i aktorów, którzy zostali na zawsze zapamiętani dzięki swoim osiągnięciom. 
            Filmy takie jak <i>"Przeminęło z wiatrem"</i>, <i>"Casablanca"</i>, czy <i>"Titanic"</i> zdobyły serca widzów na całym świecie i zyskały uznanie krytyków. 
            Aktorzy tacy jak <b>Meryl Streep</b>, <b>Jack Nicholson</b> czy <b>Denzel Washington</b> zyskali status legend dzięki wielokrotnym nominacjom i wygranym w swojej karierze.
        </p>

        <h2>Gdzie i kiedy odbywa się ceremonia?</h2>
        <p>
            Ceremonia wręczenia Oscarów odbywa się corocznie w Los Angeles, zazwyczaj w lutym lub marcu. 
            Miejsce, w którym odbywa się gala, zmienia się, ale od wielu lat jest to Dolby Theatre w Hollywood. 
            Ceremonia przyciąga miliony widzów na całym świecie, a także wiele znanych osobistości z branży filmowej.
        </p>

        <h2>Podsumowanie</h2>
        <p>
            Oscary to nie tylko nagrody, ale także wydarzenie, które łączy ludzi z całego świata w miłości do kina. 
            Każdego roku świętujemy osiągnięcia artystyczne, które inspirują nas i dostarczają niezapomnianych chwil. 
            Niezależnie od tego, kto zdobywa nagrody, Oscary pozostają symbolem doskonałości w przemyśle filmowym.
        </p>
    </div>

    <div class="footer">
        <p>&copy; 2024 Filmy Oscarowe. Wszelkie prawa zastrzeżone.</p>
    </div>

    <!-- Do naprawienia <script src="kolorujtlo.js"></script> -->
    <script src="clock.js"></script>
    <script>
        $(document).ready(function() {
            $('.gallery img').hover(function() {
                $(this).css('transform', 'scale(1.2)');
            }, function() {
                $(this).css('transform', 'scale(1)');
            });
    
            let scale = 1;
            $('.gallery img').click(function() {
                scale += 0.1;
                $(this).css('transform', 'scale(' + scale + ')');
            });
        });
    </script>
    
</body>
</html>
