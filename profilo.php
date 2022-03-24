<!DOCTYPE html>
<html lang="it"> 
<head>
    <title>LTW - Let Them Work</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head> 
<?php
include "connect.php";
//OpenConnection();
//PerformQuery("SELECT Nome, Cognome, NomeIstruzione, NomeOccupazione, NomeLuogo, COUNT(Punteggio) FROM ((Utenti AS U INNER JOIN Punteggi AS P ON U.IDUtente = P.idFUtente) INNER JOIN Istruzione AS I ON I.IDIStruzione = U.Istruzione) INNER JOIN Luogo AS L ON L.IDLuogo = U.Luogo) INNER JOIN Occupazione AS O ON O.IDOccupazione = U.Occupazione")
//CloseConnection();
?>
<body class="p-3 bg-dark">   	
    <div>
        <img src="img/banner.jpg" class="position-absolute top-0 start-0 w-100 h-25"  style="z-index: -1;">
        <div>
            <img src="img/user-1.jpg" class="rounded-circle w-25 border border-dark border-4">
        </div>
        <p class="fs-5 text-success float-end mt-2"><i class="bi bi-emoji-smile me-2"></i>+100</p>
        <p class="fs-2 text-light">Simeone Lettiero</p>
        <p class="fs-5 text-light"><span class="text-muted"><i class="bi bi-mortarboard-fill me-2"></i>Istruzione: </span>IIS L. Cobianchi</p>
        <p class="fs-5 text-light"><span class="text-muted"><i class="bi bi-building me-2"></i>Occupazione: </span>Emisfera Soc. Coop.</p>
        <p class="fs-5 text-light"><span class="text-muted"><i class="bi bi-geo-alt-fill me-2"></i>Luogo: </span>Verbania</p>

    </div>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>

window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "dark2",
	title:{
		text: "Comportamenti"
	},
	data: [{   
        lineColor: "green",
		type: "line",
      	indexLabelFontSize: 16,
		dataPoints: [
			{ y: 50 },
			{ y: -14 },
			{ y: -20 },
			{ y: -60 },
			{ y: 50 },
			{ y: 100 },
			{ y: -80 },
			{ y: 80 },
			{ y: 10 },
			{ y: 10 },
			{ y: -80 },
			{ y: 10 }
		]
	}]
});
chart.render();

}
</script>
</body>
</html> 

