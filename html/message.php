<?php
/**
 * user1, user2 ,message
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

$sql = "SELECT * FROM chat_logs WHERE (user1= '{$post['user1']}' AND user2 = '{$post['user2']}') OR (user1= '{$post['user2']}' AND user2 = '{$post['user1']}')";
$stmt = $dbh->query($sql);
$res = $stmt->fetch();
$arr = json_decode($res["log"] ?: array(),TRUE);
$now = date("Y-m-d H:i:s");
$arr[] = array(
    "user_id"=>$post["user1"],
    "emotion"=>1,
    "message"=>$post["message"],
    "time"=>$now
);
$json = json_encode($arr);
$sql = "UPDATE chat_logs SET log='{$json}',last_date='{$now}' WHERE id=".$res['id'];
$stmt = $dbh->query($sql);
echo $json;