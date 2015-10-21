Test : <?php
$text = file_get_contents("../index.html");
$text = str_replace("bungalow","TOTO",$text);
echo $text;
?>