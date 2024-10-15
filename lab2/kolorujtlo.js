function changeHeaderFooterColor() {
    const headerFooterColor = document.getElementById('buttonColor').value;
    const header = document.querySelector('.header');
    const footer = document.querySelector('.footer');

    header.style.backgroundColor = headerFooterColor;
    footer.style.backgroundColor = headerFooterColor;

    // Zapisz wybrany kolor w localStorage
    localStorage.setItem('headerFooterColor', headerFooterColor);
}

// Funkcja do przywracania koloru po załadowaniu strony
function loadHeaderFooterColor() {
    const savedColor = localStorage.getItem('headerFooterColor');
    const header = document.querySelector('.header');
    const footer = document.querySelector('.footer');
    const defaultColor = 'rgba(57, 153, 153, 0.85)';

    if (savedColor) {
        // Ustaw kolor na zapisany
        header.style.backgroundColor = savedColor;
        footer.style.backgroundColor = savedColor;
        // Ustaw wartość w input color na zapisany kolor
        document.getElementById('buttonColor').value = savedColor;
    } else {
        // Ustaw kolor na domyślny
        header.style.backgroundColor = defaultColor;
        footer.style.backgroundColor = defaultColor;
        document.getElementById('buttonColor').value = defaultColor; // Ustaw domyślny kolor w input
    }
}

// Nasłuchuj na zmiany koloru
document.getElementById('buttonColor').addEventListener('change', changeHeaderFooterColor);

// Przywróć kolor po załadowaniu strony
window.addEventListener('load', loadHeaderFooterColor);

// Obsługa przycisku do otwierania paska bocznego
document.getElementById('sidebarToggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.style.left === '0px') {
        sidebar.style.left = '-250px';
    } else {
        sidebar.style.left = '0px';
    }
});
