
<ul>
<?php
// nom du fichier
$dirname = $_GET['dirname'];
if($dirname == '') {
    $dirname = '../test';
}
$dir = opendir($dirname); 

while($file = readdir($dir)) {
	if($file == '.')
	{
	} else if($file == '..') {
	    $dirparent = substr($dirname,0,strrpos($dirname,"/"));
	    if(strlen($dirparent)>0){
	        echo '<li><a href="/test/listfiles.php?dirname='.$dirparent.'">'.$file.'</a></li>';
	    }
	} else {
	    if(is_dir($dirname."/".$file)) {
		    echo '<li><a href="/test/listfiles.php?dirname='.$dirname."/".$file.'">'.$file.'</a></li>';
	    } else {
		    echo '<li><a href="/test/readfile.php?file='.$dirname."/".$file.'">'.$file.'</a></li>';
	    }
	}
}

closedir($dir);
 ?>
</ul>
