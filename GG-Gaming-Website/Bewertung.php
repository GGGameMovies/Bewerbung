<script>
	function submitForm() {
		document.getElementById("bewertung_form").submit();
	}
</script>

<div id="BewertungContent">
    <h2>Bewertung</h2>
	<form method="post">
		<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
		<p><label class="labelcheck" for="Gameplay">Gameplay:</label>
			<select id="Gameplay" name="Gameplay">
				<option value="-">-</option>
				<?php for ($i = 1; $i <= 100; $i += 1): ?>
					<option value="<?php echo $i; ?>" <?php if (!empty($data['GameplayB']) && $data['GameplayB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p><br>
		
		<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
		<p><label class="labelcheck" for="Graphic">Graphic:</label>
			<select id="Graphic" name="Graphic">
				<option value="-">-</option>
				<?php for ($i = 1; $i <= 100; $i += 1): ?>
					<option value="<?php echo $i; ?>" <?php if (!empty($data['GraphicB']) && $data['GraphicB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p><br>
		
		<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
		<p><label class="labelcheck" for="Story">Story:</label>
			<select id="Story" name="Story">
				<option value="-">-</option>
				<?php for ($i = 1; $i <= 100; $i += 1): ?>
					<option value="<?php echo $i; ?>" <?php if (!empty($data['StoryB']) && $data['StoryB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p><br>
		
		<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
		<p><label class="labelcheck" for="AI">AI:</label>
			<select id="AI" name="AI">
				<option value="-">-</option>
				<?php for ($i = 1; $i <= 100; $i += 1): ?>
					<option value="<?php echo $i; ?>" <?php if (!empty($data['AIB']) && $data['AIB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p><br>
		
		<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
		<p><label class="labelcheck" for="Creativity">Creativity:</label>
			<select id="Creativity" name="Creativity">
				<option value="-">-</option>
				<?php for ($i = 1; $i <= 100; $i += 1): ?>
					<option value="<?php echo $i; ?>" <?php if (!empty($data['CreativityB']) && $data['CreativityB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p><br>
		
		<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
		<p><label class="labelcheck" for="Immersion">Immersion:</label>
			<select id="Immersion" name="Immersion" required>
				<option value="-">-</option>
				<?php for ($i = 1; $i <= 100; $i += 1): ?>
					<option value="<?php echo $i; ?>" <?php if (!empty($data['ImmersionB']) && $data['ImmersionB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p><br>
		
		<!-- Hier nur diejenigen Select-Boxen einfügen, die Sie füllen möchten -->
		<p><label class="labelcheck" for="Sound">Sound:</label>
			<select id="Sound" name="Sound" required>
				<option value="-">-</option>
				<?php for ($i = 1; $i <= 100; $i += 1): ?>
					<option value="<?php echo $i; ?>" <?php if (!empty($data['SoundB']) && $data['SoundB'] == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p><br>
		<button type="submit" id="submit_bewertung" name="submit_bewertung" onclick="WerteButtonClick()" value="<?php echo $DatenP == 'true' ? 'Bewertung aktualisieren' : 'Bewerten'; ?>">			
		<?php echo $DatenP == "true" ? "Bewertung aktualisieren" : "Bewerten";?>
		</button>
	</form>
</div>
<!-------------------------------------------------------------------->

<!--------------------------------------------Bewertung-Request---------------------------------------------->
<?php 
	@$buttonText = $_POST['submit_bewertung'];
	if ($buttonText === "Bewertung aktualisieren") {
		
		// Der Rest deines Codes für die Aktualisierung der Bewertung
		$GameplayB = isset($_POST['Gameplay']) ? $_POST['Gameplay'] : 0;
		$GraphicB = isset($_POST['Graphic']) ? $_POST['Graphic'] : 0;
		$StoryB = isset($_POST['Story']) ? $_POST['Story'] : 0;
		$AIB = isset($_POST['AI']) ? $_POST['AI'] : 0;
		$CreativityB = isset($_POST['Creativity']) ? $_POST['Creativity'] : 0;
		$ImmersionB = isset($_POST['Immersion']) ? $_POST['Immersion'] : 0;
		$SoundB = isset($_POST['Sound']) ? $_POST['Sound'] : 0;
		
		// Beispielabfrage, um die BenutzerID zu erhalten
		$besucher_id_query = "SELECT BesucherID FROM besucher WHERE Benutzername = ?";
		$stmt_besucher_id = mysqli_prepare($link, $besucher_id_query);
		mysqli_stmt_bind_param($stmt_besucher_id, "s", $username);
		mysqli_stmt_execute($stmt_besucher_id);
		$result_besucher_id = mysqli_stmt_get_result($stmt_besucher_id);
	
		$row_besucher_id = mysqli_fetch_assoc($result_besucher_id);
		$BesucherID = $row_besucher_id['BesucherID'];
		
		// Daten aktualisieren
		$update = "UPDATE bewertungen SET GameplayB=?, GraphicB=?, StoryB=?, AIB=?, CreativityB=?, ImmersionB=?, SoundB=? WHERE BesucherID=? AND SpielID=?";
		$stmt_update = mysqli_prepare($link, $update);
		mysqli_stmt_bind_param($stmt_update, "iiiiiiiii", $GameplayB, $GraphicB, $StoryB, $AIB, $CreativityB, $ImmersionB, $SoundB, $BesucherID, $SpielID);
		mysqli_stmt_execute($stmt_update);
		echo "Daten erfolgreich aktualisiert!";
		?><script> window.location.href = 'https://gg-game.de/GamesPage.php?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo $title; ?>';</script><?php
	} 
	elseif ($buttonText === "Bewerten") {
		// Der Rest deines Codes für das Hinzufügen einer neuen Bewertung
		$GameplayB = isset($_POST['Gameplay']) ? $_POST['Gameplay'] : 0;
		$GraphicB = isset($_POST['Graphic']) ? $_POST['Graphic'] : 0;
		$StoryB = isset($_POST['Story']) ? $_POST['Story'] : 0;
		$AIB = isset($_POST['AI']) ? $_POST['AI'] : 0;
		$CreativityB = isset($_POST['Creativity']) ? $_POST['Creativity'] : 0;
		$ImmersionB = isset($_POST['Immersion']) ? $_POST['Immersion'] : 0;
		$SoundB = isset($_POST['Sound']) ? $_POST['Sound'] : 0;
		
		// Beispielabfrage, um die BenutzerID zu erhalten
		$besucher_id_query = "SELECT BesucherID FROM besucher WHERE Benutzername = ?";
		$stmt_besucher_id = mysqli_prepare($link, $besucher_id_query);
		mysqli_stmt_bind_param($stmt_besucher_id, "s", $username);
		mysqli_stmt_execute($stmt_besucher_id);
		$result_besucher_id = mysqli_stmt_get_result($stmt_besucher_id);
	
		$row_besucher_id = mysqli_fetch_assoc($result_besucher_id);
		$BesucherID = $row_besucher_id['BesucherID'];
		
		// Neue Daten einfügen
		$insert = "INSERT INTO bewertungen (BesucherID, SpielID, GameplayB, GraphicB, StoryB, AIB, CreativityB, ImmersionB, SoundB) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt_insert = mysqli_prepare($link, $insert);
		mysqli_stmt_bind_param($stmt_insert, "iiiiiiiii", $BesucherID, $SpielID, $GameplayB, $GraphicB, $StoryB, $AIB, $CreativityB, $ImmersionB, $SoundB);
		mysqli_stmt_execute($stmt_insert);
		echo "Daten erfolgreich gespeichert!";
		
		if($geprueft == 1) {
			// Abfrage, um die Werte aus der Tabelle 'spiele' basierend auf der SpielID abzurufen
			$spiel_query = "SELECT * FROM spiele WHERE SpielID = ?";
			$stmt_spiel = mysqli_prepare($link, $spiel_query);
			mysqli_stmt_bind_param($stmt_spiel, "i", $SpielID);
			mysqli_stmt_execute($stmt_spiel);
			$result_spiel = mysqli_stmt_get_result($stmt_spiel);
			
			// zwischenspeichern der variablen
			$row_spiel = mysqli_fetch_assoc($result_spiel);
			$GameplayA = $row_spiel['Gameplay'];
			$GraphicA = $row_spiel['Graphic'];
			$StoryA = $row_spiel['Story'];
			$AIA = $row_spiel['AI'];
			$CreativityA = $row_spiel['Creativity'];
			$ImmersionA = $row_spiel['Immersion'];
			$SoundA = $row_spiel['Sound'];
			$UserVote = $row_spiel['WievieleUserVote'];
						
			// Zwischenrechnung der Variablen, wenn der Wert größer als 10 oder mindestens 11 ist
			$Gameplay 	= $GameplayB 	- $GameplayA 	>= 15 ? round(($GameplayB 	- $GameplayA) 	/ 1.5) + $GameplayA : $GameplayB;
			$Graphic 	= $GraphicB 	- $GraphicA 	>= 15 ? round(($GraphicB 	- $GraphicA) 	/ 1.5) + $GraphicA : $GraphicB;
			$Story 		= $StoryB 		- $StoryA 		>= 15 ? round(($StoryB 		- $StoryA) 		/ 1.5) + $StoryA : $StoryB;
			$AI 		= $AIB 			- $AIA 			>= 15 ? round(($AIB 		- $AIA) 		/ 1.5) + $AIA : $AIB;
			$Creativity = $CreativityB 	- $CreativityA 	>= 15 ? round(($CreativityB - $CreativityA) / 1.5) + $CreativityA : $CreativityB;
			$Immersion 	= $ImmersionB 	- $ImmersionA 	>= 15 ? round(($ImmersionB 	- $ImmersionA) 	/ 1.5) + $ImmersionA : $ImmersionB;
			$Sound 		= $SoundB 		- $SoundA 		>= 15 ? round(($SoundB 		- $SoundA) 		/ 1.5) + $SoundA : $SoundB;
			
			// zwischenrechnung der variablen 2
			$GameplayA 		*=$UserVote;
			$GraphicA 		*=$UserVote;
			$StoryA 		*=$UserVote;
			$AIA 			*=$UserVote;
			$CreativityA 	*=$UserVote;
			$ImmersionA 	*=$UserVote;
			$SoundA 		*=$UserVote;
			
			$UserVote++;
		
			// zwischenrechnung der variablen 3
			$GameplayA 		+=$Gameplay;
			$GraphicA 		+=$Graphic;
			$StoryA 		+=$Story;
			$AIA 			+=$AI;
			$CreativityA 	+=$Creativity;
			$ImmersionA 	+=$Immersion;
			$SoundA 		+=$Sound;
		
			// zwischenrechnung der variablen 4
			$GameplayA 		=round($GameplayA / $UserVote);
			$GraphicA 		=round($GraphicA / $UserVote);
			$StoryA 		=round($StoryA / $UserVote);
			$AIA 			=round($AIA / $UserVote);
			$CreativityA 	=round($CreativityA / $UserVote);
			$ImmersionA 	=round($ImmersionA / $UserVote);
			$SoundA 		=round($SoundA / $UserVote);
			
			$Rating = ($GameplayA + $GraphicA + $StoryA + $AIA + $CreativityA + $ImmersionA + $SoundA) / 7;
		
			// Abfrage, um die neuen Werte in die Tabelle 'spiele' einzutragen
			$update_query = "UPDATE spiele SET Gameplay=?, Graphic=?, Story=?, AI=?, Creativity=?, Immersion=?, Sound=?, Rating=?, WievieleUserVote=? WHERE SpielID=?";
			$stmt_update = mysqli_prepare($link, $update_query);
			mysqli_stmt_bind_param($stmt_update, "iiiiiiiiii", $GameplayA, $GraphicA, $StoryA, $AIA, $CreativityA, $ImmersionA, $SoundA, $Rating, $UserVote, $SpielID);
			mysqli_stmt_execute($stmt_update);
			echo "Daten erfolgreich geranked!";
			?><script> window.location.href = 'https://gg-game.de/GamesPage.php?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo $title; ?>';</script><?php
		}} else {
			// Skript wurde bereits ausgeführt, kein erneutes Ausführen erforderlich
		} 
	
	// Schließe die vorbereiteten Anweisungen
	if (isset($stmt_besucher_id)) {
		mysqli_stmt_close($stmt_besucher_id);
	}
	
	if (isset($stmt_insert)) {
		mysqli_stmt_close($stmt_insert);
	}
	
	if (isset($stmt_spiel)) {
		mysqli_stmt_close($stmt_spiel);
	}
	
	if (isset($stmt_update)) {
		mysqli_stmt_close($stmt_update);
	}
	
	// Schließe die Datenbankverbindung
	mysqli_close($link);
?>
<!--------------------------------------------Bewertung----------------------------------------------->