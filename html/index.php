<?php
/**
 * user1とuser2に対してのチャットのログをゲット
 * json->user_id,emotion,icon,message,time
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
$sql = "SELECT * FROM chat_logs WHERE (user1= 'testid1' AND user2 = 'testid2')";
$stmt = $dbh->query($sql);
$log = json_decode($stmt->fetch()['log'] ?: json_encode(array()), TRUE);
$log = array_reverse($log);
?>

<!DOCTYPE html>
<meta charset="UTF-8">

<style>
.com {
  width: 50%;
  background: #0D08B0;
  padding: 5px;
  margin: 5px;
  border-radius: 5px;
  height: 200px;
  color: white;
}
.com h3 {
  font-size: 40px;
  margin: 0;
}
.com img {
    width: 100px;
    height: 100px;
    float: left;
    border-radius: 10px;
}
.com.testid1 {
    float:right;
    background: #08D1E2;
}
br.c {
clear: both;
}

</style>
<title>EMOチャット</title>
<h1>EMOチャット</h1>
<form action="http://52.68.50.255/message2.php" method="post">
    <input type="hidden" name="user1" value="testid1"/>
    <input type="hidden" name="user2" value="testid2"/>
    <input type="text" name="message" value="message"/>
    <input type='submit' name="sub" value="メッセージ投稿"/>
</form>

<?php foreach($log as $l) { ?>
<br class="c">
<div class='com <?= $l['user_id'] ?>'>
<h3><?= $l['user_id'] ?></h3>
<p><?= $l['message'] ?></p>
<img src="images/icon/<?= $l['user_id']?>/<?= $l['emotion']?>">
</div>
<?php } ?>
