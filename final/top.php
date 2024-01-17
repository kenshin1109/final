<head>
    <link rel="stylesheet" href="./css/top.css">
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

echo '<h1>コンビニ最強の食べ物</h1>';
echo '僕の知っているコンビニの飯で一番うまいものを決めるサイトです。';
echo '僕の食べたことがある飯しか登録してないので信憑性は高いです。';
echo '昼ごはんや夜ご飯を食べるときに参考にしてください。';
echo '<hr>';
echo '<style>';
echo 'button { margin-right: 10px; }'; // 必要に応じてマージンを調整してください
echo '</style>';

echo '<button onclick="location.href=\'list.php\'">一覧</button>';
echo '<button onclick="location.href=\'input.php\'">登録</button>';
echo '<button onclick="location.href=\'delete.php\'">削除</button>';
echo '<button onclick="location.href=\'edit.php\'">更新</button>';

// ボタンの下に画像を挿入
echo '<img src="img/konbini.jpg" alt="" >';

echo '</body>';
echo '</html>';
?>


