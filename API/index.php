<?php
require 'vendor/autoload.php';
/*     ********************               RUTE ZA AUTORA        ********************                  */
//Read
Flight::route('/read', function(){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,ime,prezime,email,fakultet,naslov,sazetak,kljucnerijeci from podatci");
	$izraz->execute();
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
Flight::route('/read/@id', function($sifra){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,ime,prezime,email,fakultet,naslov,sazetak,kljucnerijeci from podatci where sifra=:sifra");
	$izraz->execute(array("sifra" => $sifra));
	echo json_encode($izraz->fetch(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
//Create
Flight::route('POST /create', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("insert into podatci (ime,prezime,email,fakultet,naslov,sazetak,kljucnerijeci) values (:ime,:prezime,:email,:fakultet,:naslov,:sazetak,:kljucnerijeci)");
	$izraz->execute((array)$o);
	echo "OK";
});
//Update
Flight::route('POST /update', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("update podatci set ime=:ime,prezime=:prezime,email=:email,fakultet=:fakultet,naslov=:naslov,sazetak=:sazetak,kljucnerijeci=:kljucnerijeci where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});
//Delete
Flight::route('POST /delete', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("delete from podatci where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});
//Search
Flight::route('/search/@uvjet', function($uvjet){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,ime,prezime,email,fakultet,naslov,sazetak,kljucnerijeci from podatci where concat(ime,' ',prezime) like :uvjet");
	$izraz->execute(array("uvjet" => "%" . $uvjet . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
});
/*     ********************               RUTE ZA RAD        ********************                  */
//Read
// Flight::route('/rad/read', function(){
// 	$veza = Flight::db();
// 	$izraz = $veza->prepare("select sifra,naslov,sazetak,kljucnerijeci,pocetakizlaganja,krajizlaganja,radionica from rad");
// 	$izraz->execute();
// 	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
// });
// Flight::route('/rad/read/@id', function($sifra){
// 	$veza = Flight::db();
// 	$izraz = $veza->prepare("select sifra,naslov,sazetak,kljucnerijeci,pocetakizlaganja,krajizlaganja,radionica from rad where sifra=:sifra");
// 	$izraz->execute(array("sifra" => $sifra));
// 	echo json_encode($izraz->fetch(PDO::FETCH_OBJ),JSON_UNESCAPED_UNICODE);
// });
// //Create
// //provjerit
// Flight::route('POST /rad/create', function(){
// 	$o = json_decode(file_get_contents('php://input'));
// 	$veza = Flight::db();
// 	$izraz = $veza->prepare("insert into rad (naslov,sazetak,kljucnerijeci,pocetakizlaganja,krajizlaganja,radionica) values (:naslov,:sazetak,:kljucnerijeci,:pocetakizlaganja,:krajizlaganja,:radionica)");
// 	$izraz->execute((array)$o);
// 	echo "OK";
// });
// //Update
// //provjerit
// Flight::route('POST /rad/update', function(){
// 	$o = json_decode(file_get_contents('php://input'));
// 	$veza = Flight::db();
// 	$izraz = $veza->prepare("update rad set naslov=:naslov,sazetak=:sazetak,kljucnerijeci=:kljucnerijeci,pocetakizlaganja=:pocetakizlaganja,krajizlaganja=:krajizlaganja,radionica=:radionica where sifra=:sifra;");
// 	$izraz->execute((array)$o);
// 	echo "OK";
// });
// //Delete
// Flight::route('POST /rad/delete', function(){
// 	$o = json_decode(file_get_contents('php://input'));
// 	$veza = Flight::db();
// 	$izraz = $veza->prepare("delete from rad where sifra=:sifra;");
// 	$izraz->execute((array)$o);
// 	echo "OK";
// });
// //Search
// //provjerit
// Flight::route('/rad/search/@uvjet', function($uvjet){
// 	$veza = Flight::db();
// 	$izraz = $veza->prepare("select sifra,naslov,sazetak,kljucnerijeci,pocetakizlaganja,krajizlaganja,radionica from rad where concat(naslov,' ',kljucnerijeci) like :uvjet");
// 	$izraz->execute(array("uvjet" => "%" . $uvjet . "%"));
// 	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);

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