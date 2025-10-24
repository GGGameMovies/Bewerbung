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
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
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
		<meta name="description" content="self-page, Hier kannst du Videopiele bewerten, die noch nicht freigestellt sind und diese  für eigene Vergleiche nutzen.">
		<meta name="keywords" content="Game Rankings, Game Reviews, Top Games, Best Games">
		<meta name="author" content="Daniel Gonzalez">
		<meta name="robots" content="index, follow">
		<meta property="og:title" content="GG-game.de - Game Rankings and Reviews">
		<meta property="og:description" content="self-page, Hier kannst du Videopiele bewerten, die noch nicht freigestellt sind und diese  für eigene Vergleiche nutzen.">
		<meta property="og:image" content="URL_to_image">
		<meta property="og:url" content="https://www.gg-game.de/self.php">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="GG-game.de - Game Rankings and Reviews">
		<meta name="twitter:description" content="self-page, Hier kannst du Videopiele bewerten, die noch nicht freigestellt sind und diese  für eigene Vergleiche nutzen.">
		<meta name="twitter:image" content="URL_to_image">
		<link rel="canonical" href="https://www.gg-game.de/self.php">
	
		<title>self-page, Hier kannst du Videopiele bewerten, die noch nicht freigestellt sind und diese  für eigene Vergleiche nutzen</title>
		
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
		<link rel="stylesheet" type="text/css" media="only screen and (max-width: 3840px)" href="CSS/self3840x2160.css">
	
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
			function submitForm() {
				document.getElementById("bewertung_form").submit();
			}
			
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
				<div class="LogoL">
					<div class="svg-container">
						<img src="./bilder/logotranz.png" alt="kein Bild darstellbar">
					</div>
				</div>
				<div class="LINKS">
					<div class="LINK"><a href="index.php">Willkommen</a></div>
					<div class="LINK"><a href="VS.php">VS</a></div>
					<div class="LINK"><a href="favorite.php">Favoríten</a></div>
					<div class="LINK"><a class="aktiv" href="self.php">Self</a></div>
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
		<div id="BewertungContent">
			<h2>Bewertung eintragen</h2>
			<form id="selfSpiel" method="post">
				<h2>wähle ein Spiel</h2>
				<select id="Spiel" name="Spiel" required>
					<option value="">unbewertete Spiele</option>
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
						$sql = "SELECT SpielName FROM spiele
								WHERE Geprüft = 2 ";
						$result = mysqli_query($link, $sql);
					
						// Spiele in die Dropdown-Liste einfügen
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<option value="' . $row['SpielName'] . '">' . $row['SpielName'] . '</option>';
							}
						}
					
						// Verbindung schließen
						mysqli_close($link);
					?>
				</select>
			
				<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
				<p><label class="labelcheck" for="Gameplay">Gameplay:</label>
					<select id="Gameplay" name="Gameplay" required>
						<option value="">-</option>
						<?php for ($i = 1; $i <= 100; $i += 1): ?>
							<option value="<?php echo $i; ?>" <?php if (!empty($data['GameplayB']) && $data['GameplayB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</p><br>
				
				<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
				<p><label class="labelcheck" for="Graphic">Graphic:</label>
					<select id="Graphic" name="Graphic" required>
						<option value="">-</option>
						<?php for ($i = 1; $i <= 100; $i += 1): ?>
							<option value="<?php echo $i; ?>" <?php if (!empty($data['GraphicB']) && $data['GraphicB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</p><br>
				
				<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
				<p><label class="labelcheck" for="Story">Story:</label>
					<select id="Story" name="Story" required>
						<option value="">-</option>
						<?php for ($i = 1; $i <= 100; $i += 1): ?>
							<option value="<?php echo $i; ?>" <?php if (!empty($data['StoryB']) && $data['StoryB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</p><br>
				
				<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
				<p><label class="labelcheck" for="AI">AI:</label>
					<select id="AI" name="AI" required>
						<option value="">-</option>
						<?php for ($i = 1; $i <= 100; $i += 1): ?>
							<option value="<?php echo $i; ?>" <?php if (!empty($data['AIB']) && $data['AIB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</p><br>
				
				<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
				<p><label class="labelcheck" for="Creativity">Creativity:</label>
					<select id="Creativity" name="Creativity" required>
						<option value="">-</option>
						<?php for ($i = 1; $i <= 100; $i += 1): ?>
							<option value="<?php echo $i; ?>" <?php if (!empty($data['CreativityB']) && $data['CreativityB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</p><br>
				
				<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
				<p><label class="labelcheck" for="Immersion">Immersion:</label>
					<select id="Immersion" name="Immersion" required>
						<option value="">-</option>
						<?php for ($i = 1; $i <= 100; $i += 1): ?>
							<option value="<?php echo $i; ?>" <?php if (!empty($data['ImmersionB']) && $data['ImmersionB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</p><br>
				
				<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
				<p><label class="labelcheck" for="Sound">Sound:</label>
					<select id="Sound" name="Sound" required>
						<option value="">-</option>
						<?php for ($i = 1; $i <= 100; $i += 1): ?>
							<option value="<?php echo $i; ?>" <?php if (!empty($data['SoundB']) && $data['SoundB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
				</p><br>
				<?php 
				if(isset($_SESSION['username'])){?>
					<button type="submit" id="submitB" name="submitB" onclick="WerteButtonClick()">Bewertung eintragen</button>
				<?php
				}else{?>
					<button id="bewertungButton" >Bewerten ( Nicht registriert )</button>
				<?php }?>
			</form>
		</div>
		<!----------------------------------------------------------------------------------------------------------->
		
		<!--------------------------------------------Bewertung-Request---------------------------------------------->
		<?php 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST['submitB'])&& $_POST['Spiel']==!"") {
				$servername = 'db5015689286.hosting-data.io';
				$username = 'dbu5015410';
				$password = 'Lasombra1234!?Ionos';
				$dbname = 'dbs12804397';
			
				$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
		
				if (!$link) {
					die("Connection failed: " . mysqli_connect_error());
				}
		
				// Formulardaten sicher abrufen
				$title = $_POST['Spiel'];
				$GameplayB = (int)$_POST['Gameplay'];
				$GraphicB = (int)$_POST['Graphic'];
				$StoryB = (int)$_POST['Story'];
				$AIB = (int)$_POST['AI'];
				$CreativityB = (int)$_POST['Creativity'];
				$ImmersionB = (int)$_POST['Immersion'];
				$SoundB = (int)$_POST['Sound'];
		
				// Berechnung der durchschnittlichen Bewertung
				$Rating = ($GameplayB + $GraphicB + $StoryB + $AIB + $CreativityB + $ImmersionB + $SoundB) / 7;
		
				// Abfrage, um die SpielID zu erhalten
				$spiel_id_query = "SELECT SpielID FROM spiele WHERE SpielName = ?";
				$stmt_spiel_id = mysqli_prepare($link, $spiel_id_query);
				mysqli_stmt_bind_param($stmt_spiel_id, "s", $title);
				mysqli_stmt_execute($stmt_spiel_id);
				$result_spiel_id = mysqli_stmt_get_result($stmt_spiel_id);
				$row_spiel_id = mysqli_fetch_assoc($result_spiel_id);
				@$SpielID = $row_spiel_id['SpielID'];
		
				// Beispiel: BenutzerID manuell setzen (ersetzen Sie dies durch die tatsächliche Logik, um die BenutzerID abzurufen)
				$besucher_id_query = "SELECT BesucherID FROM besucher WHERE Benutzername = ?";
				$stmt_besucher_id = mysqli_prepare($link, $besucher_id_query);
				mysqli_stmt_bind_param($stmt_besucher_id, "s", $username);
				mysqli_stmt_execute($stmt_besucher_id);
				$result_besucher_id = mysqli_stmt_get_result($stmt_besucher_id);
				$row_besucher_id = mysqli_fetch_assoc($result_besucher_id);
				@$BesucherID = $row_besucher_id['BesucherID'];
		
				// Überprüfen, ob bereits eine Bewertung für dieses Spiel durch diesen Benutzer existiert
				$bewertung_check_query = "SELECT * FROM bewertungen WHERE SpielID = ? AND BesucherID = ?";
				$stmt_bewertung_check = mysqli_prepare($link, $bewertung_check_query);
				mysqli_stmt_bind_param($stmt_bewertung_check, "ii", $SpielID, $BesucherID);
				mysqli_stmt_execute($stmt_bewertung_check);
				$result_bewertung_check = mysqli_stmt_get_result($stmt_bewertung_check);
				
				if (mysqli_num_rows($result_bewertung_check) > 0) {
					// Wenn eine Bewertung existiert, aktualisiere sie
					$update_query = "UPDATE bewertungen SET GameplayB=?, GraphicB=?, StoryB=?, AIB=?, CreativityB=?, ImmersionB=?, SoundB=?, Rating=? WHERE SpielID=? AND BesucherID=?";
					$stmt_update = mysqli_prepare($link, $update_query);
					mysqli_stmt_bind_param($stmt_update, "iiiiiiiiii", $GameplayB, $GraphicB, $StoryB, $AIB, $CreativityB, $ImmersionB, $SoundB, $Rating, $SpielID, $BesucherID);
					mysqli_stmt_execute($stmt_update);
		
					echo "Daten erfolgreich aktualisiert!";
				} else {
					// Wenn keine Bewertung existiert, füge eine neue hinzu
					$insert = "INSERT INTO bewertungen (BesucherID, SpielID, GameplayB, GraphicB, StoryB, AIB, CreativityB, ImmersionB, SoundB, Rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					$stmt_insert = mysqli_prepare($link, $insert);
					mysqli_stmt_bind_param($stmt_insert, "iiiiiiiiii", $BesucherID, $SpielID, $GameplayB, $GraphicB, $StoryB, $AIB, $CreativityB, $ImmersionB, $SoundB, $Rating);
					mysqli_stmt_execute($stmt_insert);
		
					echo "Daten erfolgreich gespeichert!";
				}
				mysqli_close($link);
			}
		}
		?>
		<!-------------------------------------------------------------------------------------Bewertung----------------------------------------------->
		<script>
			<!--------------------------------------------------------------------VS------------------------------------------------------------------->
			<!--------------------------------------------------------------------VS-spielsuchfeld-------------------------------------------------------------->
			$(document).ready(function() {
				// Select2 initialisieren für Spiel
				$('#Spiel').select2();
	
				// Benutzereingabe erfassen für Spiel
				$('#Spiel').on('select2:open', function(e) {
					$('.select2-search__field').attr('placeholder', 'Spiel suchen');
				});
			});
			<!--------------------------------------------------------------------VS-spielsuchfeld------------------------------------------------------------------>
			
			$(document).ready(function() {
				// Select2 initialisieren für Spiel
				$('#Spiel').select2();
	
				// Platzhalter für die Suchleiste hinzufügen
				$('#Spiel').on('select2:open', function() {
					$('.select2-search__field').attr('placeholder', 'Spiel suchen');
				});
			});
			<!-----------------------------Link über namen------------------------------------------>
			function openLink(url, target) {
				if (url) {
					window.open(url, target);
				}
			}
			//------------------------------------------------------------------------------------->
		
			//-----------------------------Hell und Dunkelseite--start-------------------------------->
			let istTag = false;
			
			function backColor() {
				istTag = !istTag;
			
				const loginButton = document.getElementById('loginButton');
				//const backColorImg = document.getElementById('backColor');
				const navig1 = document.querySelector('.navig1');
				const Navi2 = document.querySelector('.Navi2');
				const alleAnker = document.querySelectorAll('a');
				const schalter = document.querySelector('.HelluDunkel label');
				const checkbox = document.getElementById('slideThree');
			
				if (!istTag) {
					//backColorImg.src = '/Bilder/Sonne.png';
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
					//backColorImg.src = '/Bilder/Mond.png';
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
			// -----------------------------Hell und Dunkelseite-ende---------------------------------->
			//---------------------Login Button --------------------------------------------------------------->		
			function handleLoginButtonClick() {
				var loginButton = document.getElementById('loginButton');
				
				if (loginButton.innerText === 'Login') {
					LoginPopupAuf();
				} else if (loginButton.innerText === 'Logout') {
					logout();
				}
			}
			//-------popup auf----------------------->
			function LoginPopupAuf() {
				document.getElementById('loginPopup').style.display = 'block';
			}
			//-------popup auf------------------------>
			//-------popup zu----------------------->
			function closeLoginPopup() {
					document.getElementById('loginPopup').style.display = 'none';
			}
			//-------popup zu------------------------>
			//---------------------Login Button --------------------------------------------------------------->	
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
			//---------------------site aktualisierung-------------------------------------------------------------->
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