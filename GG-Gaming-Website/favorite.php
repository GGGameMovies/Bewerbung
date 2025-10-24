<?php
	// Session-Cookies auf 2 Stunden setzen
	ini_set('session.cookie_lifetime', 7200);
	
	// Starte die Session
	session_start();
	
	// Überprüfe, ob der Benutzer angemeldet ist
	$inactive = 7200;
	$ID ="";
	$isUsernameSet = isset($_SESSION['username']);
	$username = $isUsernameSet ? $_SESSION['username'] : null;
	
	// Überprüfe, ob diese Seite gesetzt ist, und speichere die aktuelle Seite in der Session
	if (!$isUsernameSet && !isset($_SESSION['current_page'])) {
		$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
	}
	
	$_SESSION['last_activity'] = time();
	require_once('select_GForm.php');
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once('select_GForm.php');
	
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
	
		session_unset();     
		session_destroy();   
		echo "<script>logout();</script>";
		exit();
	}
?>

<!DOCTYPE html>
<html lang="de">
	<head>
	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Favoriten-Page, Wähle deine wichtigsten Spiele-Attribute Plattform, Genre, Entwickler, Spieltype, Release,Gameplay,Grafik uvm.">
		<meta name="keywords" content="Game Rankings, Game Reviews, Top Games, Best Games">
		<meta name="author" content="Daniel Gonzalez">
		<meta name="robots" content="index, follow">
		<meta property="og:title" content="GG-game.de - Game Rankings and Reviews">
		<meta property="og:description" content="Favoriten-Page, Wähle deine wichtigsten Spiele-Attribute Plattform, Genre, Entwickler, Spieltype, Release,Gameplay,Grafik uvm.">
		<meta property="og:image" content="URL_to_image">
		<meta property="og:url" content="https://www.gg-game.de/favorite.php">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="GG-game.de - Game Rankings and Reviews">
		<meta name="twitter:description" content="Favoriten-Page, Wähle deine wichtigsten Spiele-Attribute Plattform, Genre, Entwickler, Spieltype, Release,Gameplay,Grafik uvm.">
		<meta name="twitter:image" content="URL_to_image">
		<link rel="canonical" href="https://www.gg-game.de/favorite.php">
	
		<title>Favoriten-Page, Wähle deine wichtigsten Spiele-Attribute Plattform, Genre, Entwickler, Spieltype, Release,Gameplay,Grafik uvm.</title>
		
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
	
		<link rel="stylesheet" type="text/css" media="only screen and (max-width: 3840px)" href="CSS/Fa3840x2160.css">
	
		<script type="text/javascript">
		var _iub = _iub || [];
		_iub.csConfiguration = {"askConsentAtCookiePolicyUpdate":true,"enableFadp":true,"enableLgpd":true,"enableTcf":true,"enableUspr":true,"fadpApplies":true,"floatingPreferencesButtonDisplay":"bottom-right","googleAdditionalConsentMode":true,"lang":"de","perPurposeConsent":true,"preferenceCookie":{"expireAfter":180},"siteId":3648320,"tcfPurposes":{"2":"consent_only","7":"consent_only","8":"consent_only","9":"consent_only","10":"consent_only","11":"consent_only"},"usprApplies":true,"whitelabel":false,"cookiePolicyId":91324499, "banner":{ "acceptButtonDisplay":true,"closeButtonDisplay":false,"customizeButtonDisplay":true,"explicitWithdrawal":true,"listPurposes":true,"ownerName":"gg-game.de","position":"bottom","rejectButtonDisplay":true,"showPurposesToggles":true,"showTitle":false,"showTotalNumberOfProviders":true }};
		</script>
		<script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3648320.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/tcf/stub-v2.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/tcf/safe-tcf-v2.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
		
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
			
			function handleBewertungButtonClick() {
				var BewertungPopup = document.getElementById('BewertungPopup');
				BewertungPopup.style.display = 'block';
				document.getElementById("overlay").style.display = "block";
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
					<div class="LINK"><a href="VS.php">VS</a></div>
					<div class="LINK"><a class="aktiv" href="favorite.php">Favoríten</a></div>
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
								<?php include('Login.php');?>
							</div>
							<!-------------------------------------------------------------------Login-Ende---------------------------------------------------------------------->
					</div>
					<div class="svg-container2">
						<div class="HelluDunkel">  
							<input type="checkbox" value="None" id="HelluDunkel" name="check" checked onclick="backColor()" />
							<label class="HelluDunkellabel" for="HelluDunkel"></label>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<main>
			<div id="MTBody">
			<?php
			require_once('Ajaxabfrage2.php');?>
			</div>
			
		<script>
			// -----------------------------Hell und Dunkelseite--start--------------------------------
			let istTag = false;
	
			function backColor() {
				istTag = !istTag;
			
				const loginButton = document.getElementById('loginButton');
	
				const navig1 = document.querySelector('.navig1');
				const Navi2 = document.querySelector('.Navi2');
				const alleAnker = document.querySelectorAll('a');
				const schalter = document.querySelector('.HelluDunkel label');
				const checkbox = document.getElementById('slideThree');
				const labelCheck = document.getElementById('labelCheck');
	
				const alleTR = document.querySelectorAll('tr');
				const alleTD = document.querySelectorAll('td');
			
				if (!istTag) {
					navig1.style.backgroundColor = 'black';
					Navi2.style.backgroundColor = 'black';
					document.body.style.backgroundColor = 'black';
					schalter.style.background = 'white';
					loginButton.style.backgroundColor = 'black';
					loginButton.style.color = 'white';
					
					alleAnker.forEach(link => {
						link.style.color = 'white';
					});
					
	
					alleParagraphen.forEach(p => {
						p.style.color = 'white'; 
					});
			
				} else {
					navig1.style.backgroundColor = 'white';
					Navi2.style.backgroundColor = 'white';
					document.body.style.backgroundColor = 'white';
					schalter.style.background = 'black';
					loginButton.style.backgroundColor = 'white';
					loginButton.style.color = 'black';
					
					alleAnker.forEach(link => {
						link.style.color = 'black';
					});
					
	
					alleParagraphen.forEach(p => {
						p.style.color = 'black'; 
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
				window.location.href = 'http://gg-game.de/favorite.php';
				location.reload();
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
			//---------------------Tabelle ordnen -------------------------------------------------------------
			// Funktion zur Überprüfung, ob ein Wert numerisch ist
			function isNumeric(value) {
				return /^\d+$/.test(value);
			}
			
			// Tabelle ordnen
			function sortTable(n) {
				var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
				table = document.getElementById("gameTable");
				switching = true;
				// Richtung der Sortierung setzen, beginnend mit aufsteigend
				dir = "asc";
				while (switching) {
					// Kein Switch wird in dieser Runde gemacht
					switching = false;
					rows = table.rows;
					// Iteriere über alle Zeilen außer die erste (Headers)
					for (i = 1; i < (rows.length - 1); i++) {
						shouldSwitch = false;
						// Holen Sie sich die beiden Elemente, die verglichen werden sollen, eins aus der aktuellen Zeile und eins aus der nächsten
						x = rows[i].getElementsByTagName("td")[n];
						y = rows[i + 1].getElementsByTagName("td")[n];
						// Überprüfen Sie, ob die beiden Zellen verglichen werden sollen, abhängig von der Richtung der Sortierung
						if (dir == "asc") {
							if (isNumeric(x.innerHTML) && isNumeric(y.innerHTML)) {
								if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
									// Markieren Sie, dass ein Switch durchgeführt werden soll, und brechen Sie die Schleife ab
									shouldSwitch = true;
									break;
								}
							} else {
								if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
									// Markieren Sie, dass ein Switch durchgeführt werden soll, und brechen Sie die Schleife ab
									shouldSwitch = true;
									break;
								}
							}
						} else if (dir == "desc") {
							if (isNumeric(x.innerHTML) && isNumeric(y.innerHTML)) {
								if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
									// Markieren Sie, dass ein Switch durchgeführt werden soll, und brechen Sie die Schleife ab
									shouldSwitch = true;
									break;
								}
							} else {
								if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
									// Markieren Sie, dass ein Switch durchgeführt werden soll, und brechen Sie die Schleife ab
									shouldSwitch = true;
									break;
								}
							}
						}
					}
					if (shouldSwitch) {
						// Wenn ein Switch durchgeführt werden soll, tauschen Sie die Zeilen und markieren Sie den Switch
						rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
						switching = true;
						// Markieren Sie, dass ein Switch durchgeführt wurde
						switchcount++;
					} else {
						// Wenn keine Schalter durchgeführt wurden und die Richtung aufsteigend ist, ändern Sie die Richtung in absteigend und beginnen Sie erneut
						if (switchcount == 0 && dir == "asc") {
							dir = "desc";
							switching = true;
						}
					}
				}
			}
			//--------------------Tabelle ordnen -------------------------------------------------------------
			//---------------------Password forget-start---------------------------------------------------------------
			function handleVergessenButtonClick() {
			
				window.location.href = "http://gg-game.de/Passwort.php";
			}
			//---------------------Password forget-end---------------------------------------------------------------
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
			//---------------------show tab change start------------------------------------------------------------			
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