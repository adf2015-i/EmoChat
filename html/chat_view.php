<?php
/**
 * user1とuser2に対してのチャットのログをゲット
 * json->user_id,emotion,icon,message,time
 */
include_once '../data/header.tpl';

$sql = "SELECT * FROM chat_logs WHERE (user1= '{$post['user1']}' AND user2 = '{$post['user2']}') OR (user1= '{$post['user2']}' AND user2 = '{$post['user1']}')";
$stmt = $dbh->query($sql);
$json = $stmt[0]["log"];
echo $json;