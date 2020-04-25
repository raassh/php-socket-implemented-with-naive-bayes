<?php
// set some variables
$host = "127.0.0.1";
$port = 8080;
// don't timeout!
set_time_limit(0);
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// bind socket to port
$result = socket_bind($socket, $host, $port) or die("Could not bind to socket\n");
// start listening for connections
$result = socket_listen($socket, 3) or die("Could not set up socket listener\n");
$con = 1;

while ($con == 1)
{
    $spawn = socket_accept($socket);
    $input = socket_read($spawn, 2024);

    if ($input == 'Tutup') 
    {
    	echo "server di tutup";
        $close = socket_close($socket);
        $con = 0;
    }
    else if ($input == "Submit") {
	include_once 'koneksi.php';
	$result = mysqli_query($db, "select * from pesan order by tanggal desc");
	$isi = mysqli_fetch_array($result);
	$pesan= $isi['pesan'];
	$pesan2= $isi['pesan2'];
	$pesan3= $isi['pesan3'];
	$pesan4= $isi['pesan4'];
	$command = escapeshellcmd("python naives.py $pesan $pesan2 $pesan3 $pesan4");
	$output = shell_exec($command);
	echo $pesan.$pesan2.$pesan3.$pesan4;
	socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
	}
}

// // accept incoming connections
// // spawn another socket to handle communication
// $spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
// // read client input
// $input = socket_read($spawn, 1024) or die("Could not read input\n");
// // clean up input string
// echo "Client Message : ".$input;
// if ($input == "Submit") {
// 	include_once 'koneksi.php';
// 	$result = mysqli_query($db, "select * from pesan order by tanggal desc");
// 	$isi = mysqli_fetch_array($result);
// 	$pesan= $isi['pesan'];
// 	$pesan2= $isi['pesan2'];
// 	$pesan3= $isi['pesan3'];
// 	$pesan4= $isi['pesan4'];
// 	$output = shell_exec("naives.py $pesan $pesan2 $pesan3 $pesan4");
// 	echo $pesan.$pesan2.$pesan3.$pesan4;
// 	socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
// 	socket_close($spawn);
// 	socket_close($socket);
// }else{
// 	echo"bukan submit";
// }
// close sockets
?>