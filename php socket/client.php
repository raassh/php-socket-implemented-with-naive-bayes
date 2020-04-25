<body>
	<form method="post" action="client.php">
	<td>
	<tr>Harga Minyak USD<input type="text" name="message"> </tr>
	<tr>EUR_IDR<input type="text" name="message2"> </tr>
	<tr>USD_IDR<input type="text" name="message3"> </tr>
	<tr>VOL<input type="text" name="message4"> </tr>
	<input type="submit" name="Submit" value="Submit">
	<input type="submit" name="Close" value="Tutup">
	</td>
	</form>
</body>
<?php
if(isset($_POST['Submit'])) {
	include_once 'koneksi.php';
	include_once 'autoincr.php';
	$arr = mysqli_query($db, "SELECT * FROM pesan ORDER BY tanggal DESC");
	$kda = mysqli_fetch_array($arr);
	$id= autonumber($kda['id'], 3, 4);
	$message = $_POST["message"];
	$message2 = $_POST["message2"];
	$message3 = $_POST["message3"];
	$message4 = $_POST["message4"];
	$trigger = $_POST['Submit'];
	// $output = shell_exec("naives.py $satu $dua $tiga $empat");
	// echo $output;
	// send string to server
	$result = mysqli_query($db, "INSERT INTO pesan(id,pesan, pesan2, pesan3, pesan4,tanggal) VALUES('$id','$message','$message2','$message3','$message4',current_timestamp)");
	if($result) // will return true if succefull else it will return false
        {
        // code here
        $host    = "127.0.0.1";
		$port    = 8080;
		// create socket
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		// connect to server
		$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
		socket_write($socket, $trigger, strlen($trigger)) or die("Could not send data to server\n");
		// get server response
		$result = socket_read ($socket, 1024) or die("Could not read server response\n");
		echo "Reply From Server  :".$result;
		// close socket
		socket_close($socket);
        }else{
            echo "Error: " . $result . "<br>" . $db->error;
        }
}else if (isset($_POST['Close'])) {
		$host    = "127.0.0.1";
		$port    = 8080;
		$trigger = $_POST['Close'];
		echo "server di tutup";
		// create socket
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		// connect to server
		$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
		socket_write($socket, $trigger, strlen($trigger)) or die("Could not send data to server\n");
} 

?>