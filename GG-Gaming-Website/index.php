<?php
	// Schutz vor XSS-Angriffen: Funktion zur Bereinigung von Benutzereingaben
	function clean_input($input) {
		return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
	}
	
	// Session-Cookies auf 2 Stunden setzen
	ini_set('session.cookie_lifetime', 7200);
	
	// Starte die Session
	session_start();
	
	// Überprüfe, ob der Benutzer angemeldet ist
	$isUsernameSet = isset($_SESSION['username']);
	$username = $isUsernameSet ? $_SESSION['username'] : null;
	
	// Überprüfe, ob die vorherige Seite gesetzt ist, und speichere die aktuelle Seite in der Session
	if (!$isUsernameSet && !isset($_SESSION['previous_page'])) {
		$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
	}
	
	// Timeout-Handling
	$inactive = 7200; // 2 Stunden Inaktivität
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive)) {
		// Die Session ist abgelaufen, also logge den Benutzer aus
		session_unset();     // löscht alle Session-Variablen
		session_destroy();   // löscht die Session
		// Optional: Weiterleitung auf eine Logout-Seite oder eine andere Seite
		header("Location: logout.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="de">
	<head>
	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Startseite Sehen sie welche Videospiele, aktuell erschienen sind und bald erscheinen werden, bleib informiert und verpasse nichts.">
		<meta name="keywords" content="Game Rankings, Game Reviews, Top Games, Best Games">
		<meta name="author" content="Daniel Gonzalez">
		<meta name="robots" content="index, follow">
		<meta property="og:title" content="GG-game.de - Game Rankings and Reviews">
		<meta property="og:description" content="Startseite Sehen sie welche Videospiele, aktuell erschienen sind und bald erscheinen werden, bleib informiert und verpasse nichts.">
		<meta property="og:image" content="URL_to_image">
		<meta property="og:url" content="https://www.gg-game.de/index.php">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="GG-game.de - Game Rankings and Reviews">
		<meta name="twitter:description" content="Startseite Sehen sie welche Videospiele, aktuell erschienen sind und bald erscheinen werden, bleib informiert und verpasse nichts.">
		<meta name="twitter:image" content="URL_to_image">
		<link rel="canonical" href="https://www.gg-game.de/index.php">
		
		<title>Startseite Sehen sie welche Videospiele, aktuell erschienen sind und bald erscheinen werden, bleib informiert und verpasse nichts</title>
		
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
		
		<link rel="stylesheet" type="text/css" href="./CSS/index_3840x2160.css" media="only screen and (max-width: 3840px)">
		
	
		<script type="text/javascript">
		var _iub = _iub || [];
		_iub.csConfiguration = {"askConsentAtCookiePolicyUpdate":true,"enableFadp":true,"enableLgpd":true,"enableTcf":true,"enableUspr":true,"fadpApplies":true,"floatingPreferencesButtonDisplay":"bottom-right","googleAdditionalConsentMode":true,"lang":"de","perPurposeConsent":true,"preferenceCookie":{"expireAfter":180},"siteId":3648320,"tcfPurposes":{"2":"consent_only","7":"consent_only","8":"consent_only","9":"consent_only","10":"consent_only","11":"consent_only"},"usprApplies":true,"whitelabel":false,"cookiePolicyId":91324499, "banner":{ "acceptButtonDisplay":true,"closeButtonDisplay":false,"customizeButtonDisplay":true,"explicitWithdrawal":true,"listPurposes":true,"ownerName":"gg-game.de","position":"bottom","rejectButtonDisplay":true,"showPurposesToggles":true,"showTitle":false,"showTotalNumberOfProviders":true }};
		</script>
		<script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3648320.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/tcf/stub-v2.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/tcf/safe-tcf-v2.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
		<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
	
		<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
		<script src="https://apis.google.com/js/platform.js"></script>
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
			//--------------------------------------------------------------------------------------------------------
		</script>
		<header>	 
			<nav class="navig1">
				<div class="LogoL">
					<div class="svg-container">
						<img src="./bilder/logotranz.png" alt="kein Bild darstellbar">
					</div>
				</div>
				<div class="LINKS">
					<div class="LINK" ><a class="aktiv" href="index.php">Willkommen</a></div>
					<div class="LINK" ><a href="VS.php">VS</a></div>
					<div class="LINK" ><a href="favorite.php">Favoríten</a></div>
					<div class="LINK" ><a href="self.php">Self</a></div>
					<div class="LINK" ><a href="Angekündigt.php">Announced</a></div>
	
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
			<div class="Sliders">
			<!-- slider neuespiele -->
				<ul class='NeueSpiele'>
					<?php
						$servername = '';
						$username = '';
						$password = '';
						$dbname = '';
			
						$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
						
						$select =   'SELECT *
										FROM spiele
										WHERE Datum <= CURRENT_DATE AND (Geprüft = 1 OR (Geprüft = 2))
										ORDER BY Datum DESC
										LIMIT 5';
						$query = mysqli_query($link, $select);
						
						while($data = mysqli_fetch_array($query)){
							
							$SpielID=		htmlentities($data['SpielID']);
							$title=			htmlentities($data['SpielName']); 
							$Description=	htmlentities($data['Beschreibung']);
							$Rating=		htmlentities($data['Rating']);
							$Logo=			htmlentities($data['Logo']);
							$Bild=			htmlentities($data['Orte']);
							$BuyPS=			htmlentities($data['BuyURLPS']);
							$BuyPC=			htmlentities($data['BuyURLPC']);
							$BuyXbox=		htmlentities($data['BuyURLXbox']);
							$BuyNintendo=	htmlentities($data['BuyURLNintendo']);
							$Datum=			htmlentities($data['Datum']);				
							if (!empty($Release)) {
								$formatiertesDatum = date('d-m-Y', strtotime($Release));
							}
	
							echo '<li class="item" style="background-image: url(\'' . $Bild . '\')">';
							echo '<h1> Neue Spiele </h1>';
							echo '<div class="content">';
							echo '<img class="LOGO" src="'.$Logo.'" alt="Icon">';
							echo '<br><p class="description">' . $Description . '</p><br>';
							echo '<a target="_blank" href="GamesPage.php?SpielID=' . $SpielID . '&Titel=' . htmlentities($data['SpielName']) . '"><button class="Buttoneffekt">Bewerten</button></a>';
							echo '<div class="Bildericon">';
							echo '<h3>';
							
							if (!empty($BuyPS)) {
								echo '<img src="/Bilder/PS/Playstation.png" alt="Icon 1" onclick="openLink(\'' . $BuyPS . '\')" target="_blank">';
							}
							
							if (!empty($BuyXbox)) {
								echo '<img src="/Bilder/PS/Xbox.png" alt="Icon 2" onclick="openLink(\'' . $BuyXbox . '\')" target="_blank">';
							}
							
							if (!empty($BuyPC)) {
								echo '<img src="/Bilder/PS/PC.png" alt="Icon 3" onclick="openLink(\'' . $BuyPC . '\')" target="_blank">';
							}
							
							if (!empty($BuyNintendo)) {
								echo '<img src="/Bilder/PS/Nintendo.png" alt="Icon 4" onclick="openLink(\'' . $BuyNintendo . '\')" target="_blank">';
							}
							
							echo '</h3>';
							echo '</div>';
							echo '</div>';
							echo '</li>';
						}  mysqli_close($link);
					?>
				</ul>
				<nav class='nav'>
					<ion-icon class='btn prev' name="arrow-back-outline"></ion-icon>
					<ion-icon class='btn next' name="arrow-forward-outline"></ion-icon>
				</nav>
				
				<div class="Luecke"></div>
				
					<!-- slider Bald Erscheinend -->
				<ul class='Bald'>
					<?php
						$servername = '';
						$username = '';
						$password = '';
						$dbname = '';
				
						$link2 = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query");
						
						$select2 =  'SELECT *
									FROM spiele
									WHERE Datum > CURRENT_DATE AND Geprüft = 0
									ORDER BY Datum ASC
									LIMIT 5';
						$query2 = mysqli_query($link2, $select2);
						
						while($data = mysqli_fetch_array($query2)){
							
							$SpielID=		htmlentities($data['SpielID']);
							$title=			htmlentities($data['SpielName']); 
							$Release=		htmlentities($data['Datum']);
							$Description=	htmlentities($data['Beschreibung']);
							$Logo=			htmlentities($data['Logo']);
							$Bild=			htmlentities($data['Orte']);
							$BuyPS=			htmlentities($data['BuyURLPS']);
							$BuyPC=			htmlentities($data['BuyURLPC']);
							$BuyXbox=		htmlentities($data['BuyURLXbox']);
							$BuyNintendo=	htmlentities($data['BuyURLNintendo']);
							if (!empty($Release)) {
								$formatiertesDatum = date('d-m-Y', strtotime($Release));
							}
		
							echo '<li class="item2" style="background-image: url(\'' . $Bild . '\')">';
							echo '<h1> Bald Erscheinend </h1>';
							echo '<div class="content2">';
							echo '<img class="LOGO2" src="'.$Logo.'" alt="Icon">';
							echo '<br><p class="description2">' . $Description .'</p></br>';
							echo '<br><p class="description2">' . 'Release:  '  .$formatiertesDatum. '</p>';
							echo '<a target="_blank" href="GamesPage.php?SpielID=' . $SpielID . '&Titel=' . htmlentities($data['SpielName']) . '"><button class="Buttoneffekt">Trailer</button></a>';
							echo '<div class="Bildericon2">';
							echo '<h4>';
							
							if (!empty($BuyPS)) {
								echo '<img src="/Bilder/PS/Playstation.png" alt="Icon 1" onclick="openLink(\'' . $BuyPS . '\')" target="_blank">';
							}
							
							if (!empty($BuyXbox)) {
								echo '<img src="/Bilder/PS/Xbox.png" alt="Icon 2" onclick="openLink(\'' . $BuyXbox . '\')" target="_blank">';
							}
							
							if (!empty($BuyPC)) {
								echo '<img src="/Bilder/PS/PC.png" alt="Icon 3" onclick="openLink(\'' . $BuyPC . '\')" target="_blank">';
							}
							
							if (!empty($BuyNintendo)) {
								echo '<img src="/Bilder/PS/Nintendo.png" alt="Icon 4" onclick="openLink(\'' . $BuyNintendo . '\')" target="_blank">';
							}
							
							echo '</h4>';
							echo '</div>';
							echo '</div>';
							echo '</li>';
						}  mysqli_close($link2);
					?>
				</ul>
				<nav class='nav2'>
					<ion-icon class='btn prev' name="arrow-back-outline"></ion-icon>
					<ion-icon class='btn next' name="arrow-forward-outline"></ion-icon>
				</nav>
			</div>
		</main>
	
		<script>
			// Funktion zum Wechseln zwischen Login und Registrierung
			function showTab(tabName) {
				document.getElementById('loginContent').style.display = tabName === 'login' ? 'block' : 'none';
				document.getElementById('registerContent').style.display = tabName === 'register' ? 'block' : 'none';
			
				// Ändere den Tab-Stil
				document.getElementById('loginTab').classList.toggle('active', tabName === 'login');
				document.getElementById('registerTab').classList.toggle('active', tabName === 'register');
			}
			
			// -----------------------------Hell und Dunkelseite--start--------------------------------
			let istTag = false;
			
			function backColor() {
				istTag = !istTag;
			
				const loginButton = document.getElementById('loginButton');
				const navig1 = document.querySelector('.navig1');
				const Navi2 = document.querySelector('.Navi2');
				const alleAnker = document.querySelectorAll('a');
				const alleParagraphen = document.querySelectorAll('p');
				const alleUeberschriften = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
				const schalter = document.querySelector('.HelluDunkel label');
			
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
					// Ändern der Farbe aller Überschriften auf schwarz
					alleUeberschriften.forEach(ueberschrift => {
						ueberschrift.style.color = 'white';
					});
			
					// Ändern der Farbe aller <p>-Elemente auf schwarz
					alleParagraphen.forEach(p => {
						p.style.color = 'white';
					});
			
					// Ändern der Farbe aller <h1>-Elemente auf schwarz
					alleUeberschriften.forEach(h1 => {
						h1.style.color = 'white';
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
			
					// Ändern der Farbe aller <p>-Elemente auf weiß
					alleParagraphen.forEach(p => {
						p.style.color = 'black'; 
					});
			
					// Ändern der Farbe aller <h1>-Elemente auf weiß
					alleUeberschriften.forEach(h1 => {
						h1.style.color = 'black'; 
					});
				}
			}
			// -----------------------------Hell und Dunkelseite-ende----------------------------------
			//---------------------------------Link über namen------------------------------------------------
				function openLink(url, target) {
					if (url) {
						window.open(url, target);
					}
				}
			//-----------------------------------Link über namen----------------------------------------------	
			//-------------------------------Slider Funktionalität und Contentfüllung-----------------------------
			document.addEventListener("DOMContentLoaded", function () {
				const NeueSpiele = document.querySelector('.NeueSpiele');
			
				function activateSlider1(e) {
					const items = document.querySelectorAll('.item');
					if (e.target.matches('.nav .next')) {
						NeueSpiele.append(items[0]);
					} else if (e.target.matches('.nav .prev')) {
						NeueSpiele.prepend(items[items.length - 1]);
					}
				}
			
				document.querySelector('.nav').addEventListener('click', activateSlider1, false);
			
				const Bald = document.querySelector('.Bald');
			
				function activateSlider2(e) {
					const items2 = document.querySelectorAll('.item2');
					if (e.target.matches('.nav2 .next')) {
						Bald.append(items2[0]);
					} else if (e.target.matches('.nav2 .prev')) {
						Bald.prepend(items2[items2.length - 1]);
					}
				}
			
				document.querySelector('.nav2').addEventListener('click', activateSlider2, false);
			//---------------------Login --------------------------------------------------------------			
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
			//-------------------------------Slider Funktionalität und Contentfüllung-----------------------------
			//---------------------Login Button ---------------------------------------------------------------			
			function handleLoginButtonClick() {
				var loginButton = document.getElementById('loginButton');
				
				if (loginButton.innerText === 'Login') {
					LoginPopupAuf();
				} else if (loginButton.innerText === 'Logout') {
					logout();
				}
			}
			//-------popup open-----------------------
			function LoginPopupAuf() {
				document.getElementById('loginPopup').style.display = 'block';
				document.getElementById('under').style.display = 'block';
			}
			//-------popup open------------------------
			//-------popup close-----------------------
			function closeLoginPopup() {
					document.getElementById('loginPopup').style.display = 'none';
					document.getElementById('under').style.display = 'none';
			}
			//-------popup close------------------------
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
			//---------------------Password forget-start---------------------------------------------------------------
			function handleVergessenButtonClick() {
			
				window.location.href = "http://gg-game.de/Passwort.php";
			}
			//---------------------Password forget-end---------------------------------------------------------------
			//---------------------logout-ende---------------------------------------------------------------
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
		</script>		
<?php
include('Unten.php');
?>