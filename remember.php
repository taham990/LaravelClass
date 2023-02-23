<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
	<title>tamrine01</title>
	<style>
		/* style */
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			margin: 0;
		}

		.container {
			display: flex;
			width: 80%;
			height: 70%;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
			border-radius: 10px;
			overflow: hidden;
		}

		.form-container {
			flex: 1;
			padding: 50px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		.form-container h2 {
			margin-bottom: 30px;
		}

		.form-container form {
			display: flex;
			flex-direction: column;
			width: 100%;
		}

		.form-container label {
			margin-bottom: 10px;
		}

		.form-container input {
			padding: 10px;
			margin-bottom: 20px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 0 5px rgba(0,0,0,0.1);
			font-size: 16px;
		}

		.form-container button {
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			transition: background-color 0.3s;
		}

		.form-container button:hover {
			background-color: #3e8e41;
		}

	</style>
</head>
<body>






<?php



class rempass
{
    function remember($rem_username)
    {
        //database
        $server_n = "localhost";
        $db_n = "tamrine01";
        $user_n = "root";
        $password = "";

        $conn = mysqli_connect($server_n,$user_n,$password,$db_n);
        mysqli_query($conn,"SET NAMES 'utf8mb4'");
        if(!$conn)
        {
            die( "connection failed : " . mysqli_connect_error());
        }
        $conn->query("set NAMES utf8");
        $conn->query("set CHARACTER SET utf8");




		$sql_rem = "SELECT * FROM `users` WHERE `users`.`Username` = '$rem_username'";
		$result_rem = $conn->query($sql_rem);
		$final_rem = $result_rem->fetch_assoc(); 
		if($final_rem)
			return $final_rem['Password'];
		else
			return false;

    }
}


$person=new rempass();
if(isset($_POST['sabt']))
{
   
   if($person->remember($_POST['username']))
        $result = "گذرواژه شما برابر است با : ".$person->remember($_POST['username']);
    else
        $result = "نام کاربری موجود نمیباشد";
}


?>





<div class="form-container" style="background-color: #f2f2f2;">

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="ussername">نام کاربری</label>
        <input type="text" name="username" id="username">
        <p><?php if(isset($result)){ echo $result;}?> </p>
        <button type="submit" name="sabt">ثبت</button> <br>
        <a href="reg_log.php">بازگشت به صفحه اصلی </a>
    </form>


</div>


</body>

</html>