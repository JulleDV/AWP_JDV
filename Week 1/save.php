<?php
    $host = 'mysql.metropolia.fi';
    $dbname = 'juliend'; // your username
    $user = 'juliend'; // your username
    $pass = ''; // your database password
	
   // TODO: get the data from the form by using $_POST
    $data=array();
    $data['name'] = $_POST['name'];
	$data['desc'] = $_POST['desc'];
	$data['email'] = $_POST['email'];
	$data['cell'] = $_POST['cell'];
   // this is how you convert the date from the form to SQL formatted date:
   // date ("Y-m-d H:i:s", strtotime(dataFromDateField.' '.dataFromTimeField));
    $data['date'] = date ("Y-m-d H:i:s", strtotime($_POST['date'] . ' ' . $_POST['time']));
// this part was in dbConnect.php in last period:
try {

	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$DBH->query("SET NAMES 'UTF8';");

}catch(PDOException $e) {

	echo "Could not connect to database.";
	file_put_contents('log.txt', $e->getMessage(), FILE_APPEND);
}

    
try {
	// TODO: insert the data from the form to database table 'calendar'
	$STH = $DBH->prepare("INSERT INTO `juliend`.`calendar` (`ID`, `eName`, `eDescription`, `pEmail`, `pPhone`, `eDate`) VALUES (NULL, :name, :desc, :email, :cell, :date);");
	$STH->execute($data);

} catch (PDOException $e) {
	echo 'Something went wrong';
	file_put_contents('log.txt', $e->getMessage()."\n\r", FILE_APPEND); // remember to set the permissions so that log.txt can be created
}
?>
