
 var autori=Array();

 $("#dodaj").click(function(){

//trim i sve ostale kontrole
if($("#ime").val()==="")
{
alertify.error("Niste unijeli ime");
   return false;
}
if($("#prezime").val()==="")
{
alertify.error("Niste unijeli prezime");
   return false;
}
if($("#email").val()==="")
{
alertify.error("Niste unijeli e-mail");
   return false;
}
if($("#fakultet").val()==="")
{
alertify.error("Niste unijeli fakultet");
   return false;
}



   autori.push({
	   "ime":$("#ime").val(),
	   "prezime":$("#prezime").val(),
	   "email":$("#email").val(),
	   "fakultet":$("#fakultet").val()
   //dodti ostale
   });

   prikaziAutore();
   alertify.success("Autor uspješno dodan");
   return false;
 });

 function prikaziAutore(){
	 $("#autori").html("<h2>Prijavljeni autori:</h2>");
	for(var i=0;i<autori.length;i++){
	   $("#autori").append("<p class='lefttext'>"
	   + autori[i].ime + " " + " | " 
	   + autori[i].prezime + " " + " | " 
	   + autori[i].email + " " + " | " 
	   + autori[i].fakultet + " "  
	   + " <a class=\"brisanje btn-danger btn-sm\" href=\"#\" id=\"id_" + i + "\">Obriši</a></p>");
	}
	$(".brisanje").unbind("click");
	definirajBrisanje();
	isprazni();
	
 }

 function definirajBrisanje(){
	 $(".brisanje").click(function(){
	   var id = $(this).attr("id").split("_")[1];
	   //console.log(id);
	  // console.log(autori);
	   autori.splice(id,1);
	  // console.log(autori);
	   prikaziAutore();
	   alertify.success("Autor uspješno obrisan");
	   return false;
	 });
 }

 //originalno autorsko djelo
 function isprazni(){
	$("#ime, #prezime, #email, #fakultet").val("")
	return false;
 }




///////////////
/// READ
///////////////

function ucitaj(){
	$.getJSON(putanjaAPI + "/rad/read", function( jsonData ) {
		postaviNaTablicu(jsonData);
	});
}

ucitaj();


///////////////
/// CREATE
///////////////
$("#noviOperater").click(function(){
	jQuery.each($("#forma").serializeArray(), function() {
		$("#" + this.name).val("");
    });
    $("#sifra").val("0");
	$('#modal').modal('show');  		
	return false;
});


///////////////
/// UPDATE
///////////////

$("#spremi").click(function(){
	
	if($("#naslov").val()==="")
	{
	alertify.error("Niste unijeli naslov rada");
		 return false;
	}
	if($("#kljucnerijeci").val()==="")
{
alertify.error("Niste unijeli ključne riječi");
   return false;
}
if($("#sazetak").val()==="")
{
alertify.error("Niste unijeli sažetak");
   return false;
}

if($("#autori p").length == 0)
{
alertify.error("Niste unijeli autora");
   return false;
}

	var json = {};
	
    jQuery.each($("#forma").serializeArray(), function() {
        json[this.name] = this.value || '';
	});
	json["autori"]=autori;
	//console.log(json);
	if (console.error !== null) {
		ajax(putanjaAPI + "/rad/create",json)
		alertify.success("Prijava uspješna");
		setTimeout("location.href = 'index.html'",2000);
	}
	else{
		alertify.error("Prijava neuspješna");
	}
		
	return false;
});


///////////////
/// SEARCH
///////////////

$("#traziForma").submit(function( event ) {
	trazi();
	return false;
});


$("#uvjet").keyup(function( event ) {
	trazi();
	return false;
});



//Ova funkcija je potrebna kako bi nakon ajax-a mogli na novo učitane redove definirati događaje
function definirajDogadajeNakonAJAXa(){
	
	///////////////
  	/// DELETE
  	///////////////
	
	$(".brisanje").click(function(){
	    var json = {};
	    json["sifra"]=$(this).attr("id").split("_")[1];
		if(confirm("sigurno obrisati?")){
			ajax(putanjaAPI + "/delete",json);
		}
		return false;
	});
	
	///////////////
  	/// UPDATE
  	///////////////
	
	$(".promjena").click(function(){
		var sifra=$(this).attr("id").split("_")[1];
		$.getJSON(putanjaAPI + "/read/" + sifra, function( jsonData ) {
			jQuery.each(Object.entries(jsonData), function() {
				$("#" + this[0]).val(this[1]);
			});
			$('#modal').modal('show');	  			
		});
	});
}





///////////////
/// UTILITY
///////////////

function ajax(putanja,json){
	var podaci=JSON.stringify(json);
	$.ajax({
		type: 'POST',
	    url: putanja,
	    contentType: 'application/json; charset=utf-8',
	    data: JSON.stringify(json),
	    success: function(data){
	        if(data==="OK"){
	        	ucitaj();
	        	$('#modal').modal('hide');
	        }
	    }
	});
}

function postaviNaTablicu(jsonData){
	$("#podaci").html("");
	  $.each( jsonData, function( kljuc, operater ) {
	    $("#podaci").append("<tr>" + 
	    "<td>" + operater.sifra + "</td>" +
	    "<td>" + operater.ime + "</td>" +
	    "<td>" + operater.prezime + "</td>" +
	    "<td>" + operater.email + "</td>" +
		"<td>" + operater.fakultet + "</td>" +
		"<td>" + operater.naslov + "</td>" +
		"<td>" + operater.sazetak + "</td>" +
		"<td>" + operater.kljucnerijeci + "</td>" +
	    "<td><a href=\"#\" class=\"promjena\" id=\"o_" + operater.sifra + "\">Promjena</a> | " +
	    "<a href=\"#\" class=\"brisanje\" id=\"o_" + operater.sifra + "\">Brisanje</a>"
	     + "</td>" +
	    "</tr>");
	  });
	  definirajDogadajeNakonAJAXa();
}


function trazi(){
	var uvjet=$("#uvjet").val();
	if(uvjet==""){
		uvjet="%20";
	}
	$.getJSON(putanjaAPI + "/search/" + uvjet, function( jsonData ) {
		postaviNaTablicu(jsonData);
	});
}


$(document).ready(function() {

	// Hide the div
	$("#logo").hide();
	$("#about").hide();
	$("#info").hide();
	$("#theme").hide();
	$("#themes").hide();
	$("#cfp").hide();
	$("#city-photo").hide();
	$("#text-osijek").hide();
	$("#footer").hide();
	$("#city").hide();

	// Show the div in 5s themes
	$("#logo").delay(500).fadeIn('slow').delay(200);
	$("#about").delay(1000).fadeIn(500);
	$("#info").delay(1200).fadeIn(500);
	$("#theme").delay(1500).fadeIn(500);
	$("#themes").delay(2000).fadeIn(500);
	$("#cfp").delay(2500).fadeIn(500);
	$("#footer").delay(3000).fadeIn(500);
	$("#city").delay(700).fadeIn(500);
	$("#city-photo").delay(1300).fadeIn(500);
	$("#text-osijek").delay(1800).fadeIn(500);
});