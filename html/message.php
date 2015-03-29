<?php
/**
 * user_id message stroke
 */
include_once '../data/header.tpl';
$sql = "SELECT * FROM chat_logs WHERE (user1= '{$post['user1']}' AND user2 = '{$post['user2']}') OR (user1= '{$post['user2']}' AND user2 = '{$post['user1']}')";
$stmt = $dbh->query($sql);
$json = $stmt[0]["log"];
$arr = json_decode($json,TRUE);
$now = date("Y-m-d H:i:s");
$arr[] = array(
    "user_id"=>$post["user_id"],
    "emotion"=>1,
    "icon"=>"example.com",
    "message"=>$post["message"],
    "time"=>$now
);
$json = json_encode($arr);
$sql = "INSERT INTO chat_logs (log) VALUES ({$json}) WHERE id = ".$stml[0]['id'];
echo $json;

