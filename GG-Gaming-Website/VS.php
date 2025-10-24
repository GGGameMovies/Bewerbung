<?php
	// Session-Cookies auf 2 Stunden setzen
	ini_set('session.cookie_lifetime', 7200);
	
	// Starte die Session
	session_start();
	
	// Überprüfe, ob der Benutzer angemeldet ist
	$inactive = 7200;
	$ID="";
	$isUsernameSet = isset($_SESSION['username']);
	$username = $isUsernameSet ? $_SESSION['username'] : null;
	
	$_SESSION['last_activity'] = time();
	
	// Überprüfe, ob diese Seite gesetzt ist, und speichere die aktuelle Seite in der Session
	if (!$isUsernameSet && !isset($_SESSION['current_page'])) {
		$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
	}
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
		// Die Session ist abgelaufen, also logge den Benutzer aus
		session_unset();     // löscht alle Session-Variablen
		session_destroy();   // löscht die Session
	
		// Optional: Weiterleitung auf eine Logout-Seite oder eine andere Seite
		echo "<script>logout();</script>";
		exit();
	}
?>

<!DOCTYPE html>
<html lang="de">
	<head>
	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="VS-Page, Vergleiche Videospiele miteinander in den Attributen Gameplay, Grafik, Immersion, Kreativität, Story, AI, Sound.">
		<meta name="keywords" content="Game Rankings, Game Reviews, Top Games, Best Games">
		<meta name="author" content="Daniel Gonzalez">
		<meta name="robots" content="index, follow">
		<meta property="og:title" content="GG-game.de - Game Rankings and Reviews">
		<meta property="og:description" content="VS-Page, Vergleiche Videospiele miteinander in den Attributen Gameplay, Grafik, Immersion, Kreativität, Story, AI, Sound.">
		<meta property="og:image" content="URL_to_image">
		<meta property="og:url" content="https://www.gg-game.de/VS.php">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="GG-game.de - Game Rankings and Reviews">
		<meta name="twitter:description" content="VS-Page, Vergleiche Videospiele miteinander in den Attributen Gameplay, Grafik, Immersion, Kreativität, Story, AI, Sound.">
		<meta name="twitter:image" content="URL_to_image">
		<link rel="canonical" href="https://www.gg-game.de/VS.php">
		
		<title>VS-Page, Vergleiche Videospiele miteinander in den Attributen Gameplay, Grafik, Immersion, Kreativität, Story, AI, Sound</title>
		
		<link rel="apple-touch-icon" sizes="57x57" href="/bilder/icon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/bilder/icon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/bilder/icon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/bilder/icon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/bilder/icon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/bilder/icon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/bilder/icon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/bilder/icon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/bilder/icon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/bilder/icon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/bilder/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/bilder/icon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/bilder/icon/favicon-16x16.png">
		<link rel="manifest" href="/bilder/icon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/bilder/icon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<link rel="shortcut icon" href="/bilder/icon/ggicon32.png" type="image/x-icon" />
		<link rel="shortcut icon" href="/AllGamesLogo16.png" type="image/x-icon" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	
		<link rel="stylesheet" type="text/css" media="only screen and (max-width: 3840px)" href="CSS/VS3840x2160.css">
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	
		<script type="text/javascript">
		var _iub = _iub || [];
		_iub.csConfiguration = {"askConsentAtCookiePolicyUpdate":true,"enableFadp":true,"enableLgpd":true,"enableTcf":true,"enableUspr":true,"fadpApplies":true,"floatingPreferencesButtonDisplay":"bottom-right","googleAdditionalConsentMode":true,"lang":"de","perPurposeConsent":true,"preferenceCookie":{"expireAfter":180},"siteId":3648320,"tcfPurposes":{"2":"consent_only","7":"consent_only","8":"consent_only","9":"consent_only","10":"consent_only","11":"consent_only"},"usprApplies":true,"whitelabel":false,"cookiePolicyId":91324499, "banner":{ "acceptButtonDisplay":true,"closeButtonDisplay":false,"customizeButtonDisplay":true,"explicitWithdrawal":true,"listPurposes":true,"ownerName":"gg-game.de","position":"bottom","rejectButtonDisplay":true,"showPurposesToggles":true,"showTitle":false,"showTotalNumberOfProviders":true }};
		</script>
		<script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3648320.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/tcf/stub-v2.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/tcf/safe-tcf-v2.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	</head>

	<body>
		<script>
			var isUsernameSet = <?php echo json_encode($isUsernameSet); ?>;
	
			// Ausgabe in der Konsole
			console.log("Anmeldestatus: " + isUsernameSet);	
				
				
			// Funktion zum Wechseln zwischen Login und Registrierung
			function showTab(tabName) {
				document.getElementById('loginContent').style.display = tabName === 'login' ? 'block' : 'none';
				document.getElementById('registerContent').style.display = tabName === 'register' ? 'block' : 'none';
			
				// Ändere den Tab-Stil
				document.getElementById('loginTab').classList.toggle('active', tabName === 'login');
				document.getElementById('registerTab').classList.toggle('active', tabName === 'register');
			}
		</script>
		<header>
			<nav class="navig1">
				<div class="LogoL" >
					<div class="svg-container">
						<img src="./bilder/logotranz.png" alt="kein Bild darstellbar">
					</div>
				</div>
				<div class="LINKS">
					<div class="LINK"><a href="index.php">Willkommen</a></div>
					<div class="LINK"><a class="aktiv" href="VS.php">VS</a></div>
					<div class="LINK"><a href="favorite.php">Favoríten</a></div>
					<div class="LINK"><a href="self.php">Self</a></div>
					<div class="LINK"><a href="Angekündigt.php">Announced</a></div>
					
					<div class="YTBUTTON"> <div class="g-ytsubscribe" data-channelid="UCH_kXSiTr40SPW-zER5MhIA" data-layout="default" data-count="default"></div></div>
				</div>
				<div class="container">
					<div class="svg-container1">
						<?php
							if ($isUsernameSet) {
								echo '<button id="loginButton" onclick="handleLoginButtonClick()">Logout</button>';
								} 
							else {
								echo '<button id="loginButton" onclick="handleLoginButtonClick()">Login</button>';
								}
						?>
							<!------------------------------------------------------------------Login-start----------------------------------------------------------------------->
							<div id="loginPopup">
								<?php include('Login.php'); ?>
							</div>
							<!-------------------------------------------------------------------Login-Ende---------------------------------------------------------------------->
					</div>
					<div class="svg-container2">
						<div class="HelluDunkel">  
							<input type="checkbox" value="None" id="HelluDunkel" name="check" checked onclick="backColor()" />
							<label class="HelluDunkellabel"  for="HelluDunkel"></label>
						</div>
					</div>
				</div>
			</nav>
		</header>
		
		<main>
			<div class="VS">
				<div id="VS1">
					<select id="svs1" name="svs1">
						<option value="">Alle Spiele</option>
						<?php
							$servername = '';
							$username = '';
							$password = '';
							$dbname = '';
			
							$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
							if (!$link) {
								die("Connection failed: " . mysqli_connect_error());
							}
							
							// Prepare the SQL statement to get BesucherID
							$sql = "SELECT BesucherID FROM besucher WHERE Benutzername = ?";
							
							if ($stmt = $link->prepare($sql)) {
								// Bind parameters
								$stmt->bind_param('s', $username);
							
								// Execute the statement
								$stmt->execute();
							
								// Bind result variables
								$stmt->bind_result($besucherID);
							
								// Fetch value
								if ($stmt->fetch()) {
									// Store the BesucherID in the variable $ID
									$ID = $besucherID;
								} else {
									echo "No results found.";
								}
							
								$stmt->close();
							}
							
							// Spiele aus der Datenbank abrufen
							$sql = "SELECT s.SpielName FROM spiele s 
									LEFT JOIN bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ? 
									WHERE s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?)
									GROUP BY s.SpielName 
									ORDER BY COALESCE(b.Rating, s.Rating) DESC";
							
							// Prepare the query with placeholders for parameters
							$stmt = mysqli_prepare($link, $sql);
							
							// Binden von Parametern (falls erforderlich)
							if ($stmt) {
								// Binden des Parameters
								mysqli_stmt_bind_param($stmt, "ii", $ID, $ID);
							
								// Ausführen der vorbereiteten Abfrage
								if (mysqli_stmt_execute($stmt)) {
									// Ergebnisse abrufen
									$result = mysqli_stmt_get_result($stmt);
							
									// Spiele in die Dropdown-Liste einfügen
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
											echo '<option value="' . $row['SpielName'] . '">' . $row['SpielName'] . '</option>';
										}
									} else {
										echo "No results found.";
									}
							
									// Schließe die vorbereitete Anweisung nach der Verarbeitung der Ergebnisse
									mysqli_stmt_close($stmt);
								} else {
									// Fehlerbehandlung, falls die Abfrage nicht erfolgreich ausgeführt wurde
									die(mysqli_stmt_error($stmt));
								}
							} else {
								// Fehlerbehandlung, falls die Abfrage nicht vorbereitet werden konnte
								die(mysqli_error($link));
							}
							
							// Verbindung schließen
							mysqli_close($link);
						?>
					</select>
					
					<div id="BlackH"></div>
				</div>
				
				<div id="BorderH"></div>
				
				<div id="VS2">
					<select id="svs2" name="svs2">
						<option value="">Alle Spiele</option>
						<?php
							$servername = '';
							$username = '';
							$password = '';
							$dbname = '';
			
							$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
							if (!$link) {
								die("Connection failed: " . mysqli_connect_error());
							}
						
							// Spiele aus der Datenbank abrufen
							$sql = "SELECT s.SpielName FROM spiele s 
									LEFT JOIN bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ? 
									WHERE s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?)
									GROUP BY s.SpielName 
									ORDER BY COALESCE(b.Rating, s.Rating) DESC";
							
							// Prepare the query with placeholders for parameters
							$stmt = mysqli_prepare($link, $sql);
							
							// Binden von Parametern (falls erforderlich)
							if ($stmt) {
								// Binden des Parameters
								mysqli_stmt_bind_param($stmt, "ii", $ID, $ID);
							
								// Ausführen der vorbereiteten Abfrage
								if (mysqli_stmt_execute($stmt)) {
									// Ergebnisse abrufen
									$result = mysqli_stmt_get_result($stmt);
							
									// Spiele in die Dropdown-Liste einfügen
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
											echo '<option value="' . $row['SpielName'] . '">' . $row['SpielName'] . '</option>';
										}
									} else {
										echo "No results found.";
									}
							
									// Schließe die vorbereitete Anweisung nach der Verarbeitung der Ergebnisse
									mysqli_stmt_close($stmt);
								} else {
									// Fehlerbehandlung, falls die Abfrage nicht erfolgreich ausgeführt wurde
									die(mysqli_stmt_error($stmt));
								}
							} else {
								// Fehlerbehandlung, falls die Abfrage nicht vorbereitet werden konnte
								die(mysqli_error($link));
							}
							
							// Verbindung schließen
							mysqli_close($link);
						?>
					</select>	
						
					<div id="BlackH2"></div>
				</div>
			</div>
			
			<script>
				<!--------------------------------------------------------------------VS-------------------------------------------------------------------
				$(document).ready(function() {
					// Select2 initialisieren für svs1
					$('#svs1').select2();
			
					// Benutzereingabe erfassen für svs1
					$('#svs1').on('select2:open', function(e) {
						$('.select2-search__field').attr('placeholder', 'Spiel suchen');
					});
			
					// Select3 initialisieren für svs2
					$('#svs2').select2();
			
					// Benutzereingabe erfassen für svs2
					$('#svs2').on('select2:open', function(e) {
						$('.select2-search__field').attr('placeholder', 'Spiel suchen');
					});
				});
				<!-----------------------------------------------------------ausgabe von select VS1---------------------------------------------------------	
					$('#svs1').change(function(event){
					event.preventDefault();
					$.ajax({
						type: 'Post',
						url: 'select_GForm.php?ID=' + encodeURIComponent('<?php echo $ID; ?>'),
						data: $(this).serialize(),
						success: function(data){
						$('#BlackH').html(data);
					}})});	
				
				<!-----------------------------------------------------------ausgabe von select VS2---------------------------------------------------------	
					$('#svs2').change(function(event){
					event.preventDefault();
					$.ajax({
						type: 'Post',
						url: 'select_GForm.php?ID=' + encodeURIComponent('<?php echo $ID; ?>'),
						data: $(this).serialize(),
						success: function(data){
						$('#BlackH2').html(data);
					}})});
				<!-----------------------------Link über namen------------------------------------------
					function openLink(url, target) {
						if (url) {
							window.open(url, target);
						}
					}
				//-------------------------------------------------------------------------------------
				//-----------------------------Hell und Dunkelseite--start--------------------------------
				let istTag = false;
			
				function backColor() {
					istTag = !istTag;
				
					var h2Elements = document.querySelectorAll('h2');
					const loginButton = document.getElementById('loginButton');
					const navig1 = document.querySelector('.navig1');
					const Navi2 = document.querySelector('.Navi2');
					const alleAnker = document.querySelectorAll('a');
					const schalter = document.querySelector('.HelluDunkel label');
				
					if (!istTag) {
						navig1.style.backgroundColor = 'black';
						Navi2.style.backgroundColor = 'black';
						document.body.style.backgroundColor = 'black';
						schalter.style.background = 'white';
						loginButton.style.backgroundColor = 'black';
						loginButton.style.color = 'white';
						element.style.color = 'white';
						
						alleAnker.forEach(link => {
							link.style.color = 'white';
						});
						
					} else {
						navig1.style.backgroundColor = 'white';
						Navi2.style.backgroundColor = 'white';
						document.body.style.backgroundColor = 'white';
						schalter.style.background = 'black';
						loginButton.style.backgroundColor = 'white';
						loginButton.style.color = 'black';
						element.style.color = 'black';
						
						alleAnker.forEach(link => {
							link.style.color = 'black';
						});
					}
				}
				// -----------------------------Hell und Dunkelseite-ende----------------------------------
				
				//---------------------Login Button ---------------------------------------------------------------			
				function handleLoginButtonClick() {
					var loginButton = document.getElementById('loginButton');
					
					if (loginButton.innerText === 'Login') {
						LoginPopupAuf();
					} else if (loginButton.innerText === 'Logout') {
						logout();
					}
				}
				//-------popup auf-----------------------
				function LoginPopupAuf() {
					document.getElementById('loginPopup').style.display = 'block';
				}
				//-------popup auf------------------------
				//-------popup zu-----------------------
				function closeLoginPopup() {
						document.getElementById('loginPopup').style.display = 'none';
				}
				//-------popup zu------------------------
				//---------------------Login Button ---------------------------------------------------------------	
				//-----------------------------------logout-start-------------------------------------------------
				function logout() {
					fetch('logout.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded',
						},
					})
					.then(response => response.text())
					.then(data => {
						if (data.trim() === 'success') {
							// Hier wird die Weiterleitung zur vorherigen Seite implementiert
							const previousPage = '<?php echo isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 'index.php'; ?>';
							window.location.href = previousPage;
						} else {
							location.reload();
							alert('Logout fehlgeschlagen');
						}
					})
					.catch(error => {
						console.error('Error during logout:', error);
					});
				}
				//---------------------logout-end---------------------------------------------------------------
				
				//---------------------site aktualisierung bei größen änderung---------------------------------------------------------------
				window.onresize = function(event) {
					location.reload();
				};
				//---------------------site aktualisierung--------------------------------------------------------------
				//---------------------Password forget-start---------------------------------------------------------------
				function handleVergessenButtonClick() {
				
					window.location.href = "http://gg-game.de/Passwort.php";
				}
				//---------------------Password forget-end--------------------------------------------------------------
				//---------------------resize start---------------------------------------------------------------
				window.onresize = function(event) {
					var screenWidth = window.innerWidth;
					if (
						screenWidth === 360 ||
						screenWidth === 768 ||
						screenWidth === 1366 ||
						screenWidth === 1440 ||
						screenWidth === 1920 ||
						screenWidth === 2560 ||
						screenWidth === 3840
					) {
						location.reload();
					}
				};
				//---------------------resize end---------------------------------------------------------------			
				document.addEventListener("DOMContentLoaded", function () {
					function showTab(tabName) {
						document.getElementById('loginContent').style.display = tabName === 'login' ? 'block' : 'none';
						document.getElementById('registerContent').style.display = tabName === 'register' ? 'block' : 'none';
				
						document.getElementById('loginTab').classList.toggle('active', tabName === 'login');
						document.getElementById('registerTab').classList.toggle('active', tabName === 'register');
				
						if (tabName === 'login') {
							document.getElementById('loginPopup').style.display = 'block';
						} else {
							if (!loginFailed) {
								document.getElementById('loginPopup').style.display = 'none';
							}
						}
					}
				});
				//---------------------show tab change end------------------------------------------------------------
			</script>
		</main>
<?php
include('Unten.php');
?>	