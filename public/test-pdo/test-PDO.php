<?php

	require_once("initPDO.php");
	require_once("createUserTable.php");

	$request = $pdo->prepare("select * from users");
	if (!$request) {
		myDump(debug_backtrace());
		die('Error while doing request ' . $sqlRequest);
	}
	$request->execute();

	$user = $request->fetch(PDO::FETCH_OBJ);

	$allUsers = '<table><tr><td>Id</td><td>Nom</td><td>Email</td></tr>';
	while(!empty($user)) {
		$allUsers .= '<tr><td>'.$user->id.'</td><td>'.$user->name.'</td><td>'.$user->email.'</td></tr>';
		$user = $request->fetch(PDO::FETCH_OBJ);
	}
	$allUsers .= "</table>";

    /*** close the database connection ***/
    $pdo = null;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<style>
		table {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
		}

		td {
			text-align: center;
			padding-left: 2em;
			padding-right: 2em;
		}
		</style>
	</head>
	<body>
	<h1>Users</h1>
		<?php
			echo $allUsers;
		?>
	</body>
</html>