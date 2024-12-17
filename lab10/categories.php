// Insert default categories if table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM categories");
$row = $result->fetch_assoc();
if ($row['count'] == 0) {
    $defaultCategories = [
        ['name' => 'Electronics', 'parent_id' => 0],
        ['name' => 'Computers', 'parent_id' => 1],
        ['name' => 'Laptops', 'parent_id' => 2],
        ['name' => 'Smartphones', 'parent_id' => 1],
        ['name' => 'Home Appliances', 'parent_id' => 0],
        ['name' => 'Kitchen', 'parent_id' => 5],
        ['name' => 'Living Room', 'parent_id' => 5]
    ];

    foreach ($defaultCategories as $category) {
        $stmt = $conn->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
        $stmt->bind_param("si", $category['name'], $category['parent_id']);
        $stmt->execute();
        $stmt->close();
    }
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create categories table
$sql = "CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT DEFAULT 0,
    name VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table categories created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Function to add category
function addCategory($name, $parent_id = 0) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $parent_id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete category
function deleteCategory($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to edit category
function editCategory($id, $name, $parent_id = 0) {
    global $conn;
    $stmt = $conn->prepare("UPDATE categories SET name = ?, parent_id = ? WHERE id = ?");
    $stmt->bind_param("sii", $name, $parent_id, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to display categories
function showCategories($parent_id = 0, $level = 0) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, name FROM categories WHERE parent_id = ?");
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo str_repeat("--", $level) . $row['name'] . "<br>";
        showCategories($row['id'], $level + 1);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $parent_id = $_POST['parent_id'];
    addCategory($name, $parent_id);
}

// Function to delete all categories
function deleteAllCategories() {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM categories");
    $stmt->execute();
    $stmt->close();
}

// Delete all categories to avoid duplicates on refresh
deleteAllCategories();

?>
<?php
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>
    <h1>Categories</h1>
    <form method="post" action="">
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="parent_id">Parent ID:</label>
        <input type="number" id="parent_id" name="parent_id" value="0">
        <button type="submit" name="add">Add Category</button>
    </form>

    <h2>Category List</h2>
    <?php
    showCategories();
    ?>
</body>
</html>
// Function to delete all categories
function deleteAllCategories() {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM categories");
    $stmt->execute();
    $stmt->close();
}

// Delete all categories to avoid duplicates on refresh
deleteAllCategories();