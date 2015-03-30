<?php
?>

<h1>chatviewテスト</h1>
<form action="http://52.68.50.255/chat_view.php" method="post">
    <input type="text" name="user1" value="testid1"/>
    <input type="text" name="user2" value="testid2"/>
    <input type='submit' name="sub" value="chatview"/>
</form>
<br>
<h1>message投稿テスト</h1>
<form action="http://52.68.50.255/message.php" method="post">
    <input type="text" name="user1" value="testid1"/>
    <input type="text" name="user2" value="testid2"/>
    <input type="text" name="message" value="message"/>
    <input type='submit' name="sub" value="投稿"/>
</form>