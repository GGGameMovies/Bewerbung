


		<footer>
		<div class=Navi2>
		<div class="LINKS2">
				<div class="LINK2"><a href="about.php">über uns</a></div>
				<div class="LINK2"><a href="about.php">Datenschutz</a></div>
				<div class="LINK2"><a href="about.php">Impressum</a></div>
				<div class="YTBUTTON2"> <div class="g-ytsubscribe" data-channelid="UCH_kXSiTr40SPW-zER5MhIA" data-layout="default" data-count="default"></div></div>
			</div>
		<?php
		
		if(isset($_SESSION['Anmelden']) && $_SESSION['Anmelden'] == true ){
			echo '<input type="submit" value="Logout">';
		}
		if (isset($_POST['Logout'])){
		session_destroy();
		echo "ausgeloggt";
			header("Location: index.php");
		}
		?>
		
		</div> 
		
		</footer>
	</body>
</html>
