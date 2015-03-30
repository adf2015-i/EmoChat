<?php
/**
 * user1, user2 ,message
 */
require_once ('../data/config.php');
require_once ('./EmotionRecogtion.php');
$post = filter_input_array(INPUT_POST);
try {
    $dbh = new PDO(DSN, DBUSER, DBPASSWORD);
}
catch(PDOException $e) {
    print ('Error:' . $e->getMessage());
    die();
}

// TODO: emotion 判定
//　$date = date('Ymd-His');
//　$file_name = "{$user_name}-{$date}.csv";
//　$dirpath = "profile-iOS/";
//　
//　$filepath = $dirpath . $file_name;
//　$fp = fopen($filepath, "w");
//　foreach ($datas as $data) {
//　    fputcsv($fp, $data);
//　}
//　fclose($fp);
// recognizeEmotion("profile-iOS", $filepath, $post['user1'], "iOS");

$sql = "SELECT * FROM chat_logs WHERE (user1= '{$post['user1']}' AND user2 = '{$post['user2']}') OR (user1= '{$post['user2']}' AND user2 = '{$post['user1']}')";
$stmt = $dbh->query($sql);
$res = $stmt->fetch();
$arr = json_decode($res["log"] ?: array(), TRUE);
$now = date("Y-m-d H:i:s");

$arr[] = array(
    "user_id"=>$post["user1"],
    "emotion"=>recognizeUserEmotion($post['message']),
    "message"=>$post["message"],
    "time"=>$now
);
// image path
// TODO: user2 は bot
$message_patterns = array(
    '進捗どうですか？',
    '...',
    '本気で言ってる？',
    '頑張って'
);

$arr[] = array(
    "user_id"=>$post["user2"],
    "emotion"=>recognizeUserEmotion(""),
    "message"=> $message_patterns[count($arr) % 4],
    "time"=>$now
);

$json = json_encode($arr);

$sql = "UPDATE chat_logs SET log='{$json}',last_date='{$now}' WHERE id=".$res['id'];
$stmt = $dbh->query($sql);

header("Content-Type: application/json; charset=utf-8");
echo $json;
