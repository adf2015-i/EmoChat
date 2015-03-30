<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

// TODO; バリデーション
$user_id =$_POST['user_id'];
$datas = $_POST['data'];
$q = $_POST['query'];

ini_set("date.timezone", "Asia/Tokyo");
// TODO: token チェック
if (!isset($q) || $q !== 'log_keystroke') {
    die('-1');
}
// TODO: ユーザディレクトリ作成
$file_name = date('Ymd-His') . '.csv';
$dirpath = "data/{$user_id}/";
if (!file_exists($dirpath)) {
    mkdir($dirpath, 0755, true);
}

// TODO: CSV吐き出し
$filepath = $dirpath . $file_name;
$fp = fopen($filepath, "w");
foreach ($datas as $data) {
    fputcsv($fp, $data);
}
fclose($fp);

// TODO: ファイルパス, user_id, ua をPOST
$url = "hoge.php";
$data = array(
    "user_id" => $user_id,
    "filepath" => $filepath,
    "ua" => "PC"
);
echo $url . http_build_query($data);
$f = file_get_contents('' . $url . '?' . http_build_query($data));
var_dump($f);

// TODO: 結果の出力
