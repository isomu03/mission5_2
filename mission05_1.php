<!DOCTYPE html>

<html>
    
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        <?php
        // データベース設定
        
        $dsn = 'mysql:dbname=データベース名;host=localhost';
        $user = 'ユーザー名';
        $password = 'パスワード名';
        $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        ?>
        <!--投稿フォーム-->
        <h3>投稿フォーム</h3>
        <form method="post">
            <p>パスワード</p><input type="text" name="password">
            <p>氏名：</p><input type="text" name="name">
            <p>コメント：</p><input type="text" name="comment">
            <input type="submit" value="送信">
        </form>
        <?php
         if(isset($_POST["name"]) and isset($_POST["comment"]) and $_POST["name"] != "" and $_POST["comment"] != "" and $_POST["password"] == "Mission5omedetou"){
            
            $sql = $pdo -> prepare("INSERT INTO missionfive (name,comment,date,password) VALUES (:name,:comment,:date,:password)");
            $sql -> bindParam(':name',$name,PDO::PARAM_STR);
            $sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
            $sql -> bindParam(':date',$date,PDO::PARAM_STR);
            $sql -> bindParam(':password',$password,PDO::PARAM_STR);
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $date = date("Y年m月d日 H時i分s秒");
            $password = "Mission5omedetou";
            $sql -> execute();
            
            // データを出力
            $sql = 'SELECT*FROM missionfive';
            $stmt = $pdo ->query($sql);
            $result = $stmt ->fetchAll();
            foreach($result as $row){
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['date'].'<br>';
            }
            echo "<hr>";
            
        }else {
            echo "";
        }
        
        
        ?>
        <br><br><br>
        <!--編集フォーム-->
        <h3>編集フォーム</h3>
        <form method="post">
            <p>パスワード：</p><input type="text" name="password_edit">
            <p>変更する投稿番号：</p><input type="text" name="num_edit">
            <p>氏名：</p><input type="text" name="name_edit">
            <p>コメント：</p><input type="text" name="comment_edit">
            <input type="submit" value="送信">
        </form>
        <?php
        if(isset($_POST["num_edit"]) and isset($_POST["name_edit"]) and isset($_POST["comment_edit"]) and $_POST["name_edit"] != "" and $_POST["comment_edit"] != "" and $_POST["password_edit"] == "Mission5omedetou"){
             $id = $_POST["num_edit"]; //変更する投稿番号
             $name = $_POST["name_edit"];
             $comment = $_POST["comment_edit"]; //変更したい名前、変更したいコメントは自分で決めること
             $date = date("Y年m月d日 H時i分s秒");
             $sql = 'UPDATE missionfive SET name=:name,comment=:comment,date =:date WHERE id=:id';
             $stmt = $pdo->prepare($sql);
             $stmt->bindParam(':name', $name, PDO::PARAM_STR);
             $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
             $stmt->bindParam(':date', $date, PDO::PARAM_INT);
             $stmt->execute();
             
             
            $sql = 'SELECT * FROM missionfive';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['date'].'<br>';
            echo "<hr>";
            }
        }else{
            echo "";
        }
        
        ?>
        <br><br><br>
        <!--削除フォーム-->
        <h3>削除フォーム</h3>
        <form method="post">
            <p>パスワード：</p><input type="text" name="password_delete">
            <p>削除する番号：</p><input type="text" name="id_delete">
            
            <input type="submit" value="送信">
        </form>
        <?php
        if(isset($_POST["id_delete"]) and $_POST["id_delete"] != "" and $_POST["password_delete"] == "Mission5omedetou"){
            $id = $_POST["id_delete"];
            $sql = 'delete from missionfive where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // 出力しますお
            $sql = 'SELECT * FROM missionfive';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['date'].'<br>';
                echo "<hr>";
                }
            } else {
                echo "";
            }
        
        ?>
        <br><br><br>
        <footer>
            
        </footer>
    </body>
</html>