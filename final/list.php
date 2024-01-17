<head>
    <link rel="stylesheet" href="./css/list.css">
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

// 商品一覧を取得
$stmt = $pdo->prepare('SELECT * FROM Konbini');
if ($stmt->execute()) {
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Failed to fetch products from the database.");
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
</head>

<body>
    <h1>商品一覧</h1>

    <table border="1">
    <tr>
        <th>番号</th>
        <th>コンビニ舗店名</th> <!-- 修正: 閉じるタグにスラッシュを追加 -->
        <th>商品名</th>
        <th>商品説明</th>
        <th>単価</th>
        <th>画像</th>
        <th>作成日</th>
        <th>更新日</th> 
    </tr>

    <?php foreach ($products as $product) : ?>
        <tr>
            <td><?= $product['konbini_id'] ?></td>
            <td><?= $product['konbini_name'] ?></td>
            <td><?= $product['product_name'] ?></td>
            <td><?= $product['product_description'] ?></td>
            <td><?= $product['unit_price'] ?></td>
            <td><img src="<?= 'img/' . $product['image_path'] ?>" alt="画像がないにょ" width="100"></td>
            <td><?= $product['create_date'] ?></td>
            <td><?= $product['update_date'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>


<button onclick="location.href='top.php'">戻る</button>


</html>