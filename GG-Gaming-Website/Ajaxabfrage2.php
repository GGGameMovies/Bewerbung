<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="Gformtrenner">
	<form id="Gform">
		<?php
		if (isset($_SESSION['username'])) {
		
			// Connection details
			$servername = '';
			$username = '';
			$password = '';
			$dbname = '';
		
			$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
		
			if (!$link) {
				die("Connection failed: " . mysqli_connect_error());
			}
		
			// Prepare the SQL statement
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
					echo "<input type='hidden' id='BesucherID' name='BesucherID' value='" . htmlentities($ID) . "'>";
				} else {
					echo "No results found.";
				}
		
				// Close the statement
				$stmt->close();
			} else {
				echo "Error in preparing statement.";
			}
		
			// Close the connection
			$link->close();
		} else {
		}
		?>
		
		<h1><p><b> Choose your favorites </b></p></h1>
		
		<p>
			<label class="labelcheck" for="Plattform">Plattform:</label>
			<select id="Plattform" name="Plattform">
				<option value="abcdefghijklmnopqrstuvwxyz">-</option>
				<?php
					// Verbindung zur Datenbank herstellen
					$servername = '';
					$username = '';
					$password = '';
					$dbname = '';
				
					$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
				
					if (!$link) {
						die("Connection failed: " . mysqli_connect_error());
					}
						// SQL-Abfrage, um alle eindeutigen Genres abzurufen, die mit Spielen verknüpft sind
						$query = "SELECT DISTINCT p.PlattformName 
									FROM spiele s
									INNER JOIN spiel_Plattform sp ON s.SpielID = sp.SpielID
									INNER JOIN plattform p ON sp.PlattformID = p.PlattformID
									LEFT JOIN bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
									WHERE (s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?))
									ORDER BY p.PlattformName ASC";
							// Prepare the query with placeholders for parameters
							$stmt = mysqli_prepare($link, $query);
						
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
					
						// Plattformen als Optionen zur Select-Box hinzufügen
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . htmlspecialchars($row['PlattformName'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['PlattformName'], ENT_QUOTES, 'UTF-8') . '</option>';
						}
				
						mysqli_close($link);
						?>
			</select>
		</p>
		
		</br>
		
		<p>
			<label class="labelcheck" for="Genre">Genre:</label>
			<select id="Genre" name="Genre">
				<option value="">-</option>
				<?php
					// Verbindung zur Datenbank herstellen
					$servername = '';
					$username = '';
					$password = '';
					$dbname = '';
				
					$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
				
					if (!$link) {
						die("Connection failed: " . mysqli_connect_error());
					}
		
					// SQL-Abfrage, um alle eindeutigen Genres abzurufen, die mit Spielen verknüpft sind
					$query = "SELECT DISTINCT g.GenreName 
							FROM spiel_Genre sg
							INNER JOIN genres g ON sg.GenreID = g.GenreID
							INNER JOIN spiele s ON sg.SpielID = s.SpielID
							LEFT JOIN bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
							WHERE (s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?))
							ORDER BY g.GenreName ASC";
							// Prepare the query with placeholders for parameters
							$stmt = mysqli_prepare($link, $query);
						
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
					
						// Plattformen als Optionen zur Select-Box hinzufügen
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . htmlspecialchars($row['GenreName'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['GenreName'], ENT_QUOTES, 'UTF-8') . '</option>';
						}
				
						mysqli_close($link);
						?>
			</select>
		</p></br>
		
		<p>
			<label class="labelcheck" for="PS">Entwickler:</label>
			<select id="PS" name="PS">
				<option value="">-</option>
				<?php
					// Verbindung zur Datenbank herstellen
					$servername = '';
					$username = '';
					$password = '';
					$dbname = '';
				
					$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
				
					if (!$link) {
						die("Connection failed: " . mysqli_connect_error());
					}
		
				// SQL-Abfrage, um alle eindeutigen Genres abzurufen, die mit Spielen verknüpft sind
				$query = "SELECT DISTINCT p.PSName 
							FROM spiel_PS sp
							INNER JOIN ps p ON sp.PSID = p.PSID
							INNER JOIN spiele s ON sp.SpielID = s.SpielID
							LEFT JOIN bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
							WHERE (s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?))
							ORDER BY p.PSName ASC";
							// Prepare the query with placeholders for parameters
							$stmt = mysqli_prepare($link, $query);
						
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
					
						// Plattformen als Optionen zur Select-Box hinzufügen
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . htmlspecialchars($row['PSName'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['PSName'], ENT_QUOTES, 'UTF-8') . '</option>';
						}
				
						mysqli_close($link);
						?>
			</select>
		</p></br>
		
		<p>
			<label class="labelcheck" for="Player">Spieltypen:</label>
			<select id="Player" name="Player">
				<option value="">-</option>
				<?php
					// Verbindung zur Datenbank herstellen
					$servername = '';
					$username = '';
					$password = '';
					$dbname = '';
				
					$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
				
					if (!$link) {
						die("Connection failed: " . mysqli_connect_error());
					}
		
				// SQL-Abfrage, um alle eindeutigen Genres abzurufen, die mit Spielen verknüpft sind
				$query = "SELECT DISTINCT p.PlayerName 
							FROM spiel_Player sp
							INNER JOIN player p ON sp.PlayerID = p.PlayerID
							INNER JOIN spiele s ON sp.SpielID = s.SpielID
							LEFT JOIN bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
							WHERE (s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?))
							ORDER BY p.PlayerName ASC;";
							// Prepare the query with placeholders for parameters
							$stmt = mysqli_prepare($link, $query);
						
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
					
						// Plattformen als Optionen zur Select-Box hinzufügen
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . htmlspecialchars($row['PlayerName'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['PlayerName'], ENT_QUOTES, 'UTF-8') . '</option>';
						}
				
						mysqli_close($link);
						?>
			</select>
		</p></br>
		
		<p>
			<label class="labelcheck" for="Release">Release:</label>
			<select id="Release" name="Release">
				<option value="0">-</option>
				<?php
					// Verbindung zur Datenbank herstellen
					$servername = '';
					$username = '';
					$password = '';
					$dbname = '';
				
					$link = mysqli_connect($servername, $username, $password, $dbname) or die("Problem with the query"); 
				
					if (!$link) {
						die("Connection failed: " . mysqli_connect_error());
					}
		
				// SQL-Abfrage, um alle eindeutigen Release-Jahre abzurufen und nach Release-Jahr sortiert zurückzugeben
				$query = "SELECT DISTINCT YEAR(Datum) AS ReleaseYear 
							FROM spiele s 
							LEFT JOIN bewertungen b ON s.SpielID = b.SpielID AND b.BesucherID = ?
							WHERE (s.Geprüft = 1 OR (s.Geprüft = 2 AND b.BesucherID = ?))
							ORDER BY ReleaseYear ASC;";
							// Prepare the query with placeholders for parameters
							$stmt = mysqli_prepare($link, $query);
						
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
					
						// Plattformen als Optionen zur Select-Box hinzufügen
						while ($row = mysqli_fetch_assoc($result)) {
							echo '<option value="' . htmlspecialchars($row['ReleaseYear'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['ReleaseYear'], ENT_QUOTES, 'UTF-8') . '</option>';
						}
				
						mysqli_close($link);
						?>
			</select>
		
		<select id="Checkboxvonbis" name="Checkboxvonbis">
			<option value="exact">exact</option>
			<option value="von">von</option>
			<option value="bis">bis</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="Gameplay">Gameplay:</label>
		
		<select id="Gameplay" name="Gameplay">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="Graphic">Graphic:</label>
		
		<select id="Graphic" name="Graphic">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="Story">Story:</label>
		
		<select id="Story" name="Story">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="AI">AI:</label>
		
		<select id="AI" name="AI">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="Creativity">Creativity:</label>
		
		<select id="Creativity" name="Creativity">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="Immersion">Immersion:</label>
		
		<select id="Immersion" name="Immersion">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="Sound">Sound:</label>
		
		<select id="Sound" name="Sound">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>
		
		<p><label class="labelcheck" for="Rating">Ranking:</label>
		
		<select id="Rating" name="Rating">
			<option value="0">-</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="40">40</option>
			<option value="50">50</option>
			<option value="60">60</option>
			<option value="70">70</option>
			<option value="80">80</option>
			<option value="90">90</option>
			<option value="100">100</option>
		</select></p></br>

	</form>
</div>

<div id="Gaus"> 



</div>

<script>
	$('#Gform').change(function(event){
		event.preventDefault();
		$.ajax({
			type: 'Post',
			url: 'select_GForm.php',
			data: $(this).serialize(),
			success: function(data){
				$('#Gaus').html(data);
			}
		});
	});
</script>