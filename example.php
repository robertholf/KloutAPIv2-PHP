<?php 
	require_once("../src/KloutAPIv2.class.php");
	// Set your client key and secret
	$kloutapi_key = "rsf2ytqvg3yr5syffrbkr7t2";
	// Load the Foursquare API library
	$klout = new KloutAPIv2($kloutapi_key);
	// Get Klout ID
	
	// Get Variables
	$network 	= $_GET['NetworkPlatform'];
	$screenname = $_GET['NetworkScreenName'];
	$userid 	= $_GET['NetworkUserID'];
	$kloutid 	= $_GET['KloutID'];
	
?>
<!doctype html>
<html>
<head>
	<title>KloutAPIv2-PHP :: Example</title>
</head>
<body>
<h1>Klout ID Lookup</h1>
<p>
<h3>By Screen Name</h3>
	<form action="" method="GET">
		Network: <select name="NetworkPlatform"><option value="twitter">Twitter</option></select><br />
		User: <input type="text" name="NetworkScreenName" value="rob" /><br />
		<input type="submit" value="Get Klout ID" />
	</form>

<h3>By ID</h3>
	<form action="" method="GET">
		Network: <select name="NetworkPlatform"><option value="tw">Twitter</option></select><br />
		User: <input type="text" name="NetworkUserID" value="13044" /><br />
		<input type="submit" value="Get Klout ID" />
	</form>
    
<?php 
	// Is there a Screen name or ID to use?
	if (isset($screenname)) {
		echo "<p>Klout ID for <strong>$screenname</strong> on <strong>$network</strong> is: ";
		$kloutid = $klout->KloutIDLookupByName($network,$screenname);
		echo "<strong>". $kloutid ."</strong>";
	} elseif (isset($userid)) {
		echo "<p>Klout ID for <strong>$userid</strong> on <strong>$network</strong> is: ";
		$kloutid = $klout->KloutIDLookupByID($network,$userid);
		echo "<strong>". $kloutid ."</strong>";
	}
	
	// Is there a Klout ID to be found?
	if (isset($kloutid)) {
		echo "<h2>Klout ID: ". $kloutid ."</h2>\n";
		$result = $klout->KloutUser($kloutid);
		echo "<pre>";
		print_r($result);
		echo "</pre>";
		
		echo "<h3>Topics</h3>\n";
		$result = $klout->KloutUserTopics($kloutid);
		echo "<pre>";
		print_r($result);
		echo "</pre>";
		
		echo "<h3>Influence</h3>\n";
		$result = $klout->KloutUserInfluence($kloutid);
		echo "<pre>";
		print_r($result);
		echo "</pre>";
	}
?>
</p>

<hr />

<h1>Klout Reverse Lookup</h1>
<p>
<h3>By Klout ID</h3>
	<form action="" method="GET">
		Klout ID: <input type="text" name="KloutID" value="725" /><br />
		Return Network Data: <select name="NetworkPlatform"><option value="tw">Twitter</option></select><br />
		<input type="submit" value="Get Network Data" />
	</form>
    
<?php 
	if (isset($kloutid)) {
		echo "<p>Network <strong>$network</strong> data for Klout ID <strong>$screenname</strong>:<br />\n";
		$networkdata = $klout->KloutIDLookupReverse($network,$kloutid);
		print_r($networkdata);
	}
?>
</p>

</body>
</html>
