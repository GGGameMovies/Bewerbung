<!DOCTYPE html>
<html lang="de">	
	<head>
	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Explore the top-rated games on GG-Game.de, your ultimate guide for game rankings, researches, exploring and reviews.">
		<meta name="keywords" content="Game Rankings, Game Reviews, Top Games, Best Games">
		<meta name="author" content="Daniel Gonzalez">
		<meta name="robots" content="noindex, nofollow">
		<meta property="og:title" content="GG-GameRating - Game Rankings and Reviews">
		<meta property="og:description" content="Explore the top-rated games on GG-GameRating, your ultimate guide for game rankings and reviews.">
		<meta property="og:image" content="URL_to_image">
		<meta property="og:url" content="https://www.gg-game.de">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="GG-GameRating - Game Rankings and Reviews">
		<meta name="twitter:description" content="Explore the top-rated games on GG-GameRating, your ultimate guide for game rankings and reviews.">
		<meta name="twitter:image" content="URL_to_image">
		<link rel="canonical" href="https://www.gg-game.de/favorite.php">
		
		<title>activate page, diese seite ist nur für die Anmeldebestätigung, hier finden sie sonst nichts weiter</title>
		
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
		<link rel="stylesheet" type="text/css" href="./CSS/activate3840x2160.css" media="only screen and (max-width: 3840px)">
	
		<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	</head>
	
	<body>
		<?php
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\PHPMailer;
		
		require __DIR__ . '/PHPMailer/src/Exception.php';
		require __DIR__ . '/PHPMailer/src/PHPMailer.php';
		require __DIR__ . '/PHPMailer/src/SMTP.php';
		
		// Datenbankverbindung öffnen
		$servername = '';
		$username = '';
		$password = '';
		$dbname = '';
			
		$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query");
		
		// Annahme: $pruefcode und $besucher_id sind die Werte aus den GET-Parametern
		$pruefcode = mysqli_real_escape_string($link, $_GET['code']);
		$benutzername = mysqli_real_escape_string($link, $_GET['bn']);
		$besucher_id = mysqli_real_escape_string($link, $_GET['id']);
		
		// SQL-Abfrage zum Überprüfen des Prüfcodes und der BesucherID
		$sql = "SELECT * FROM besucher WHERE Pruefcode = ? AND BesucherID = ?";
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "si", $pruefcode, $besucher_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		if ($result && mysqli_num_rows($result) > 0) {
			// Prüfcode gefunden, Bgepueft auf 1 setzen
			$update_sql = "UPDATE besucher SET Bgeprueft = 1 WHERE Pruefcode = ?";
			$update_stmt = mysqli_prepare($link, $update_sql);
			mysqli_stmt_bind_param($update_stmt, "s", $pruefcode);
			mysqli_stmt_execute($update_stmt);
		
			?>
			<h1>Erfolgreich verifiziert. Ihr Profil wurde freigeschaltet.</h1>
			<form method="post" id="OKCodeForm">
				<input type="submit" name="OKCode" value="Fertig">
			</form>
			<script>
				document.getElementById('OKCodeForm').addEventListener('submit', function (event) {
					event.preventDefault();
					window.location.href = 'http://gg-game.de/index.php';
				});
			</script>
			<?php
		} else {
			// Prüfcode nicht gefunden
			?>
			<h2>Der Prüfcode ist ungültig. Möchten Sie einen neuen Prüfcode anfordern?</h2>
			<form method="post">
				<input type="email" name="email" value="email" required>
				<input type="submit" name="sendNewCode" value="Neuen Code senden">
			</form>
			<?php
		}
		
		// Wenn der Benutzer auf "Neuen Code senden" klickt
		if (isset($_POST['sendNewCode'])) {
			// Generieren Sie einen sicheren Aktivierungscode
			$aktivierungscode = bin2hex(random_bytes(16));
			$email = $_POST['email'];
		
			// Aktivierungslink erstellen
			$aktivierungslink = "https://gg-game.de/activate.php?code=" . $aktivierungscode . "&bn=" . $benutzername . "&id=" . $besucher_id;
		
			// Aktivierungscode in die Datenbank speichern
			$insert_code_query = "UPDATE besucher SET Pruefcode = ? WHERE Email = ?";
			$insert_code_stmt = mysqli_prepare($link, $insert_code_query);
			mysqli_stmt_bind_param($insert_code_stmt, "ss", $aktivierungscode, $email);
			mysqli_stmt_execute($insert_code_stmt);
		
			// E-Mail mit Aktivierungslink versenden
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'smtp.ionos.de';
			$mail->Port = 465;
			$mail->Username = 'activate@gg-game.de';
			$mail->Password = '';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->setFrom('activate@gg-game.de', 'GG-Game');
			$mail->addAddress($email, $benutzername);
			$mail->CharSet = 'UTF-8';
			$mail->Encoding = 'base64';
			$mail->isHTML(true);
			$mail->Subject = 'Aktivierungsmail';
			$mail->Body = 'Hi ' . $benutzername . '<br><br>Dies ist Ihr Aktivierungslink: ' . $aktivierungslink;
		
			if (!$mail->send()) {
				$mail->Port = 587;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				if (!$mail->send()) {
					echo 'Fehler beim Versenden der E-Mail.';
					echo "<script>console.error('Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "');</script>";
				}
			}
		
			mysqli_stmt_close($insert_stmt);
		}
		
		// Datenbankverbindung schließen
		mysqli_close($link);
		?>
	</body>
</html>