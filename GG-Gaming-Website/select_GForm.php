<!-----------------------------------------MY taste--------------------------------------------->
<?php
	// Connection details
	$servername = '';
	$username = '';
	$password = '';
	$dbname = '';
			
	$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
			
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Genre'])) {
		// Retrieve and sanitize user inputs
		$ID = isset($_POST['BesucherID']) && !empty($_POST['BesucherID']) ? htmlentities($_POST['BesucherID']) : NULL;
		$Gameplay = htmlentities($_POST['Gameplay']);
		$Graphic = htmlentities($_POST['Graphic']);
		$Story = htmlentities($_POST['Story']);
		$AI = htmlentities($_POST['AI']);
		$Creativity = htmlentities($_POST['Creativity']);
		$Immersion = htmlentities($_POST['Immersion']);
		$Sound = htmlentities($_POST['Sound']);
		$genre = htmlentities($_POST['Genre']);
		$PS = htmlentities($_POST['PS']);
		$Player = htmlentities($_POST['Player']);
		$plattform = htmlentities($_POST['Plattform']);
		$Release = htmlentities($_POST['Release']);
		$Rating = htmlentities($_POST['Rating']);
		$vonbis = htmlentities($_POST['Checkboxvonbis']);
	
		// Base query with the new structure
		$select = "SELECT 
					s.SpielID, 
					s.SpielName, 
					s.YoutubeURL, 
					s.Beschreibung, 
					s.KBeschreibung, 
					s.Audio, 
					s.Datum, 
					s.BuyURLPS, 
					s.BuyURLPC, 
					s.BuyURLXbox, 
					s.BuyURLNintendo, 
					s.Logo, 
					s.Orte, 
					s.Cover, 
					IF(s.Geprüft = 1, s.Gameplay, COALESCE(b.GameplayB, s.Gameplay)) AS Gameplay,
					IF(s.Geprüft = 1, s.Graphic, COALESCE(b.GraphicB, s.Graphic)) AS Graphic,
					IF(s.Geprüft = 1, s.Story, COALESCE(b.StoryB, s.Story)) AS Story,
					IF(s.Geprüft = 1, s.AI, COALESCE(b.AIB, s.AI)) AS AI,
					IF(s.Geprüft = 1, s.Creativity, COALESCE(b.CreativityB, s.Creativity)) AS Creativity,
					IF(s.Geprüft = 1, s.Immersion, COALESCE(b.ImmersionB, s.Immersion)) AS Immersion,
					IF(s.Geprüft = 1, s.Sound, COALESCE(b.SoundB, s.Sound)) AS Sound,
					IF(s.Geprüft = 1, s.Rating, COALESCE(b.Rating, s.Rating)) AS Rating,
					GROUP_CONCAT(DISTINCT plattform.PlattformName ORDER BY plattform.PlattformName ASC SEPARATOR ', ') AS PlattformNames, 
					GROUP_CONCAT(DISTINCT genres.GenreName ORDER BY genres.GenreName ASC SEPARATOR ', ') AS GenreNames, 
					GROUP_CONCAT(DISTINCT ps.PSName ORDER BY ps.PSName ASC SEPARATOR ', ') AS PSNames, 
					GROUP_CONCAT(DISTINCT player.PlayerName ORDER BY player.PlayerName ASC SEPARATOR ', ') AS PlayerNames
				FROM 
					spiele s
				INNER JOIN 
					spiel_Plattform ON s.SpielID = spiel_Plattform.SpielID
				INNER JOIN 
					plattform ON spiel_Plattform.PlattformID = plattform.PlattformID
				INNER JOIN 
					spiel_Genre ON s.SpielID = spiel_Genre.SpielID
				INNER JOIN 
					genres ON spiel_Genre.GenreID = genres.GenreID
				INNER JOIN 
					spiel_PS ON s.SpielID = spiel_PS.SpielID
				INNER JOIN 
					ps ON spiel_PS.PSID = ps.PSID
				INNER JOIN 
					spiel_Player ON s.SpielID = spiel_Player.SpielID
				INNER JOIN 
					player ON spiel_Player.PlayerID = player.PlayerID
				LEFT JOIN 
					bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
				WHERE 
					(s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?))";
	
		// Add conditions based on user inputs
		$conditions = [];
		if ($plattform == "abcdefghijklmnopqrstuvwxyz") { 
			$conditions[] = "plattform.PlattformName LIKE '%'";
		} else {
			$conditions[] = "plattform.PlattformName = '$plattform'";
		}
		if (!empty($genre)) {
			$conditions[] = "genres.GenreName = '$genre'";
		}
		if (!empty($PS)) {
			$conditions[] = "ps.PSName = '$PS'";
		}
		if (!empty($Player)) {
			$conditions[] = "player.PlayerName = '$Player'";
		}
		if (!empty($Release) && in_array($vonbis, ['von', 'bis', 'exact'])) {
			$startOfYear = $Release . '-01-01';
			$endOfYear = $Release . '-12-31';
			
			if ($vonbis == 'von') {
				$conditions[] = "s.Datum >= '$startOfYear'";
			} elseif ($vonbis == 'bis') {
				$conditions[] = "s.Datum <= '$endOfYear'";
			} elseif ($vonbis == 'exact') {
				$conditions[] = "s.Datum BETWEEN '$startOfYear' AND '$endOfYear'";
			}
		}
	
		if ($Gameplay !== "0") {
			$conditions[] = "COALESCE(b.GameplayB, s.Gameplay) >= '$Gameplay'";
		}
		if ($Graphic !== "0") {
			$conditions[] = "COALESCE(b.GraphicB, s.Graphic) >= '$Graphic'";
		}
		if ($Story !== "0") {
			$conditions[] = "COALESCE(b.StoryB, s.Story) >= '$Story'";
		}
		if ($AI !== "0") {
			$conditions[] = "COALESCE(b.AIB, s.AI) >= '$AI'";
		}
		if ($Creativity !== "0") {
			$conditions[] = "COALESCE(b.CreativityB, s.Creativity) >= '$Creativity'";
		}
		if ($Immersion !== "0") {
			$conditions[] = "COALESCE(b.ImmersionB, s.Immersion) >= '$Immersion'";
		}
		if ($Sound !== "0") {
			$conditions[] = "COALESCE(b.SoundB, s.Sound) >= '$Sound'";
		}
		if ($Rating !== "0") {
			$conditions[] = "COALESCE(b.Rating, s.Rating) >= '$Rating'";
		}
	
		// Add conditions to the query
		if (!empty($conditions)) {
			$select .= " AND " . implode(" AND ", $conditions);
		}
	
		// Add group by and order by
		$select .= " GROUP BY s.SpielID, 
							s.SpielName, 
							s.YoutubeURL, 
							s.Beschreibung, 
							s.KBeschreibung,  
							s.Audio, 
							s.Datum, 
							s.BuyURLPS, 
							s.BuyURLPC,
							s.BuyURLXbox, 
							s.BuyURLNintendo, 
							s.Logo, 
							s.Orte, 
							s.Cover, 
							COALESCE(b.GameplayB, s.Gameplay), 
							COALESCE(b.GraphicB, s.Graphic), 
							COALESCE(b.StoryB, s.Story), 
							COALESCE(b.AIB, s.AI), 
							COALESCE(b.CreativityB, s.Creativity), 
							COALESCE(b.ImmersionB, s.Immersion), 
							COALESCE(b.SoundB, s.Sound), 
							COALESCE(b.Rating, s.Rating), 
							s.WievieleUserVote, 
							s.Geprüft 
					ORDER BY COALESCE(b.Rating, s.Rating) DESC 
					LIMIT 30";
	
		// Prepare the query with placeholders for parameters
		$stmt = mysqli_prepare($link, $select);
	
		// Bind parameters (if necessary)
		if ($stmt) {
			// Bind the parameters
			mysqli_stmt_bind_param($stmt, "ii", $ID, $ID);
	
			// Execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Process the results
				$result = mysqli_stmt_get_result($stmt);
	
				// Close the statement after processing the results
				mysqli_stmt_close($stmt);
			} else {
				// Handle errors if the query execution fails
				die(mysqli_stmt_error($stmt));
			}
		} else {
			// Handle errors if the query preparation fails
			die(mysqli_error($link));
		}
	
		// Process the results
		// Create an associative array to track unique games
		$uniqueGames = [];
		// Iterate over the query results
		while ($row = mysqli_fetch_assoc($result)) {
			// Check if the game ID is already in the array
			if (!isset($uniqueGames[$row['SpielID']])) {
				// Add the game's data to the result array
				$uniqueGames[$row['SpielID']] = $row;
			}
		}
	?>
	
		<div class="game">
			<div class="Gamebewertung">
				<table id="gameTable" class="tg1">
					<thead>
						<tr>
							<th>Cover</th>
							<th>Game</th>
							<th onclick="sortTable(2)">Gameplay</th>
							<th onclick="sortTable(3)">Graphic</th>
							<th onclick="sortTable(4)">Story</th>
							<th onclick="sortTable(5)">AI</th>
							<th onclick="sortTable(6)">Creativity</th>
							<th onclick="sortTable(7)">Immersion</th>
							<th onclick="sortTable(8)">Sound</th>
							<th onclick="sortTable(9)">Rating</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($uniqueGames as $data) {
							$SpielID = htmlentities($data['SpielID']);
							$title = htmlentities($data['SpielName']); 
							$Gameplay = htmlentities($data['Gameplay']);
							$Graphic = htmlentities($data['Graphic']);
							$Story = htmlentities($data['Story']);
							$AI = htmlentities($data['AI']);
							$Creativity = htmlentities($data['Creativity']);
							$Immersion = htmlentities($data['Immersion']);
							$Sound = htmlentities($data['Sound']);
							$EName = htmlentities($data['SpielName']);
							$BuyPS = htmlentities($data['BuyURLPS']);
							$BuyPC = htmlentities($data['BuyURLPC']);
							$BuyXbox = htmlentities($data['BuyURLXbox']);
							$BuyNintendo = htmlentities($data['BuyURLNintendo']);
							$Rating = htmlentities($data['Rating']);
							$Gameplay = $Gameplay == '0' ? '-' : $Gameplay;
							$Graphic = $Graphic == '0' ? '-' : $Graphic;
							$Story = $Story == '0' ? '-' : $Story;
							$AI = $AI == '0' ? '-' : $AI;
							$Creativity = $Creativity == '0' ? '-' : $Creativity;
							$Immersion = $Immersion == '0' ? '-' : $Immersion;
							$Sound = $Sound == '0' ? '-' : $Sound;
						?>
						<tr class="item">
							<td><a href="GamesPage.php?SpielID=<?php echo htmlentities($data['SpielID']); ?>&Titel=<?php echo htmlentities($data['SpielName']);?>">
							<img src="<?php echo htmlentities($data['Cover']); ?>" alt="kein Bild darstellbar"/></a>
							</td>
							<td><a href="GamesPage.php?SpielID=<?php echo htmlentities($data['SpielID']); ?>&Titel=<?php echo htmlentities($data['SpielName']);?>">
							<?php echo htmlentities($data['SpielName']);?></a>
							</td>
							<td><?php echo htmlentities($data['Gameplay']);?></td>
							<td><?php echo htmlentities($data['Graphic'])?></td>
							<td><?php echo htmlentities($data['Story'])?></td>
							<td><?php echo htmlentities($data['AI'])?></td>
							<td><?php echo htmlentities($data['Creativity'])?></td>
							<td><?php echo htmlentities($data['Immersion'])?></td>
							<td><?php echo htmlentities($data['Sound'])?></td>
							<td><?php echo htmlentities($data['Rating'])?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table></br> 
			</div>
		</div>
	<?php 
	}
mysqli_close($link);
?>


<!-----------------------------------------MY taste--------------------------------------------->

<!-------------------------------------------vs1------------------------------------------------>

<?php
	// Connection details
	$servername = '';
	$username = '';
	$password = '';
	$dbname = '';
		
	$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
		
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['svs1'])) {
		$ID = isset($_GET['ID']) ? $_GET['ID'] : '';
		$name = mysqli_real_escape_string($link, $_POST['svs1']); // SQL Injection verhindern
		$select = "SELECT 
					s.SpielID,
					s.SpielName,
					s.YoutubeURL, 
					s.Beschreibung, 
					s.KBeschreibung, 
					s.Audio, 
					s.Datum, 
					s.BuyURLPS, 
					s.BuyURLPC, 
					s.BuyURLXbox, 
					s.BuyURLNintendo, 
					s.Logo, 
					s.Orte, 
					s.Cover, 
					IF(s.Geprüft = 1, s.Gameplay, COALESCE(b.GameplayB, s.Gameplay)) AS Gameplay,
					IF(s.Geprüft = 1, s.Graphic, COALESCE(b.GraphicB, s.Graphic)) AS Graphic,
					IF(s.Geprüft = 1, s.Story, COALESCE(b.StoryB, s.Story)) AS Story,
					IF(s.Geprüft = 1, s.AI, COALESCE(b.AIB, s.AI)) AS AI,
					IF(s.Geprüft = 1, s.Creativity, COALESCE(b.CreativityB, s.Creativity)) AS Creativity,
					IF(s.Geprüft = 1, s.Immersion, COALESCE(b.ImmersionB, s.Immersion)) AS Immersion,
					IF(s.Geprüft = 1, s.Sound, COALESCE(b.SoundB, s.Sound)) AS Sound,
					IF(s.Geprüft = 1, s.Rating, COALESCE(b.Rating, s.Rating)) AS Rating,
					GROUP_CONCAT(DISTINCT plattform.PlattformName ORDER BY plattform.PlattformName ASC SEPARATOR ', ') AS PlattformNames, 
					GROUP_CONCAT(DISTINCT genres.GenreName ORDER BY genres.GenreName ASC SEPARATOR ', ') AS GenreNames, 
					GROUP_CONCAT(DISTINCT ps.PSName ORDER BY ps.PSName ASC SEPARATOR ', ') AS PSNames, 
					GROUP_CONCAT(DISTINCT player.PlayerName ORDER BY player.PlayerName ASC SEPARATOR ', ') AS PlayerNames
				FROM 
					spiele s
				INNER JOIN 
					spiel_Plattform ON s.SpielID = spiel_Plattform.SpielID
				INNER JOIN 
					plattform ON spiel_Plattform.PlattformID = plattform.PlattformID
				INNER JOIN 
					spiel_Genre ON s.SpielID = spiel_Genre.SpielID
				INNER JOIN 
					genres ON spiel_Genre.GenreID = genres.GenreID
				INNER JOIN 
					spiel_PS ON s.SpielID = spiel_PS.SpielID
				INNER JOIN 
					ps ON spiel_PS.PSID = ps.PSID
				INNER JOIN 
					spiel_Player ON s.SpielID = spiel_Player.SpielID
				INNER JOIN 
					player ON spiel_Player.PlayerID = player.PlayerID
				LEFT JOIN 
					bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
				WHERE 
					(s.Geprüft = 1 AND s.SpielName = ?) OR (s.Geprüft = 2 AND b.BesucherID = ? AND (s.SpielName = ?))
				GROUP BY 
					s.SpielID, 
					s.SpielName, 
					s.YoutubeURL, 
					s.Beschreibung, 
					s.KBeschreibung,
					s.Audio, 
					s.Datum, 
					s.BuyURLPS, 
					s.BuyURLPC,
					s.BuyURLXbox, 
					s.BuyURLNintendo, 
					s.Logo, 
					s.Orte, 
					s.Cover, 
					COALESCE(b.GameplayB, s.Gameplay), 
					COALESCE(b.GraphicB, s.Graphic), 
					COALESCE(b.StoryB, s.Story), 
					COALESCE(b.AIB, s.AI), 
					COALESCE(b.CreativityB, s.Creativity), 
					COALESCE(b.ImmersionB, s.Immersion), 
					COALESCE(b.SoundB, s.Sound), 
					COALESCE(b.Rating, s.Rating), 
					s.WievieleUserVote, 
					s.Geprüft 
				ORDER BY COALESCE(b.Rating, s.Rating) DESC";
	
		// Prepare the query with placeholders for parameters
		$stmt = mysqli_prepare($link, $select);
		
		// Binden von Parametern (falls erforderlich)
		if ($stmt) {
			// Binden des Parameters
			mysqli_stmt_bind_param($stmt, "isis", $ID, $name, $ID, $name);
		
			// Ausführen der vorbereiteten Abfrage
			if (mysqli_stmt_execute($stmt)) {
				// Ergebnisse abrufen
				$result = mysqli_stmt_get_result($stmt);
	
				// Ausgabe der Ergebnisse (Beispiel)
				while ($data = mysqli_fetch_array($result)) {
					// Variablen initialisieren
					$title = $Platforms = $Genre = $Gameplay = $Graphic = $Story = $AI = $Creativity = $Immersion = $Sound = $EName = $BuyPS = $BuyPC = $BuyXbox = $BuyNintendo = $Cover = $Rating = "";
	
					// Werte zuweisen
					$SpielID = htmlentities($data['SpielID']);
					$title = $name;
					$Platforms = htmlentities($data['PlattformNames']);
					$Genre = htmlentities($data['GenreNames']);
					$Gameplay = htmlentities($data['Gameplay']);
					$Graphic = htmlentities($data['Graphic']);
					$Story = htmlentities($data['Story']);
					$AI = htmlentities($data['AI']);
					$Creativity = htmlentities($data['Creativity']);
					$Immersion = htmlentities($data['Immersion']);
					$Sound = htmlentities($data['Sound']);
					$EName = htmlentities($data['SpielName']);
					$BuyPS = htmlentities($data['BuyURLPS']);
					$BuyPC = htmlentities($data['BuyURLPC']);
					$BuyXbox = htmlentities($data['BuyURLXbox']);
					$BuyNintendo = htmlentities($data['BuyURLNintendo']);
					$Cover = htmlentities($data['Cover']);
					$Rating = htmlentities($data['Rating']);
					$Gameplay = $Gameplay == '0' ? '-' : $Gameplay;
					$Graphic = $Graphic == '0' ? '-' : $Graphic;
					$Story = $Story == '0' ? '-' : $Story;
					$AI = $AI == '0' ? '-' : $AI;
					$Creativity = $Creativity == '0' ? '-' : $Creativity;
					$Immersion = $Immersion == '0' ? '-' : $Immersion;
					$Sound = $Sound == '0' ? '-' : $Sound;
	
	?>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<?php
					if (!empty($Cover)) {
						// Wenn $Cover nicht leer ist, zeige das Bild an
						echo '<a href="GamesPage.php?SpielID=' . $SpielID . '&Titel=' . htmlentities($title) . '"><img class="Coverimg" src="' . $Cover . '" alt="Bild"></a>';
					} else {
						// Wenn $Cover leer ist, zeige das Standardbild an
						echo '<a href="GamesPage.php?SpielID=' . $SpielID . '&Titel=' . htmlentities($title) . '"><img src="/Bilder/Spielelogo/schwarz.png" alt="Standardbild" width="200" height="200"></a>';
					}
					?>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">					
					<h2>Title</h2>
					<h3><a href="GamesPage.php?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo htmlentities($data['SpielName']); ?>"><?php echo $data['SpielName']; ?></a></h3>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h2>Platform</h2>
					<div class="Bildericon">
						<h4>
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
						</h4>
					</div>	
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
				<div class="GameBoxH">
					<div class="Titelh">
						<h1><?php echo $Gameplay?>%</h1>
						<h2>Gameplay</h2>
					</div>
				</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h1><?php echo $Graphic?>%</h1>
					<h2>Graphic</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h1><?php echo $Story?>%</h1>
					<h2>Story</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h1><?php echo $AI?>%</h1>
					<h2>AI</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h1><?php echo $Creativity?>%</h1>
					<h2>Creativity</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h1><?php echo $Immersion?>%</h1>
					<h2>Immersion</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h1><?php echo $Sound?>%</h1>
					<h2>Sound</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h1><?php echo round($Rating)?>%</h1>
					<h2>Rating</h2>       
				</div>     		
			</div>         		
		</div>
	<?php                  	
	}}}} mysqli_close($link);	
	?>                  		
<!-----------------------------------------vs1-------------------------------------------------->

<!-----------------------------------------vs2-------------------------------------------------->

<?php
	// Connection details
	$servername = '';
	$username = '';
	$password = '';
	$dbname = '';
		
	$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
		
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['svs2'])) {
		$ID = isset($_GET['ID']) ? $_GET['ID'] : '';
		$name = mysqli_real_escape_string($link, $_POST['svs2']); // SQL Injection verhindern
		$select = "SELECT 
					s.SpielID,
					s.SpielName,
					s.YoutubeURL, 
					s.Beschreibung, 
					s.KBeschreibung,
					s.Audio, 
					s.Datum, 
					s.BuyURLPS, 
					s.BuyURLPC, 
					s.BuyURLXbox, 
					s.BuyURLNintendo, 
					s.Logo, 
					s.Orte, 
					s.Cover, 
					IF(s.Geprüft = 1, s.Gameplay, COALESCE(b.GameplayB, s.Gameplay)) AS Gameplay,
					IF(s.Geprüft = 1, s.Graphic, COALESCE(b.GraphicB, s.Graphic)) AS Graphic,
					IF(s.Geprüft = 1, s.Story, COALESCE(b.StoryB, s.Story)) AS Story,
					IF(s.Geprüft = 1, s.AI, COALESCE(b.AIB, s.AI)) AS AI,
					IF(s.Geprüft = 1, s.Creativity, COALESCE(b.CreativityB, s.Creativity)) AS Creativity,
					IF(s.Geprüft = 1, s.Immersion, COALESCE(b.ImmersionB, s.Immersion)) AS Immersion,
					IF(s.Geprüft = 1, s.Sound, COALESCE(b.SoundB, s.Sound)) AS Sound,
					IF(s.Geprüft = 1, s.Rating, COALESCE(b.Rating, s.Rating)) AS Rating,
					GROUP_CONCAT(DISTINCT plattform.PlattformName ORDER BY plattform.PlattformName ASC SEPARATOR ', ') AS PlattformNames, 
					GROUP_CONCAT(DISTINCT genres.GenreName ORDER BY genres.GenreName ASC SEPARATOR ', ') AS GenreNames, 
					GROUP_CONCAT(DISTINCT ps.PSName ORDER BY ps.PSName ASC SEPARATOR ', ') AS PSNames, 
					GROUP_CONCAT(DISTINCT player.PlayerName ORDER BY player.PlayerName ASC SEPARATOR ', ') AS PlayerNames
				FROM 
					spiele s
				INNER JOIN 
					spiel_Plattform ON s.SpielID = spiel_Plattform.SpielID
				INNER JOIN 
					plattform ON spiel_Plattform.PlattformID = plattform.PlattformID
				INNER JOIN 
					spiel_Genre ON s.SpielID = spiel_Genre.SpielID
				INNER JOIN 
					genres ON spiel_Genre.GenreID = genres.GenreID
				INNER JOIN 
					spiel_PS ON s.SpielID = spiel_PS.SpielID
				INNER JOIN 
					ps ON spiel_PS.PSID = ps.PSID
				INNER JOIN 
					spiel_Player ON s.SpielID = spiel_Player.SpielID
				INNER JOIN 
					player ON spiel_Player.PlayerID = player.PlayerID
				LEFT JOIN 
					bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
				WHERE 
					(s.Geprüft = 1 AND s.SpielName = ?) OR (s.Geprüft = 2 AND b.BesucherID = ? AND (s.SpielName = ?))
				GROUP BY 
					s.SpielID, 
					s.SpielName, 
					s.YoutubeURL, 
					s.Beschreibung, 
					s.KBeschreibung,
					s.Audio, 
					s.Datum, 
					s.BuyURLPS, 
					s.BuyURLPC,
					s.BuyURLXbox, 
					s.BuyURLNintendo, 
					s.Logo, 
					s.Orte, 
					s.Cover, 
					COALESCE(b.GameplayB, s.Gameplay), 
					COALESCE(b.GraphicB, s.Graphic), 
					COALESCE(b.StoryB, s.Story), 
					COALESCE(b.AIB, s.AI), 
					COALESCE(b.CreativityB, s.Creativity), 
					COALESCE(b.ImmersionB, s.Immersion), 
					COALESCE(b.SoundB, s.Sound), 
					COALESCE(b.Rating, s.Rating), 
					s.WievieleUserVote, 
					s.Geprüft 
				ORDER BY COALESCE(b.Rating, s.Rating) DESC";
	
		// Prepare the query with placeholders for parameters
		$stmt = mysqli_prepare($link, $select);
		
		// Binden von Parametern (falls erforderlich)
		if ($stmt) {
			// Binden des Parameters
			mysqli_stmt_bind_param($stmt, "isis", $ID,$name,$ID,$name);
		
			// Ausführen der vorbereiteten Abfrage
			if (mysqli_stmt_execute($stmt)) {
				// Ergebnisse abrufen
				$result = mysqli_stmt_get_result($stmt);
	
				// Ausgabe der Ergebnisse (Beispiel)
				while ($data = mysqli_fetch_array($result)) {
					// Variablen initialisieren
					$title = $Platforms = $Genre = $Gameplay = $Graphic = $Story = $AI = $Creativity = $Immersion = $Sound = $EName = $BuyPS = $BuyPC = $BuyXbox = $BuyNintendo = $Cover = $Rating = "";
	
					// Werte zuweisen
					$SpielID = htmlentities($data['SpielID']);
					$title = $name;
					$Platforms = htmlentities($data['PlattformNames']);
					$Genre = htmlentities($data['GenreNames']);
					$Gameplay = htmlentities($data['Gameplay']);
					$Graphic = htmlentities($data['Graphic']);
					$Story = htmlentities($data['Story']);
					$AI = htmlentities($data['AI']);
					$Creativity = htmlentities($data['Creativity']);
					$Immersion = htmlentities($data['Immersion']);
					$Sound = htmlentities($data['Sound']);
					$EName = htmlentities($data['SpielName']);
					$BuyPS = htmlentities($data['BuyURLPS']);
					$BuyPC = htmlentities($data['BuyURLPC']);
					$BuyXbox = htmlentities($data['BuyURLXbox']);
					$BuyNintendo = htmlentities($data['BuyURLNintendo']);
					$Cover = htmlentities($data['Cover']);
					$Rating = htmlentities($data['Rating']);
					$Gameplay = $Gameplay == '0' ? '-' : $Gameplay;
					$Graphic = $Graphic == '0' ? '-' : $Graphic;
					$Story = $Story == '0' ? '-' : $Story;
					$AI = $AI == '0' ? '-' : $AI;
					$Creativity = $Creativity == '0' ? '-' : $Creativity;
					$Immersion = $Immersion == '0' ? '-' : $Immersion;
					$Sound = $Sound == '0' ? '-' : $Sound;
	
?>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<?php
					if (!empty($Cover)) {
						// Wenn $Cover nicht leer ist, zeige das Bild an
						echo '<a href="GamesPage.php?SpielID=' . $SpielID . '&Titel=' . htmlentities($title) . '"><img class="Coverimg" src="' . $Cover . '" alt="Bild"></a>';
					} else {
						// Wenn $Cover leer ist, zeige das Standardbild an
						echo '<a href="GamesPage.php?SpielID=' . $SpielID . '&Titel=' . htmlentities($title) . '"><img src="/Bilder/Spielelogo/schwarz.png" alt="Standardbild" width="200" height="200"></a>';
					}
					?>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">					
					<h2>Title</h2>
					<h3><a href="GamesPage.php?SpielID=<?php echo $SpielID; ?>&Titel=<?php echo htmlentities($data['SpielName']); ?>"><?php echo $data['SpielName']; ?></a></h3>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH">
			<div class="GameBoxH">
				<div class="Titelh">
					<h2>Platform</h2>
					<div class="Bildericon">
						<h4>
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
						</h4>
					</div>	
				</div>
			</div>
		</div>
		<div class="GameBoxAusH2">
				<div class="GameBoxH2">
					<div class="Titelh2">
						<h1><?php echo $Gameplay?>%</h1>
						<h2>Gameplay</h2>
					</div>
				</div>
		</div>
		<div class="GameBoxAusH2">
			<div class="GameBoxH2">
				<div class="Titelh2">
					<h1><?php echo $Graphic?>%</h1>
					<h2>Graphic</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH2">
			<div class="GameBoxH2">
				<div class="Titelh2">
					<h1><?php echo $Story?>%</h1>
					<h2>Story</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH2">
			<div class="GameBoxH2">
				<div class="Titelh2">
					<h1><?php echo $AI?>%</h1>
					<h2>AI</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH2">
			<div class="GameBoxH2">
				<div class="Titelh2">
					<h1><?php echo $Creativity?>%</h1>
					<h2>Creativity</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH2">
			<div class="GameBoxH2">
				<div class="Titelh2">
					<h1><?php echo $Immersion?>%</h1>
					<h2>Immersion</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH2">
			<div class="GameBoxH2">
				<div class="Titelh2">
					<h1><?php echo $Sound?>%</h1>
					<h2>Sound</h2>
				</div>
			</div>
		</div>
		<div class="GameBoxAusH2">
			<div class="GameBoxH2">
				<div class="Titelh2">
					<h1><?php echo round($Rating)?>%</h1>
					<h2>Rating</h2>       
				</div>     		
			</div>         		
		</div>
	<?php                  	
	}}}} mysqli_close($link);	
	?>

<!-----------------------------------------vs2-------------------------------------------------->
<!--------------------------------------------VS-ENDE----------------------------------------------->



