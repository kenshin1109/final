<head>
    <link rel="stylesheet" href="./css/edit.css">
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
    // POSTリクエストで商品名が送信された場合
    if (isset($_POST['product_name'])) {
        $productName = $_POST['product_name'];

        try {
            // 編集ページへのリダイレクト
            header("Location: edit2.php?product_name=$productName");
            exit();
        } catch (PDOException $ex) {
            // エラーハンドリング: エラーが発生した場合に処理を行う
            echo "Error redirecting to edit2.php: " . $ex->getMessage();
        }
    }
}

// 商品一覧を取得
$stmt = $pdo->query('SELECT * FROM Konbini');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新</title>
</head>

<body>
    <h1>商品更新</h1>

    <form action="edit2.php" method="post">
        <label for="productName">編集する商品の名前:</label>
        <select name="product_name" id="productName">
            <?php foreach ($products as $product) : ?>
                <option value="<?= $product['product_name'] ?>"><?= $product['product_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">編集</button>
    </form>

    <br>

    <!-- トップページに戻るリンク -->
    <button onclick="location.href='top.php'">戻る</button>
</body>

</html>
