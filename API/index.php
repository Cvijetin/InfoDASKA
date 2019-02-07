<?php
require 'vendor/autoload.php';
/*     ********************               RUTE ZA AUTORA        ********************                  */
//Read
Flight::route('/autor/read', function(){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,ime,prezime,email,fakultet,datumprijave from autor");
	$izraz->execute();
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
Flight::route('/autor/read/@id', function($sifra){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,ime,prezime,email,fakultet,datumprijave from autor where sifra=:sifra");
	$izraz->execute(array("sifra" => $sifra));
	echo json_encode($izraz->fetch(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
//Create
Flight::route('POST /autor/create', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("insert into autor (ime,prezime,email,fakultet,datumprijave) values (:ime,:prezime,:email,:fakultet,now())");
	$izraz->execute((array)$o);
	echo "OK";
});
//Update
Flight::route('POST /autor/update', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("update autor set ime=:ime,prezime=:prezime,email=:email,fakultet=:fakultet where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});
//Delete
Flight::route('POST /autor/delete', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("delete from autor where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});
//Search
Flight::route('/autor/search/@uvjet', function($uvjet){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,ime,prezime,email,fakultet,datumprijave from autor where concat(ime,' ',prezime) like :uvjet");
	$izraz->execute(array("uvjet" => "%" . $uvjet . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
/*     ********************               RUTE ZA RAD        ********************                  */
//Read
Flight::route('/rad/read', function(){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,naslov,sazetak,kljucnerijeci,pocetakizlaganja,krajizlaganja,radionica from rad");
	$izraz->execute();
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
Flight::route('/rad/read/@id', function($sifra){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,naslov,sazetak,kljucnerijeci,pocetakizlaganja,krajizlaganja,radionica from rad where sifra=:sifra");
	$izraz->execute(array("sifra" => $sifra));
	echo json_encode($izraz->fetch(PDO::FETCH_OBJ),JSON_UNESCAPED_UNICODE);
});
//Create
//provjerit
Flight::route('POST /rad/create', function(){
	$o = json_decode(file_get_contents('php://input'));

	echo $o->sazetak;
	
	$veza = Flight::db();
	$izraz = $veza->prepare("insert into autor (ime,prezime,email,fakultet,datumprijave) values (:ime,:prezime,:email,:fakultet,now())");
	$izraz = $veza->prepare("insert into rad (naslov,sazetak,kljucnerijeci) values (:naslov,:sazetak,:kljucnerijeci)");
	$izraz->execute((array)$o);

	//nakon inserta rada staviti na rad autore

	echo "<hr />";
	foreach($o->autori as $autor){
		// $veza = Flight::db();
		// $izraz = $veza->prepare("select * autor where ");
		// $izraz->execute();
		// $id = isset($_GET["id"]) ? $_GET["id"] : 0;
		//prvo proveriti da li taj autor prema imenu i preyimenu postpoji u bayi
		//ako postoji uyeti id_ako ne postoji unijeti novi i uyeti id
		// echo $autor->ime . "<br />";
	}
	//echo "OK";
});
//Update
//provjerit
Flight::route('POST /rad/update', function(){
	$o = json_decode(file_get_contents('php://input'));


	$veza = Flight::db();
	$izraz = $veza->prepare("update rad set naslov=:naslov,sazetak=:sazetak,kljucnerijeci=:kljucnerijeci,pocetakizlaganja=:pocetakizlaganja,krajizlaganja=:krajizlaganja,radionica=:radionica where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});
//Delete
Flight::route('POST /rad/delete', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("delete from rad where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});
//Search
//provjerit
Flight::route('/rad/search/@uvjet', function($uvjet){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,naslov,sazetak,kljucnerijeci,pocetakizlaganja,krajizlaganja,radionica from rad where concat(naslov,' ',kljucnerijeci) like :uvjet");
	$izraz->execute(array("uvjet" => "%" . $uvjet . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
//utility
Flight::map('notFound', function(){
   $poruka=new stdClass();
   $poruka->status="404";
   $poruka->message="Not found";
   echo json_encode($poruka, JSON_UNESCAPED_UNICODE);
});
//lokalno
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=daska_api;charset=UTF8','root',''));
//server
//Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=tjakopec_p3;charset=UTF8','tjakopec','123456'));
Flight::start();