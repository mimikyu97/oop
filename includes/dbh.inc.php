 <?php

 $servername = "localhost";
 $user = 'mimikyu';
 $pwd = 'fIT9RLSmoVBKt6AH';
 $dbName = 'oop';

 $conn = mysqli_connect($servername, $user, $pwd, $dbName);

 if(!$conn){
    die('connection failed: '. mysqli_connect_error());
 }