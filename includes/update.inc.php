<?php
try {
	/*
	Link the typed file to this script, so i have access to all the code in that file
	If the file can't be found or there's already included in the code, this instruction
	will return and error
	*/
	include_once "dbh.inc.php";
	
	/*
	This is the query that MySQL database will receive
	"INSERT INTO tableName    (items, ..) VALUES ($variable, ..);" <- Don't forget to put ; at
	the end of the query, remember SQL syntax
	
	//
	We use the :variable in the value field in order to do prepared statemnt to prevent SQL injection
	*/
	$query = "SELECT * FROM trackingData ORDER BY id DESC LIMIT 1;";
	
	//I send the query to the database, and later i will send the data, so there's no chance to SQL injection
	$stmt = $pdo->prepare($query);
	
	//Here i'm sending the data to the database
	$stmt->execute();
	
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (!empty($result)){
		foreach($result as $row){
			$id = $row["id"];
			$latitude = $row["latitude"];
			$longitude = $row["longitude"];
			$timeStamp = $row["timeStamp"];
		}
        ?>		<ul>
                    <li class="dataItem">
						<h4>Id: </h4>
						<p id="id" class="outputData"><?= $id ?></p>
					</li>
					<li class="dataItem">
						<h4>Latitude: </h4>
						<p id="latitude" class="outputData"><?= $latitude ?></p>
					</li>
				</ul>
				<ul>
					<li class="dataItem">
						<h4>Longitude: </h4>
						<p id="longitude" class="outputData"><?= $longitude ?></p>
					</li>
					<li class="dataItem">
						<h4>Time Stamp: </h4>
						<?php
						$timeStampMilliseconds = $timeStamp; 
						$timeStampSeconds = $timeStampMilliseconds / 1000; // Convert to seconds

						// Set the timezone to GMT-5
						date_default_timezone_set('Etc/GMT+5');

						$formatted_date = date('Y-m-d H:i:s', $timeStampSeconds);
						$timezone_text = 'GMT-5';

						// Display the timestamp and timezone text
						echo "<p id='timeStamp' class='outputData'>$formatted_date $timezone_text</p>";
						?>
					</li>
				</ul>
        <?php
	} else {
        ?>
        <div>
        <p>There was no result</p>
    </div>
    <?php
    }
	
	//Here i'm closing the conection to database manually
	$pdo = null;
	$stmt = null;
} catch (PDOException $e) {
	//If there's some error, just close the script and show following error
	die("Query failed: " . $e->getMessage());
}