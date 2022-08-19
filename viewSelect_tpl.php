<!-- ユーザ名 tomato202 -->
<!-- 商品管理サイト -->

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">

    <title></title>
</head>
<body>
<p>ようこそ <?php echo $user_name ?> さん</p>

<?php
    // 出力
    $cnt = $start;
    foreach($result2 as $row) {
        echo "<p>";
        $cnt += 1;
        echo($cnt);
        echo(", ");
        echo $row["product_name"];
        echo(" ");
        echo $row["price"];
        echo("円");
        echo "</p>";
    }

?>
    <form action = "select.php" method = "get">
        <input type = "hidden" name = "user_id" value = "<?php echo $user_id; ?>">
        <input type = "hidden" name = "start" value = "
<?php
    $next = $start - 5;
    if ($next > 0) {
        $next = 0;
    }
    echo $next;
?>
        ">
        <!-- 前へ -->
        <input type = "hidden" name = "size" value = "<?php echo $size; ?>">
        <input type = "submit" name = "submitBtn" value = "前へ">
        <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
    </form>

    <!-- 次へ -->
    <form action = "select.php" method = "get">
        <input type = "hidden" name = "user_id" value = "<?php echo $user_id; ?>">
        <input type = "hidden" name = "start" value = "<?php echo $start + 5; ?>">
        <input type = "hidden" name = "size" value = "<?php echo $size; ?>">
        <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
        <input type = "submit" name = "submitBtn" value = "次へ">
    </form>

    <form action = "add_data.php" method = "get">
        <input type = "hidden" name = "user_id" value = "<?php echo $user_id; ?>">
        <input type = "hidden" name = "start" value = "<?php echo $start + 5; ?>">
        <input type = "hidden" name = "size" value = "<?php echo $size; ?>">
        <input type = "hidden" name = "user_name" value = "<?php echo $user_name; ?>">
        <input type = "submit" name = "submitBtn" value = "追加">





</body>
</html>