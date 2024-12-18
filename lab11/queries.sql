CREATE TABLE IF NOT EXISTS products (
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
);
