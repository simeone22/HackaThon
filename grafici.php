<?php
session_start();
if(!isset($_SESSION['usr']) && !isset($_SESSION['psw']))
    header("Location: accessoScuole.php");
$host_db="localhost";
$user_db="Terzi";
$pass_db="Terzi";
$db="Salone_Orientamento_Lama_Danda_Terzi";
$mysqli = new mysqli($host_db, $user_db, $pass_db, $db)
or die("<br>Connessione non riuscita " . $mysqli->connect_error . " " . $mysqli->connect_errno);
//query che seleziona il nome della scuola
$queryNome = "SELECT Nome FROM Amministratore WHERE Username = 'admin';";
$risultato = $mysqli->query($queryNome);
$valore = $risultato->fetch_array(MYSQLI_NUM);
$nome = strval($valore[0]);
$query = "SELECT TitoloPresentazione, COUNT(IDFUtente) AS partecipanti
                FROM (Presentazioni INNER JOIN Orari ON IDPresentazione = IDFPresentazione)
                INNER JOIN Iscrizione_alla_presentazione ON IDFOrario = IDOrario
                GROUP BY TitoloPresentazione;";
$risultato2 = $mysqli->query($query);
if(!$risultato2){
    $_SESSION['query'] = "Errore della query: " . $mysqli->error . ".";
    print $_SESSION['query'];
}
?>
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Home Amministratore</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" ><strong>Ciao <?php echo (string) $nome?>!</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="ChiSiamo.php">Chi Siamo</a>
                    </li>
                </ul>
            </div>
            <form action="logout.php" class="float-right pt-1 mt-1">
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </nav>
</header>
<?php
$dati = array();
$aperturatagTabella = "<table class='table'>";
$chiusuratagTabella = "</table>";
$aperturaRiga="<tr>";
$chiusuraRiga="</tr>";
$aperturaColonna="<td>";
$chiusuraColonna="</td>";
$tabella = $aperturatagTabella . "<thead>" . $aperturaRiga . "<th scope='col'>" . "Titolo Presentazione" . "</th> <th scope='col'>" . "Partecipanti" . "</th>" . $chiusuraRiga . "</thead><tbody>";
while($riga=mysqli_fetch_array($risultato2,MYSQLI_BOTH))
{
    array_push($dati,array("label"=> $riga['TitoloPresentazione'], "y"=> $riga['partecipanti']));
    $tabella .= $aperturaRiga . $aperturaColonna . $riga['TitoloPresentazione'] . $chiusuraColonna . $aperturaColonna . $riga['partecipanti'] . $chiusuraColonna . $chiusuraRiga;
}
?>
<div class="container mt-5 pt-5">
    <div class='display-3 text-center'>Grafico dei partecipanti</div>
    <div id="miografico" style="height: 450px; width: 100%;"></div>
</div>
<?php
$tabella .= "</tbody>". $chiusuratagTabella;
echo "<div class='container mt-5'> " . $tabella . "<button class='btn btn-primary' onclick='window.print()'>Stampa</button></div>";
?>
<!-- FOOTER -->
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3"
        <li class="nav-item"><a href="homepage.php" class="nav-link px-2 text-muted">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Torna all'inizio</a></li>
        <li class="nav-item"><a href="#exampleModal" data-bs-toggle="modal" id="filename" class="nav-link px-2 text-muted" >Scarica guida pdf</a></li>
        </ul>
        <p class="text-center text-muted">© 2021 Company, Inc</p>
    </footer>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guida PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Vuoi scaricare la guida pdf?
            </div>
            <form action="DownloadPDF.php" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary" name="filename">Scarica</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("miografico", {
            animationEnabled: true,
            theme: "dark2",
            axisY: {
                title: "Partecipanti",
                includeZero: false
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($dati, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/jquery-3.3.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap-4.3.1.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
