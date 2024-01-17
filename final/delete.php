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
    // POSTリクエストで商品IDが送信された場合
    if (isset($_POST['id'])) {
        $konbiniId = $_POST['id'];

        // 商品を削除するSQLクエリ
        $stmt = $pdo->prepare('DELETE FROM Konbini WHERE konbini_id = ?');
        $stmt->execute([$konbiniId]);

        // 削除が成功したらリダイレクト
        header("Location: top.php");
        exit(); // Ensure script stops execution here
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
    <title>商品削除</title>
    <link rel="stylesheet" href="./css/delete.css">
</head>

<body>
    <h1>商品削除</h1>

    <form action="delete.php" method="post">
        <label for="konbiniId">削除する商品のID:</label>
        <select name="id" id="konbiniId">
            <?php foreach ($products as $product) : ?>
                <option value="<?= $product['konbini_id'] ?>"><?= $product['product_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">削除</button>
    </form>

    <br>

    <!-- トップページに戻るリンク -->
    <button onclick="location.href='top.php'">戻る</button>
</body>

</html>
