<?php
/**
 * user_idとpasswordを受け取って認証
 */
include_once '../data/header.tpl';

$sql = "SELECT * FROM users WHERE user_id = '" . $post['user_id'] . "' AND password = '" . $hashed_password . "'";
$stmt = $dbh->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
//ユーザーログイン結果
if($result){
    $arr = array(
        "user_id" => $stmt[0]["user_id"],
        "name" => $stmt[0]["name"]            
    );
    $json = json_encode($arr);
    echo $json;
} else {
    echo "NG";
}