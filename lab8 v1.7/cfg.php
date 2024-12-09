<?php
session_start();

$login = "admin";
$pass = "1234";

function FormularzLogowania() {
    $Sznyrik = "
    <div class='logowanie'>
        <h1 class='heading'>Panel CMS:</h1>
        <div class='logowanie'>
            <form method='post' name='LoginForm' enctype='multipart/form-data' action='".$_SERVER['REQUEST_URI']."'>
                <table class='logowanie'>
                    <tr class='log4_t'><td>e-mail:</td><td><input type='text' name='login_email' class='logowanie' /></td></tr>
                    <tr class='log4_t'><td>hasło:</td><td><input type='password' name='login_pass' class='logowanie' /></td></tr>
                    <tr><td>&nbsp;</td><td><input type='submit' name='xl_submit' class='logowanie' value='Zaloguj' /></td></tr>
                </table>
            </form>
        </div>
    </div>";
    return $Sznyrik;
}

function ListaPodstron() {
    $query = "SELECT * FROM page_list ORDER BY id DESC";
    $result = mysql_query($query);
    $output = "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Usuń</th>
            <th>Edytuj</th>
        </tr>";

    while ($row = mysql_fetch_array($result)) {
        $output .= "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['tytul']}</td>
            <td><a href='delete.php?id={$row['id']}'>Usuń</a></td>
            <td><a href='edit.php?id={$row['id']}'>Edytuj</a></td>
        </tr>";
    }

    $output .= "</table>";
    return $output;
}

