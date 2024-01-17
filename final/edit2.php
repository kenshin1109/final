<head>
    <link rel="stylesheet" href="./css/edit2.css">
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

// 編集対象の商品名を取得
$productName = isset($_GET['product_name']) ? $_GET['product_name'] : (isset($_POST['product_name']) ? $_POST['product_name'] : null);

if (!$productName) {
    echo "Invalid product_name.";
    exit();
}

// 商品情報を取得
$stmt = $pdo->prepare('SELECT * FROM Konbini WHERE product_name = ?');
$stmt->execute([$productName]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit();
}

// フォームが送信されたらデータベースを更新
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newkonbiniName = isset($_POST['konbini_name']) ? $_POST['konbini_name'] : $product['konbini_name'];
    $newProductName = isset($_POST['product_name']) ? $_POST['product_name'] : $productName;
    $newProductDescription = isset($_POST['product_description']) ? $_POST['product_description'] : $product['product_description'];
    $newUnitPrice = isset($_POST['unit_price']) ? $_POST['unit_price'] : $product['unit_price'];
    $newImagePath = isset($_POST['image_path']) ? $_POST['image_path'] : $product['image_path'];

    // 商品情報を更新
    $updateSql = "UPDATE Konbini SET 
                  konbini_name = ?, 
                  product_name = ?, 
                  product_description = ?, 
                  unit_price = ?, 
                  image_path = ? 
                  WHERE product_name = ?";

    try {
        $stmt = $pdo->prepare($updateSql);
        $stmt->execute([$newkonbiniName, $newProductName, $newProductDescription, $newUnitPrice, $newImagePath, $productName]);
        echo "商品を更新できます。";
    } catch (PDOException $ex) {
        echo "Error updating record: " . $ex->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>

<body>
    <h1>商品編集画面</h1>

    <form action="edit2.php" method="post">
        <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
        コンビニ店舗名:<input type="text" name="konbini_name" value="<?php echo $product['konbini_name']; ?>" required><br>
        商品名: <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required><br>
        商品詳細: <textarea name="product_description"><?php echo $product['product_description']; ?></textarea><br>
        値段: <input type="text" name="unit_price" value="<?php echo $product['unit_price']; ?>" required><br>
        画像パス: <input type="text" name="image_path" value="<?php echo $product['image_path']; ?>"><br>
        <input type="submit" value="更新する">
    </form>

    <br>
    
    <button onclick="location.href='top.php'">戻る</button>

</body>

</html>
