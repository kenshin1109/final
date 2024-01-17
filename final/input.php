<head>
    <link rel="stylesheet" href="./css/input.css">
</head>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516817-final';
const USER = 'LAA1516817';
const PASS = 'Pass1109';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $konbini_id = $_POST['konbini_id']; 
    $konbini_name = $_POST['konbini_name'];
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $unitPrice = $_POST['unit_price'];
    $imagePath = $_POST['image_path'];

    // 以下のクエリは konbini_id を含めた INSERT 文です
    $stmt = $pdo->prepare('INSERT INTO Konbini (konbini_id, konbini_name, product_name, product_description, unit_price, image_path, create_date, update_date) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())');
    $stmt->execute([$konbini_id, $konbini_name, $productName, $productDescription, $unitPrice, $imagePath]);

}

echo '<h1>商品登録</h1>';
echo '<form action="input.php" method="post">';
echo 'コンビニ店舗番号: <input type="text" name="konbini_id" required><br>'; // 追加された部分
echo 'コンビニ店舗名<input type="text" name="konbini_name" required><br>';
echo '商品名: <input type="text" name="product_name" required><br>';
echo '商品説明: <textarea name="product_description" required></textarea><br>';
echo '単価: <input type="text" name="unit_price" required><br>';
echo '画像URL: <input type="text" name="image_path" required><br>';
echo '<button type="submit">登録</button>';
echo '</form>';
echo '</body>';
echo '</html>';
?>

<button onclick="location.href='top.php'">戻る</button>
