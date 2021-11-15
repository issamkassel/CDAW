<?php

class getMedia
	{
		public static function getAllMedia() {
			
			$curl = curl_init();
		
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://imdb-api.com/en/API/Top250Movies/k_i47ursy0",
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
			$allMedia = json_decode($response,true)["items"];
			return $allMedia;
		}
        public static function convertToObject($medias){
			$all_medias_objets = array();
			foreach ($medias as $m){
				$mediaObject = new Media($m["id"],$m["title"]);
				array_push($all_medias_objets,$mediaObject);
			}
			return($all_medias_objets);
        }
        public static function showMediasAsTable($medias){
                $medias_objects = static::convertToObject($medias);
                echo '<table><thead>
                        <tr><th>Id</th><th>Titre</th></tr></thead><tbody>';
                foreach($medias_objects as $m) {
                    echo "<tr>"
                    . "<td>". $m->id . "</td>"
                    . "<td>". $m->titre . "</td></tr>";
                }
                echo '</tbody></table>';
            }
        public static function showAllMediasAsTable() {
            static::showMediasAsTable(static::getAllMedia());
        }

    }

class Media{
    public $id;
    public $title;

    public function __construct($id,$title){
        $this->$id=$id;
        $this->$title=$title;
    }
    }






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
		<h1>Media</h1>
		<?php
			getMedia::showAllMediasAsTable();
		?>
	</body>
</html>