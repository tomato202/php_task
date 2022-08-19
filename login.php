<!-- ユーザ名 tomato202 -->
<!-- 商品管理サイト -->
<?php
    $user_id = $_GET["user_id"];
    $password = $_GET["password"];
    $start = $_GET["start"];
    $size = $_GET["size"];

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

    //SQLクエリ作成 (よくない例)
//   $query = "SELECT * FROM user WHERE user_id = \'' .$user_id. '\' AND password = \'' :password";
    $query = "SELECT * FROM user_table WHERE user_id = :user_id AND password = :password";

    //SQL文をセット
    $stmt = $pdo->prepare($query);

    //バインド //データを持ってくる
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":password", $password);

    //SQL文の実行
    $stmt->execute();

    //実行結果のフェッチ
    $result = $stmt->fetchAll();
    if(empty($result)) {
        require_once"login.html";
    } else {
        $user_name = $result[0]["name"];
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