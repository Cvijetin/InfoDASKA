<?php 
try {
<<<<<<< HEAD
	$db = new PDO('mysql:host=localhost;dbname=infodaska2019', 'infodaska7', 'UHduwhd.ojwf');
=======
	$db = new PDO('mysql:host=localhost;dbname=infodaska2019', '', '');
>>>>>>> fbe0788da58cdddd606f6808f983e470fa9ae4a4
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
$db->query("set names utf8");

<<<<<<< HEAD
?>
=======
?>
>>>>>>> fbe0788da58cdddd606f6808f983e470fa9ae4a4
