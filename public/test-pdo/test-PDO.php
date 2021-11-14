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
<?php
 
 $curl = curl_init();
  
 curl_setopt_array($curl, array(
   CURLOPT_URL => "https://imdb-api.com/en/API/SearchSeries/k_i47ursy0/lost",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => "",
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => "GET",
 ));
  
 $response = curl_exec($curl);
  
 curl_close($curl);


 $myObject = json_decode($response);

 #echo $response;
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

			echo $response;
		?>
		<table>
			<thead>
			<tr>
				<td>Title</td>
				<td>Description</td>
			</tr>
			</thead>
			<tbody>
			<?PHP
			foreach($myObject->results as $item ):;
			?>
			<tr>
				<td><?PHP echo $item->title; ?></td>
				<td><?PHP echo $item->description; ?></td>
			</tr>
			<?PHP
			endforeach;
			?>
		</table>
	</body>
</html>