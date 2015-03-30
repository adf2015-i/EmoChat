<?php
/**
 * user_idとpasswordを受け取って認証
 */
require_once ('../data/config.php');
$post = filter_input_array(INPUT_POST);
try {
    $dbh = new PDO(DSN, DBUSER, DBPASSWORD);
}
catch(PDOException $e) {
    print ('Error:' . $e->getMessage());
    die();
}

$sql = "SELECT id FROM users WHERE user_id = '" . $post['user_id'] . "' AND password = '" . $hashed_password . "'";
$stmt = $dbh->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
//ユーザーログイン結果
if($result){
    //ログイン成功時、友達リストのJSONファイル生成
    $sql = "SELECT * FROM users";
    $stmt = $dbh->query($sql);
    $res = $stmt->fetch();
    $arr = array();
    foreach($stmt as $val){
        $arr[] = array(
            "user_id" => $val["user_id"],
            "name" => $val["name"],
            "last_time"=> $val["last_date"]
        );
    }
    $json = json_encode($arr);
    echo $json;
} else {
    echo "NG";
}