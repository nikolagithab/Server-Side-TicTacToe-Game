<?php
// define variables and set to empty or to-be-determined values
$winner = "tbd";
$box = array("","","","","","","","","");
//TODO: validate user input
if (isset($_POST["submit"])) {
	$box[0] = ($_POST["box0"]);
	$box[1] = ($_POST["box1"]);
	$box[2] = ($_POST["box2"]);
	$box[3] = ($_POST["box3"]);
	$box[4] = ($_POST["box4"]);
	$box[5] = ($_POST["box5"]);
	$box[6] = ($_POST["box6"]);
	$box[7] = ($_POST["box7"]);
	$box[8] = ($_POST["box8"]);
	//evaluate/assign human player winner status
	if (($box[0] == "x" && $box[1] == "x" && $box[2] == "x") ||
		($box[3] == "x" && $box[4] == "x" && $box[5] == "x") ||
		($box[6] == "x" && $box[7] == "x" && $box[8] == "x") ||
		($box[0] == "x" && $box[3] == "x" && $box[6] == "x") ||
		($box[1] == "x" && $box[4] == "x" && $box[7] == "x") ||
		($box[2] == "x" && $box[5] == "x" && $box[8] == "x") ||
		($box[0] == "x" && $box[4] == "x" && $box[8] == "x") ||
		($box[2] == "x" && $box[4] == "x" && $box[6] == "x")) {
			$winner = "x";
	}
	//find blank box for machine player's random move
	$blankBox = false;
	for ($i=0; $i<9; $i++) {
		if ($box[$i] == "") {
			$blankBox = true;
		}
	}
	// evaluate emty box and game in progress status
	if ($blankBox && $winner == "tbd") {
		$i = rand(0,8);
		while ($box[$i] != "") {
			$i = rand(0,8);
		}
		$box[$i] = "o";
		// evaluate/assign machine player winner status
		if (($box[0] == "o" && $box[1] == "o" && $box[2] == "o") ||
			($box[3] == "o" && $box[4] == "o" && $box[5] == "o") ||
			($box[6] == "o" && $box[7] == "o" && $box[8] == "o") ||
			($box[0] == "o" && $box[3] == "o" && $box[6] == "o") ||
			($box[1] == "o" && $box[4] == "o" && $box[7] == "o") ||
			($box[2] == "o" && $box[5] == "o" && $box[8] == "o") ||
			($box[0] == "o" && $box[4] == "o" && $box[8] == "o") ||
			($box[2] == "o" && $box[4] == "o" && $box[6] == "o")) {
			$winner = "o";
		}
	// evaluate/assign tied game status
	} elseif ($winner == "tbd") {
		$winner = "tie";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tic Tac Toe</title>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<!--
		Author: Nikola Petrovski 
		Date created: 6 VIII 2017
		Date updated: 7 VIII 2017
		Version: 1
		Purpose: 
			Develop and publish a webpage for members to play a 
			TICTACTOE game that adhere to the given specifications.
			This is a hybrid PHP version.
		Description:
			This assignment shows how to build up a TICTACTOE Game. 
			It should always start with human player represented by
			"X" followed by a random computer move represented by "O".
			The challenge for the player is to align three of his/her
			tokens. The game will end once any player alignes three 
			tokens correctly, or once they run out of available entries. 
			When the game ends, the players are given an option to 
			start playing again.
		-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<header>
			<h1>Welcome to TicTacToe</h1>
			<h2>SYST10199 Web Programming</h2>
		</header>
		<main>
			<h3 id="message">Tic Tac Toe</h3>
			<!-- $_SERVER["PHP_SELF"] is a super global variable that 
			returns the filename of the currently executing script.
				The htmlspecialchars() function converts 
				special characters to HTML entities.-->
			<form name="tictactoe" method="post" 
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<?php
			for ($i=0; $i<9; $i++) {
				// create HTML output of 3x3 game board using PHP.
				printf('<input type="text" name="box%s" value="%s" 
					class="box">', $i, $box[$i]);
					if ($i == 2 || $i == 5 || $i == 8) {
						print('<br>');
				}
			}
			// form submit button
			if ($winner == "tbd") {
				print('<input type="submit" name="submit" value="Play"
					class="button">');
			// status updates		
			} elseif ($winner == "x") {
				print('<input type="button" name="newGameX" value="X Won!"
					onclick="window.location.href=\'index.php\'"
					class="button">');
			} elseif ($winner == "o") {
				print('<input type="button" name="newGameO" value="O Won!"
					onclick="window.location.href=\'index.php\'"
					class="button">');
			} elseif ($winner == "tie") {
				print('<input type="button" name="newGameT" value="It is a tie"
				onclick="window.location.href=\'index.php\'"
				class="button">');
			}
			?>
			</form>
		</main>
		<footer> 
			<address>Nikola Petrovski, 2017 &copy; 
			SYST10199 Web Programming, Sheridan College</address>
		</footer>
	</body>
</html>