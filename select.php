<!-- ユーザ名 tomato202 -->
<!-- 商品管理サイト -->

<?php
    
    $user_id = $_GET["user_id"];
    $start = $_GET["start"];
    $size = $_GET["size"];
    $user_name = $_GET["user_name"];

    try {

        $pdo = new PDO(
            // ホスト名、データベース名
            "mysql:host=localhost;dbname=login;charset=utf8;",
            //ユーザ名
            "root",
            //パスワード
            "",
            //レコード列名をキーとして取得させる
            [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
        );

    //SQLクエリ作成
    $query = "SELECT * FROM PRODUCT_TABLE WHERE order_user = :user_id ORDER BY PRODUCT_ID LIMIT :begin, :size";

    //SQL文をセット
    $stmt = $pdo->prepare($query);

    //バインド //データを持ってくる
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":begin", $start, PDO::PARAM_INT);
    $stmt->bindParam(":size", $size, PDO::PARAM_INT);

    //SQL文の実行
    $stmt->execute();

    //実行結果のフェッチ
    $result = $stmt->fetchAll();


    if(empty($result)) {
        require_once"login.html";
    } else {
        // 5件 検索
        $query2 = "SELECT * FROM PRODUCT_TABLE WHERE order_user = :user_id ORDER BY PRODUCT_ID LIMIT :begin, :size";
        // LIMIT :BEGIN, :SIZE

        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(":begin", $start, PDO::PARAM_INT);
        $stmt2->bindParam(":size", $size, PDO::PARAM_INT);
        $stmt2->bindParam(":user_id", $user_id);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll();


        require_once "viewSelect_tpl.php";
    }

    } catch (PDOException $e) {
    //例外が発生したら無視
        require_once "exception_tpl.php";
        echo $e->getMessage();
        exit();
    }

?>