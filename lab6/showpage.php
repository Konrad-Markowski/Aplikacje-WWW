<?php
$page_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

include('cfg.php');

$sql = "SELECT page_title, page_content FROM page_list WHERE id = ? AND status = 1 LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $page_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $page_title = $row['page_title'];
    $page_content = $row['page_content'];
} else {
    $page_title = "Strona nie znaleziona";
    $page_content = "Przepraszamy, ale strona o podanym ID nie istnieje lub jest nieaktywna.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="menu">
        <table>
            <tr>
                <td><a href="./index.php">Strona główna</a></td>
                <td><a href="./showpage.php?id=1">Zwycięzcy</a></td>
                <td><a href="./showpage.php?id=2">Reżyserzy</a></td>
                <td><a href="./showpage.php?id=3">Historia</a></td>
                <td><a href="./showpage.php?id=4">Kontakt</a></td>
                <td><a href="./showpage.php?id=5">Test block</a></td>
            </tr>
        </table>
    </div>
    <h1><?php echo htmlspecialchars($page_title); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($page_content)); ?></p>
</body>
</html>
