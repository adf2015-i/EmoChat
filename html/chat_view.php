<?php
/**
 * user1とuser2に対してのチャットのログをゲット
 * json->user_id,emotion,icon,message,time
 */
header("Content-Type: application/json; charset=utf-8");
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
$log = $stmt->fetch()['log'] ?: array();
header("Content-Type: application/json; charset=utf-8");
echo $log;
