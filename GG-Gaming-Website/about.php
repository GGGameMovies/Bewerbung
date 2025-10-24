<?php
	// Session-Cookies auf 2 Stunden setzen
	ini_set('session.cookie_lifetime', 7200);
	
	// Starte die Session
	session_start();
	
	// Überprüfe, ob der Benutzer angemeldet ist
	$isUsernameSet = isset($_SESSION['username']);
	$username = $isUsernameSet ? $_SESSION['username'] : null;
	
	// Überprüfe, ob diese Seite gesetzt ist, und speichere die aktuelle Seite in der Session
	if (!$isUsernameSet && !isset($_SESSION['current_page'])) {
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
	
	// Schutz vor XSS-Angriffen: Funktion zur Bereinigung von Benutzereingaben
	function clean_input($input) {
		return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
	}
	
	header("Permissions-Policy: geolocation 'self'; microphone 'none'; camera 'self';");
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Explore the top-rated games on GG-Game.de, your ultimate guide for game rankings, researches, exploring and reviews.">
		<meta name="keywords" content="Game Rankings, Game Reviews, Top Games, Best Games">
		<meta name="author" content="Daniel Gonzalez">
		<meta name="robots" content="index, follow">
		<meta property="og:title" content="GG-GameRating - Game Rankings and Reviews">
		<meta property="og:description" content="Explore the top-rated games on GG-GameRating, your ultimate guide for game rankings and reviews.">
		<meta property="og:image" content="URL_to_image">
		<meta property="og:url" content="https://www.gg-game.de">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="GG-GameRating - Game Rankings and Reviews">
		<meta name="twitter:description" content="Explore the top-rated games on GG-GameRating, your ultimate guide for game rankings and reviews.">
		<meta name="twitter:image" content="URL_to_image">
		<link rel="canonical" href="https://www.gg-game.de/about.php">
		
		<title>about-page, auf dieser Seite finden sie about me, Datenschutzerklärung und Impressum</title>
		
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
		<link rel="stylesheet" type="text/css" href="./CSS/about_3840x2160.css" media="only screen and (max-width: 3840px)">
		
	
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
		
		function handleBewertungButtonClick() {
			var BewertungPopup = document.getElementById('BewertungPopup');
			BewertungPopup.style.display = 'block';
			document.getElementById("overlay").style.display = "block";
		}

	</script>

	<header>	
		<nav class="navig1">
			<div class="LogoL">
				<div class="svg-container">
					<img src="./bilder/logotranz.png" alt="kein Bild darstellbar">
				</div>
			</div>
			<div class="LINKS">
				<div class="LINK"><a href="index.php">Willkommen</a></div>
				<div class="LINK"><a href="VS.php">VS</a></div>
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
		<div class="about">
			

		
		</div>
		<div class="Datas">
			<a href="https://www.iubenda.com/privacy-policy/91324499" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Datenschutzerklärung ">Datenschutzerklärung</a>
        	<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
			
          	<a href="https://www.iubenda.com/privacy-policy/91324499/cookie-policy" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Cookie-Richtlinie ">Cookie-Richtlinie</a>
          	<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
			
          	<br>
		</div>
		<div class="Imp">
		
			<br>
			Impressum:<br><br>
				Angaben gemäß § 5 TMG:<br><br>
				
				Daniel Gonzalez<br>
				
				Postanschrift:<br>
				Jupiterstraße. 36<br>
				Leipzig<br><br>
				
				Kontakt:<br>
				Telefon: 015252874894<br>
				E-Mail: Alphagame1988@gmail.com

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
			const alleUeberschriften = document.querySelectorAll('h1, h2, h3, h4, h5, h6'); // Auswahl aller Überschriften
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
				// Ändern der Farbe aller Überschriften auf schwarz
				alleUeberschriften.forEach(ueberschrift => {
					ueberschrift.style.color = 'black';
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
		//---------------------Login --------------------------------------------------------------			
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
		//---------------------Password forget-start---------------------------------------------------------------
		function handleVergessenButtonClick() {
		
			window.location.href = "http://gg-game.de/Passwort.php";
		}
		//---------------------Password forget-end---------------------------------------------------------------
	</script>		
	<?php
	include('Unten.php');
	?>