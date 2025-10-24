<?php
	// Datenbankverbindung öffnen
	$servername = '';
	$username = '';
	$password = '';
	$dbname = '';
			
	$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query");
?>

<!-- Tabs für Login und Registrierung -->
<div class="tab active" onclick="showTab('login')" id="loginTab">Login</div>
<div class="tab hidden" onclick="showTab('register')" id="registerTab">Registrieren</div>    

<div id="loginContent">
    <h3>Login</h3>
    <form method="post">
        <label for="loginUsername">Benutzername:</label>
        <input type="text" id="loginUsername" name="loginUsername" required autocomplete="username">
    
        <label for="loginPassword">Passwort:</label>
        <input type="password" id="loginPassword" name="loginPassword" required autocomplete="current-password">
    
        <button type="submit">Login</button>
    </form>
    <button id="vergessen" onclick="handleVergessenButtonClick()">Passwort vergessen</button>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    // Zugriff auf die Formulardaten
    $inputUsername = $_POST['loginUsername'];
  	$inputUsername = strtolower($inputUsername);
    $rohes_passwort = $_POST['loginPassword'];

    // Vorbereitung der SQL-Abfrage
    $sql = "SELECT * FROM besucher WHERE Benutzername = ?";
    $stmt = mysqli_prepare($link, $sql);
    
    if (!$stmt) {
        die('SQL-Abfrage fehlgeschlagen: ' . mysqli_error($link));
    }
    
    // Binden der Parameter
    mysqli_stmt_bind_param($stmt, "s", $inputUsername);
    
    // Ausführen der vorbereiteten Abfrage
    mysqli_stmt_execute($stmt);

    // Ergebnisse abrufen
    $result = mysqli_stmt_get_result($stmt);
    
    // Benutzer überprüfen
    if ($user = mysqli_fetch_assoc($result)) {
        // Passwort überprüfen
        if (password_verify($rohes_passwort, $user['Passwort'])) {
            // Überprüfen, ob das Konto aktiviert ist
            if ($user['Bgeprueft'] == 1) {
					// Benutzer erfolgreich eingeloggt
					$_SESSION['logged_in'] = true;
					$_SESSION['username'] = $inputUsername;
					$loginFailed = false;
					echo "success"; // Signalisiere, dass der Login-Vorgang erfolgreich war
					echo "<script type='text/javascript'>
							function LoginButtonText(newText) {
								document.getElementById('loginButton').innerText = newText;
							}
							LoginButtonText('Logout');
							</script>";
					echo "<script type='text/javascript'> closeLoginPopup();</script>";
				} elseif ($user['Bgeprueft'] == 0) {
					// Falscher Benutzername oder Passwort
					echo "Activation link not confirmed";
                    $loginFailed = 'true';
				} else {
					// Falscher Benutzername oder Passwort
					echo "fail not Data";
                    $loginFailed = 'true';
				} ?><script> window.location.href = '<?php echo $seite ?>?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo $title; ?>';</script><?php
			}
	
			// Statement und Ergebnis schließen
			mysqli_stmt_close($stmt);
			mysqli_free_result($result);
		} 
		else {
			echo "Debugging: POST vorhanden, aber nicht alle Daten.";
			echo "<script>console.log('Debugging: POST-Daten vorhanden, aber nicht alle erforderlichen Daten gesendet wurden.');</script>";
		}
}
// Datenbankverbindung schließen
mysqli_close($link);
?>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------>

<!-- Registrierungsformular -->
<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

?>
<div id="registerContent">
    <h3>Registrieren</h3>
    <form method="post">
        <label for="registerEmail">E-Mail:</label>
        <input type="email" id="registerEmail" name="registerEmail" required>
    
        <label for="registerUsername">Benutzername:</label>
        <input type="text" id="registerUsername" name="registerUsername" required>
    
        <label for="registerPassword">Passwort (mindestens 6 Zeichen):</label>
        <input type="password" id="registerPassword" name="registerPassword" minlength="6" required>
    
        <button type="submit">Registrieren</button>
    </form>
</div>
<?php
	// Datenbankverbindung öffnen
		$servername = '';
		$username = '';
		$password = '';
		$dbname = '';
		
	$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query");
	$benutzername = ""; $email = "";

	// Überprüfen, ob das Registrierungsformular gesendet wurde
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registerUsername']) && isset($_POST['registerEmail']) && isset($_POST['registerPassword'])) {
		// Benutzereingaben filtern und validieren
		$benutzername = mysqli_real_escape_string($link, $_POST['registerUsername']);
		$benutzername = strtolower($benutzername);
		$email = filter_var($_POST['registerEmail'], FILTER_VALIDATE_EMAIL);
		$email = strtolower($email);
		if (!$email) {
			die("Ungültige E-Mail-Adresse.");
		}
		
		$rohes_passwort = $_POST['registerPassword'];
		if (strlen($rohes_passwort) < 6) {
			die("Das Passwort muss mindestens 6 Zeichen lang sein.");
		}
		$passwort_hash = password_hash($rohes_passwort, PASSWORD_BCRYPT);
		
		// Überprüfen, ob die E-Mail-Adresse bereits existiert
		$check_query = "SELECT * FROM besucher WHERE Email = ?";
		$check_stmt = mysqli_prepare($link, $check_query);
		mysqli_stmt_bind_param($check_stmt, "s", $email);
		mysqli_stmt_execute($check_stmt);
		$check_result = mysqli_stmt_get_result($check_stmt);
		
		if (mysqli_num_rows($check_result) > 0) {
			die('Die E-Mail-Adresse existiert bereits.');
		} 
		
		// Benutzer in der Datenbank speichern
		$insert_query = "INSERT INTO besucher (Benutzername, Passwort, Email, Bgeprueft) VALUES (?, ?, ?, 0)";
		$insert_stmt = mysqli_prepare($link, $insert_query);
		mysqli_stmt_bind_param($insert_stmt, "sss", $benutzername, $passwort_hash, $email);
		mysqli_stmt_execute($insert_stmt);
		
		// Abrufen der zuletzt eingefügten BesucherID
		$besucher_id = mysqli_insert_id($link);
		
		// Generieren Sie einen sicheren Aktivierungscode
		$aktivierungscode = bin2hex(random_bytes(16));
		
		// Aktivierungslink erstellen
		$aktivierungslink = "https://gg-game.de/activate.php?code=" . $aktivierungscode . "&bn=" . $benutzername . "&id=" . $besucher_id;
		
		// Aktivierungscode in die Datenbank speichern
		$insert_code_query = "UPDATE besucher SET Pruefcode = ? WHERE Email = ?";
		$insert_code_stmt = mysqli_prepare($link, $insert_code_query);
		mysqli_stmt_bind_param($insert_code_stmt, "ss", $aktivierungscode, $email);
		mysqli_stmt_execute($insert_code_stmt);
		
		// Fehlerbehandlung
		if(mysqli_affected_rows($link) > 0){
			$debug = true;
			// E-Mail mit Aktivierungslink versenden
			try {
				// Instanz der PHPMailer-Klasse erstellen
				$mail = new PHPMailer();
		
				if ($debug) {
					// gibt einen ausführlichen log aus
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				}
		
				$mail->isSMTP();
				$mail->SMTPAuth   = true;
				$mail->Host       = 'smtp.ionos.de';
				$mail->Port       = 465; // Standardport
				$mail->Username   = 'activate@gg-game.de';
				$mail->Password   = 'Lasombra1234!?Ionos';
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Verschlüsselung
				$mail->setFrom('activate@gg-game.de', 'GG-Game');
				$mail->addAddress($email, $benutzername);
		
				$mail->CharSet = 'UTF-8';
				$mail->Encoding = 'base64';
		
				$mail->isHTML(true);  // Set email format to HTML
				$mail->Subject = 'Aktivierungsmail';
				$mail->Body    = 'Hi '.$benutzername . '<br>' . '<br>' .' Dies ist ihr Aktivierungslink'.' '.$aktivierungslink ;
		
				if(!$mail->send()) {
					// Wenn Port 465 nicht funktioniert, ändere auf Port 587 und STARTTLS
					$mail->Port = 587;
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->send();
				}
		
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: ".$e->getMessage();
			}
			// Prepared Statement für das Einfügen von Benutzerdaten schließen
			mysqli_stmt_close($insert_stmt);
		} else {
			echo "<script>console.log('Fehler beim Registrieren des Benutzers.');</script>";
		}
	}
	// Datenbankverbindung schließen
	mysqli_close($link);
?>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------>

<?php
	// Datenbankverbindung öffnen
	$servername = '';
	$username = '';
	$password = '';
	$dbname = '';
		
	$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query");
	$benutzername = ""; $email = "";

	// Überprüfen, ob das Registrierungsformular gesendet wurde
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registerUsername']) && isset($_POST['registerEmail']) && isset($_POST['registerPassword'])) {
		// Benutzereingaben filtern und validieren
		$benutzername = mysqli_real_escape_string($link, $_POST['registerUsername']);
		$benutzername = strtolower($benutzername);
		$email = filter_var($_POST['registerEmail'], FILTER_VALIDATE_EMAIL);
		$email = strtolower($email);
		if (!$email) {
			die("Ungültige E-Mail-Adresse.");
		}
		
		$rohes_passwort = $_POST['registerPassword'];
		if (strlen($rohes_passwort) < 6) {
			die("Das Passwort muss mindestens 6 Zeichen lang sein.");
		}
		$passwort_hash = password_hash($rohes_passwort, PASSWORD_BCRYPT);
		
		// Überprüfen, ob die E-Mail-Adresse bereits existiert
		$check_query = "SELECT * FROM besucher WHERE Email = ?";
		$check_stmt = mysqli_prepare($link, $check_query);
		mysqli_stmt_bind_param($check_stmt, "s", $email);
		mysqli_stmt_execute($check_stmt);
		$check_result = mysqli_stmt_get_result($check_stmt);
		
		if (mysqli_num_rows($check_result) > 0) {
			die('Die E-Mail-Adresse existiert bereits.');
		} 
		
		// Benutzer in der Datenbank speichern
		$insert_query = "INSERT INTO besucher (Benutzername, Passwort, Email, Bgeprueft) VALUES (?, ?, ?, 0)";
		$insert_stmt = mysqli_prepare($link, $insert_query);
		mysqli_stmt_bind_param($insert_stmt, "sss", $benutzername, $passwort_hash, $email);
		mysqli_stmt_execute($insert_stmt);
		
		// Abrufen der zuletzt eingefügten BesucherID
		$besucher_id = mysqli_insert_id($link);
		
		// Generieren Sie einen sicheren Aktivierungscode
		$aktivierungscode = bin2hex(random_bytes(16));
		
		// Aktivierungslink erstellen
		$aktivierungslink = "https://gg-game.de/activate.php?code=" . $aktivierungscode . "&bn=" . $benutzername . "&id=" . $besucher_id;
		
		// Aktivierungscode in die Datenbank speichern
		$insert_code_query = "UPDATE besucher SET Pruefcode = ? WHERE Email = ?";
		$insert_code_stmt = mysqli_prepare($link, $insert_code_query);
		mysqli_stmt_bind_param($insert_code_stmt, "ss", $aktivierungscode, $email);
		mysqli_stmt_execute($insert_code_stmt);
		
		// Fehlerbehandlung
		if(mysqli_affected_rows($link) > 0){
			$debug = true;
			// E-Mail mit Aktivierungslink versenden
			try {
				// Instanz der PHPMailer-Klasse erstellen
				$mail = new PHPMailer();
		
				if ($debug) {
					// gibt einen ausführlichen log aus
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				}
		
				$mail->isSMTP();
				$mail->SMTPAuth   = true;
				$mail->Host       = 'smtp.ionos.de';
				$mail->Port       = 465; // Standardport
				$mail->Username   = 'activate@gg-game.de';
				$mail->Password   = 'Lasombra1234!?Ionos';
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Verschlüsselung
				$mail->setFrom('activate@gg-game.de', 'GG-Game');
				$mail->addAddress($email, $benutzername);
		
				$mail->CharSet = 'UTF-8';
				$mail->Encoding = 'base64';
		
				$mail->isHTML(true);  // Set email format to HTML
				$mail->Subject = 'Aktivierungsmail';
				$mail->Body    = 'Hi '.$benutzername . '<br>' . '<br>' .' Dies ist ihr Aktivierungslink'.' '.$aktivierungslink ;
		
				if(!$mail->send()) {
					// Wenn Port 465 nicht funktioniert, ändere auf Port 587 und STARTTLS
					$mail->Port = 587;
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->send();
				}
		
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: ".$e->getMessage();
			}
			// Prepared Statement für das Einfügen von Benutzerdaten schließen
			mysqli_stmt_close($insert_stmt);
		} else {
			echo "<script>console.log('Fehler beim Registrieren des Benutzers.');</script>";
		}
	}
	// Datenbankverbindung schließen
	mysqli_close($link);
?>




<button onclick="closeLoginPopup()">Schließen</button>
