<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="project";

$conn=mysqli_connect($server_name,$username,$password,$database_name);
//now check the connection
if(!$conn)
{
	die("Connection Failed:" . mysqli_connect_error());
}
if(isset($_POST['save']))
{
	 $first_name = $_POST['fname'];
	 $last_name = $_POST['lname'];
	 $dob = $_POST['dob'];
	 $email = $_POST['email'];
	 $password = $_POST['psw'];

	 $user_check ="Select * from user_details"

	 $sql_query = "INSERT INTO user_details (first_name,last_name,dob,email,password)
	 VALUES ('$first_name','$last_name','$dob','$email','$password')";

	 if (mysqli_query($conn, $sql_query)) 
	 {
	 	 sleep(2);
		 header('Location: login.html');

	 } 
	 else
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>