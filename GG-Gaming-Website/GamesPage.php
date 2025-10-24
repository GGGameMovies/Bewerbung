<?php
	// Session-Cookies auf 2 Stunden setzen
	ini_set('session.cookie_lifetime', 7200);
	
	// Starte die Session
	session_start();
	
	// Überprüfe, ob der Benutzer angemeldet ist
	$inactive = 7200;
	
	$isUsernameSet = isset($_SESSION['username']);
	$username = $isUsernameSet ? $_SESSION['username'] : null;
	
	// Überprüfe, ob diese Seite gesetzt ist, und speichere die aktuelle Seite in der Session
	if (!$isUsernameSet && !isset($_SESSION['current_page'])) {
		$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
	}
	$_SESSION['last_activity'] = time();
	
	require_once('select_GForm.php');
	$title=filter_var($_GET["Titel"], FILTER_SANITIZE_STRING);
	$SpielID=filter_var($_GET["SpielID"], FILTER_SANITIZE_STRING);
	$Button = "on";
	$geprueft = "";
	$GameplayB = "";
	$GraphicB = "";
	$StoryB = "";
	$AIB = "";
	$CreativityB = "";
	$ImmersionB = "";
	$SoundB = "";
	$RatingB = "";
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
		<meta name="description" content="Bewertungspage, Schau dir Trailer an, Vergleiche Bewertungen in Gameplay, Grafik, Story uvm und Bewerte selbst">
		<meta name="keywords" content="Game Rankings, Game Reviews, Top Games, Best Games">
		<meta name="author" content="Daniel Gonzalez">
		<meta name="robots" content="index, follow">
		<meta property="og:title" content="GG-Game.de - Game Rankings and Reviews">
		<meta property="og:description" content="Bewertungspage, Schau dir Trailer an, Vergleiche Bewertungen in Gameplay, Grafik, Story uvm und Bewerte selbst">
		<meta property="og:image" content="URL_to_image">
		<meta property="og:url" content="https://www.gg-game.de/GamesPage.php">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="GG-game.de - Game Rankings and Reviews">
		<meta name="twitter:description" content="Announged-page Sehen sie welche Videospiele, in kürze erscheinen, welche angekündigt wurden.">
		<meta name="twitter:image" content="URL_to_image">
		<link rel="canonical" href="https://www.gg-game.de/GamesPage.php">
		
		<title>Bewertungspage, Schau dir Trailer an, Vergleiche Bewertungen in Gameplay, Grafik, Story uvm und Bewerte selbst</title>
	
		
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
	
		<link rel="stylesheet" type="text/css" media="only screen and (max-width: 3840px)" href="CSS/GamePage3840x2160.css">
		
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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
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
							<!------------------------------------------------------------------Login-start---------------------------------------------------------------------->
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
			<?php		
				// Abfrage, um die BesucherID basierend auf dem Benutzernamen zu erhalten
				$servername = '';
				$username = '';
				$password = '';
				$dbname = '';
				
				$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
			
				if ($link->connect_error) {
					die("Verbindung fehlgeschlagen: " . $link->connect_error);
				}
			
				$besucher_id_query = "SELECT BesucherID FROM besucher WHERE Benutzername = ?";
				$stmt_besucher_id = mysqli_prepare($link, $besucher_id_query);
				mysqli_stmt_bind_param($stmt_besucher_id, "s", $username);
				mysqli_stmt_execute($stmt_besucher_id);
				$result_besucher_id = mysqli_stmt_get_result($stmt_besucher_id);
				
				if ($result_besucher_id && mysqli_num_rows($result_besucher_id) > 0) {
					$row_besucher_id = mysqli_fetch_assoc($result_besucher_id);
					$BesucherID = $row_besucher_id['BesucherID'];
				
					$select_query = "SELECT * FROM bewertungen WHERE SpielID = ? AND BesucherID = ?";
					$stmt_select = mysqli_prepare($link, $select_query);
					mysqli_stmt_bind_param($stmt_select, "ii", $SpielID, $BesucherID);
					mysqli_stmt_execute($stmt_select);
					$result_select = mysqli_stmt_get_result($stmt_select);
				
					// Prüfe, ob ein Datensatz gefunden wurde
					if ($result_select && mysqli_num_rows($result_select) > 0) {
						$DatenP = "true";
						// Datensätze gefunden, fülle die Formularfelder mit den Werten
						$data = mysqli_fetch_assoc($result_select);
				
						$GameplayB = $data['GameplayB'];
						$GraphicB = $data['GraphicB'];
						$StoryB = $data['StoryB'];
						$AIB = $data['AIB'];
						$CreativityB = $data['CreativityB'];
						$ImmersionB = $data['ImmersionB'];
						$SoundB = $data['SoundB'];
						$RatingB = $data['Rating'];
					} else {
	
					}
				
					// Schließen der Statement-Objekte
					mysqli_stmt_close($stmt_select);
				} else {
				}
				
				// Schließen der Statement-Objekte
				mysqli_stmt_close($stmt_besucher_id);
				
				// Verbindung schließen
				mysqli_close($link);
				?>
				
			<!----------------------------------------------------------------------------------------->	
		
		
			<?php
				$servername = '';
				$username = '';
				$password = '';
				$dbname = '';
			
				$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
				if ($link->connect_error) {
					die("Verbindung fehlgeschlagen: " . $link->connect_error);
				}
	
				$title = mysqli_real_escape_string($link, $SpielID);
				
				$select = 'SELECT s.*, p.*
							FROM spiele s
							INNER JOIN spiel_Player sp ON s.SpielID = sp.SpielID
							INNER JOIN player p ON sp.PlayerID = p.PlayerID
							WHERE s.SpielID = ?';
				
				$stmt = $link->prepare($select);
				$stmt->bind_param("i", $SpielID);
				$stmt->execute();
				$result = $stmt->get_result();
				
				while ($data = $result->fetch_assoc()) {
					$title = '-';
					$YoutubeURL = '-';
					$Gameplay = '-';
					$Graphic = '-';
					$Story = '-';
					$AI = '-';
					$Creativity = '-';
					$Immersion = '-';
					$Sound = '-';
					$BuyPS = '-';
					$BuyPC = '-';
					$BuyXbox = '-';
					$BuyNintendo = '-';
					$Audio = '-';
					$Rating = '-';
					$Datum = '-';
					
					// Überprüfe, ob die Daten gesetzt sind, und weise sie den Variablen zu
					if (isset($data['SpielName'])) {
						$title = htmlspecialchars($data['SpielName']);
					}
					if (isset($data['YoutubeURL'])) {
						$YoutubeURL = htmlspecialchars($data['YoutubeURL']);
					}
					
					
					if (isset($data['Gameplay'])) {
						$Gameplay = htmlspecialchars($data['Gameplay']);
					}elseif ($Gameplay == "-"){
						$Gameplay = $GameplayB;
					}
					
					if (isset($data['Graphic'])) {
						$Graphic = htmlspecialchars($data['Graphic']);
					}elseif ($Graphic == "-"){
						$Graphic = $GraphicB;
					}
					
					if (isset($data['Story'])) {
						$Story = htmlspecialchars($data['Story']);
					}elseif ($Story == "-"){
						$Story = $StoryB;
					}		
					
					if (isset($data['AI'])) {
						$AI = htmlspecialchars($data['AI']);
					}elseif ($AI == "-"){
						$AI = $AIB;
					}
					
					if (isset($data['Creativity'])) {
						$Creativity = htmlspecialchars($data['Creativity']);
					}elseif ($Creativity == "-"){
						$Creativity = $CreativityB;
					}
					
					if (isset($data['Immersion'])) {
						$Immersion = htmlspecialchars($data['Immersion']);
					}elseif ($Immersion == "-"){
						$Immersion = $ImmersionB;
					}
					
					if (isset($data['Sound'])) {
						$Sound = htmlspecialchars($data['Sound']);
					}elseif ($Sound == "-"){
						$Sound = $SoundB;
					}
					
					if (isset($data['Rating'])) {
						$Rating = (float) htmlspecialchars($data['Rating']);
					} elseif ($Rating == "-") {
						$Rating = (float) $RatingB;
					}
	
	
					if (isset($data['BuyURLPS'])) {
						$BuyPS = htmlspecialchars($data['BuyURLPS']);
					}
					if (isset($data['BuyURLPC'])) {
						$BuyPC = htmlspecialchars($data['BuyURLPC']);
					}
					if (isset($data['BuyURLXbox'])) {
						$BuyXbox = htmlspecialchars($data['BuyURLXbox']);
					}
					if (isset($data['BuyURLNintendo'])) {
						$BuyNintendo = htmlspecialchars($data['BuyURLNintendo']);
					}
					if (isset($data['Audio'])) {
						$Audio = htmlspecialchars($data['Audio']);
					}
					if (isset($data['Datum'])) {
						$Datum = htmlspecialchars($data['Datum']);
						$formatiertesDatum = date('d-m-Y', strtotime($Datum));
					}
					if (isset($data['Geprüft'])) {
						$geprueft = htmlspecialchars($data['Geprüft']);
					}
					$playerArray[] = htmlspecialchars($data['PlayerName']);
					$playerArrayLength = count($playerArray);
	
					// Weitere Verarbeitung des Datenarrays hier...
				}
				$stmt->close();
			?>
			
			<div class="youtube">
				<div class="youtubeGP">
					<iframe class="youtubevideo2" src="https://www.youtube-nocookie.com/embed/<?php echo $YoutubeURL;?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<div class="ElogoR">
					
				</div>
			</div>
			
			<div id="Black" >
				<div class="GameBoxAus1">
					<div class="GameBox1">
						<div class="Titel">					
							<h4><?php echo $title?></h4>
						</div>
					</div>
					<div class="GameBox2">
							<div class="Bildericon">
								<?php if (!empty($BuyPS)): ?>
									<img src="/Bilder/PS/Playstation.png" alt="Icon 1" onclick="openLink('<?php echo $BuyPS ?>')" target="_blank">
								<?php endif; ?>
								
								<?php if (!empty($BuyXbox)): ?>
									<img src="/Bilder/PS/Xbox.png" alt="Icon 2" onclick="openLink('<?php echo $BuyXbox ?>')" target="_blank">
								<?php endif; ?>
								
								<?php if (!empty($BuyPC)): ?>
									<img src="/Bilder/PS/PC.png" alt="Icon 3" onclick="openLink('<?php echo $BuyPC ?>')" target="_blank">
								<?php endif; ?>
								
								<?php if (!empty($BuyNintendo)): ?>
									<img src="/Bilder/PS/Nintendo.png" alt="Icon 4" onclick="openLink('<?php echo $BuyNintendo ?>')" target="_blank">
								<?php endif; ?>
							</div>
					</div>
				</div>
				<div class="GameBoxAus2">
					<div class="GameBox3">
						<div class="Titel">
							<h1><?php echo $Gameplay?>%</h1>
							<h2>Gameplay</h2>
						</div>
					</div>
					<div class="GameBox4">
						<div class="Titel">
							<h1><?php echo $Graphic?>%</h1>
							<h2>Graphic</h2>
						</div>
					</div>
					<div class="GameBox5">
						<div class="Titel">
							<h1><?php echo $Story?>%</h1>
							<h2>Story</h2>
						</div>
					</div>
					<div class="GameBox6">
						<div class="Titel">
							<h1><?php echo $AI?>%</h1>
							<h2>AI</h2>
						</div>
					</div>
				</div>
				<div class="GameBoxAus4">
					<div class="GameBox7">
						<div class="Titel">
							<h1><?php echo $Creativity?>%</h1>
							<h2>Creativity</h2>
						</div>
					</div>
					<div class="GameBox8">
						<div class="Titel">
							<h1><?php echo $Immersion?>%</h1>
							<h2>Immersion</h2>
						</div>
					</div>
					<div class="GameBox9">
						<div class="Titel">
							<h1><?php echo $Sound?>%</h1>
							<h2>Sound</h2>
						</div>
					</div>
				</div>
				<div class="GameBoxAus3">
					<div class="GameBox10">
						<div class="Titel">
							<h1><?php if (!$Rating) { echo round($Rating); } else { echo $Rating; } ?>%</h1>
							<h2>Rating</h2>
						</div>
					</div>
				</div>
				<div class="GameBoxAus4">
					<div class="GameBox7">
						<div class="Titel">
							<h2>Player</h2>
							<h5>
								<?php for ($i = 0; $i < $playerArrayLength; $i++) {
								echo '<h5>' . $playerArray[$i] . '</h5>';
								}?>
							</h5>
						</div>
					</div>
					<div class="GameBox8">
						<div class="Titel">
							<h2>Release</h2>						
							<h5><?php echo $formatiertesDatum?></h5>
						</div>
					</div>
					<div class="GameBox9">
						<div class="Titel">
							<h2>Audio</h2>
							<h5><?php echo $Audio?></h5>
						</div>
					</div>
				</div>
			</div>
			<?php mysqli_close($link);?>
			
			<!----------------------------------------------------------------------------------------->
			<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
			
			<?php
				$servername = '';
				$username = '';
				$password = '';
				$dbname = '';
			
				$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
				$DatenP = "false";
				
				// Abfrage, um die BesucherID basierend auf dem Benutzernamen zu erhalten
				$besucher_id = "SELECT BesucherID FROM besucher WHERE Benutzername = ?";
				$stmt_besucher_id = mysqli_prepare($link, $besucher_id);
				mysqli_stmt_bind_param($stmt_besucher_id, "s", $username);
				mysqli_stmt_execute($stmt_besucher_id);
				$result_besucher_id = mysqli_stmt_get_result($stmt_besucher_id);
				
				if ($result_besucher_id && mysqli_num_rows($result_besucher_id) > 0) {
					$row_besucher_id = mysqli_fetch_assoc($result_besucher_id);
					$BesucherID = $row_besucher_id['BesucherID'];
				
					$select = "SELECT * FROM bewertungen WHERE SpielID = ? And BesucherID = ?";
					$stmt_select = mysqli_prepare($link, $select);
					mysqli_stmt_bind_param($stmt_select, "ii", $SpielID, $BesucherID);
					mysqli_stmt_execute($stmt_select);
					$result_select = mysqli_stmt_get_result($stmt_select);
				
					// Prüfe, ob ein Datensatz gefunden wurde
					if ($result_select && mysqli_num_rows($result_select) > 0) {
						$DatenP = "true";
						// Datensätze gefunden, fülle die Formularfelder mit den Werten
						$data = mysqli_fetch_assoc($result_select);
						?>
						<script>
							$(document).ready(function(){
								// Fülle die Formularfelder mit den abgerufenen Daten, falls vorhanden
								<?php if (!empty($data['GameplayB'])): ?>
									$('.Gameplay').val(<?php echo json_encode(htmlentities($data['GameplayB'])); ?>);
								<?php endif; ?>
								<?php if (!empty($data['GraphicB'])): ?>
									$('.Graphic').val(<?php echo json_encode(htmlentities($data['GraphicB'])); ?>);
								<?php endif; ?>
								<?php if (!empty($data['StoryB'])): ?>
									$('.Story').val(<?php echo json_encode(htmlentities($data['StoryB'])); ?>);
								<?php endif; ?>
								<?php if (!empty($data['AIB'])): ?>
									$('.AI').val(<?php echo json_encode(htmlentities($data['AIB'])); ?>);
								<?php endif; ?>
								<?php if (!empty($data['CreativityB'])): ?>
									$('.Creativity').val(<?php echo json_encode(htmlentities($data['CreativityB'])); ?>);
								<?php endif; ?>
								<?php if (!empty($data['ImmersionB'])): ?>
									$('.Immersion').val(<?php echo json_encode(htmlentities($data['ImmersionB'])); ?>);
								<?php endif; ?>
								<?php if (!empty($data['SoundB'])): ?>
									$('.Sound').val(<?php echo json_encode(htmlentities($data['SoundB'])); ?>);
								<?php endif; ?>
							});
						</script>
					<?php
					}
				}
			?>
			<?php 
				if(isset($_SESSION['username'])) {
					if($geprueft == 0) {
						echo '<button id="bewertungButton">Bewerten (Spiel nicht released)</button>';
					} else {
						echo '<button id="bewertungButton" onclick="handleBewertungButtonClick()">Hier Bewerten</button>';
						echo '<div id="BewertungPopup">';
						include('Bewertung.php');
						echo '<button onclick="closeBewertungPopup()">Schließen</button>';
						echo '</div>';
					}
				} else {
					echo '<button id="bewertungButton">Bewerten (Nicht registriert)</button>';
				}
			?>
	
			<!----------------------------------------------------------------------------------------->
			<div id="disqus_thread"></div>
	
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
					}
				}
				// -----------------------------Hell und Dunkelseite-ende----------------------------------
				//-----------------------------Link über namen------------------------------------------
					function openLink(url, target) {
						if (url) {
							window.open(url, target);
						}
					}
				
				//---------------------Login Button start-------------------------------			
				//---------------------Buttontext ändern---------------------
				function handleLoginButtonClick() {
					var loginButton = document.getElementById('loginButton');
					
					if (loginButton.innerText === 'Login') {
						LoginPopupAuf();
					} else if (loginButton.innerText === 'Logout') {
						logout();
					}
				}
		
				//---------------------Buttontext ändern---------------------
				//-------popup auf-----------------------
				function LoginPopupAuf() {
					document.getElementById('loginPopup').style.display = 'block';
				}
				//-------popup auf------------------------
				//-------popup zu-----------------------
				function closeLoginPopup() {
						header("Location: " . $_SERVER['PHP_SELF']);
				}
				//-------popup zu------------------------
				//---------------------Login Button ende---------------------------------
				
				//---------------------Bewertung Button start----------------------------	
				function closeBewertungPopup() {
					window.location.href = 'http://gg-game.de/GamesPage.php?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo $title; ?>';
					document.getElementById('BewertungPopup').style.display = 'none';
					document.getElementById("overlay").style.display = "none";
				}
				
				//---------------------werte Button--------------------------------
				function WerteButtonClick() {
					var buttonText = document.getElementById("submit_bewertung").innerText;
					document.getElementById("button_text").value = buttonText;
				}
		
		
				//---------------------BewertungButton ende--------------------------------
				
				//-----------------------------------logout-start--------------------------
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
							const redirectUrl = previousPage ? previousPage : 'http://gg-game.de/GamesPage.php?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo $title; ?>';
							// Weiterleitung nach 1 Sekunden
							setTimeout(function() {
								window.location.href = redirectUrl;
							}, 500);
						} else {
							// Fehlerbehandlung und Weiterleitung nach 1 Sekunden
							const redirectUrl = 'http://gg-game.de/GamesPage.php?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo $title; ?>';
							setTimeout(function() {
								window.location.href = redirectUrl;
								alert('Logout fehlgeschlagen');
							}, 500);
						}
					})
					.catch(error => {
						console.error('Error during logout:', error);
					});
				}
				//---------------------logout-ende---------------------------------------------------------------
				//---------------------disqus-start---------------------------------------------------------------
				/**
				*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
				*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
				/*
				var disqus_config = function () {
				this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
				this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
				};
				*/
				(function() { // DON'T EDIT BELOW THIS LINE
					var d = document, s = d.createElement('script');
					s.src = 'https://gg-game-de.disqus.com/embed.js';
					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
				})();
					
				//---------------------disqus-ende---------------------------------------------------------------	
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
			<noscript>
				Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
			</noscript>
		</main>
			<script id="dsq-count-scr" src="//gg-game-de.disqus.com/count.js" async></script>
<?php
include('Unten.php');
?>	

