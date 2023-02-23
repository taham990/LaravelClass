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


















<!-- validation -->
<?php
$name_e = $username_e = $email_e = $password_e = " ";
$namei =  $usernamei = $emaili = $passwordi = " ";
$flag = false;
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['register']))
{
// namei
if(strlen($_POST['name1']) < 2 )
{
	$name_e = "نام وارد شده صحیح نمیباشد";
	$flag = true;
}
else
	$namei = $_POST['name1'];

// usernamei
if(strlen($_POST['username']) < 2 or strlen($_POST['username']) > 20 or empty($_POST['username']))
{
	$username_e = "نام کاربری صحیح نمیباشد";
	$flag = true;
}
else
	$usernamei = $_POST['username'];

// passwordi
if(empty($_POST['password']) || strlen($_POST['password']) < 3)
{
	$password_e = "گذرواژه شما صحیح نمیباشد";
	$flag = true;
}
else
	$passwordi = $_POST['password'];

// emaili
if(empty($_POST['email']) or strlen($_POST['email']) < 5 )
{
	$email_e = "ایمیل وارد شده صحیح نمیباشد";
	$flag = true;
}
else
	$emaili = $_POST['email'];
}











//database
// $server_n = "localhost";
// $db_n = "tamrine01";
// $user_n = "root";
// $password = "";

// $conn = mysqli_connect($server_n,$user_n,$password,$db_n);
// mysqli_query($conn,"SET NAMES 'utf8mb4'");
// if(!$conn)
// {
//     die( "connection failed : " . mysqli_connect_error());
// }
// $conn->query("set NAMES utf8");
// $conn->query("set CHARACTER SET utf8");






$is_logined = false;
if(!$flag)
{
// class users
class users {
	private $name,$Email,$username,$password;
	function get_information($name,$username,$email,$password)
	{
        if($this->password = $password && $this->name = $name && $this->username = $username && $this->email = $email)
			return true;
		else
			return false;
		
	}
	function register($name,$username,$email,$password)
	{
		$sqlgoto_db = "INSERT INTO `users` (`Name`,`Username`,`Password`,`Email`)
		 VALUES('$name','$username','$password','$email')";

		//database
		$server_n = "localhost";
		$db_n = "tamrine01";
		$user_n = "root";
		$password = "";

		$conn = mysqli_connect($server_n,$user_n,$password,$db_n);
		//mysqli_query($conn,"SET NAMES 'utf8mb4'");
		if(!$conn)
		{
			die( "connection failed : " . mysqli_connect_error());
		}
		$conn->query("set NAMES utf8");
		$conn->query("set CHARACTER SET utf8");
		//register
		$result_reg = $conn->query("$sqlgoto_db");
		if($result_reg)
			return true;
	}
	function login($username , $passwordo)
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

		//login
		$sql_log = "SELECT * FROM `users` WHERE `users`.`Password` = '$passwordo'";
		$result_log = $conn->query($sql_log);
		$final_log = $result_log->fetch_assoc();
		if($final_log)
		{
			if($final_log['Username'] ==  $username)
			{
				return true;
			}
			else	
				return false;
		}
		else	
			return false;
	}
    
}

$person = new users();

//check register
if(isset($_POST['register']))
{
	if($person->get_information($namei,$usernamei,$emaili,$passwordi))
	{
		if($person->register($namei,$usernamei,$emaili,$passwordi))
			$check_reg = "ثبت نام با موفقیت انجام شد";
		else
			$check_reg = "ثبت نام انجام نشد";
	}
	else
		$check_reg ="اطلاعات کلاس خطا";
}
// check ligin
if(isset($_POST['login']))
{

	if($person->login($_POST['usernamel'],$_POST['passwordl']))
	{
		$check_log = "تبریک !  ورود با موفقیت انجام شد";
	}
	else
		$check_log = "نام کاربری یا رمز اشتباه است";
}

}












?>

<!-- form -->

	<div class="container">
		<div class="form-container" style="background-color: #f2f2f2;">
			<h2>ثبت نام</h2>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<label for="name1">نام</label>
				<input type="text" id="name1" name="name1" placeholder="Enter your name">
				<p style="color:red"><?php echo $name_e;?></p> <br>


				<label for="username">نام کاربری</label>
				<input type="text" id="username" name="username" placeholder="Enter your username">
				<p style="color:red"><?php echo $username_e;?></p> <br>

                <label for="email">ایمیل</label>
				<input type="email" id="email" name="email" placeholder="Enter your email">
				<p style="color:red"><?php echo $email_e;?></p> <br>

				<label for="password">گذرواژه</label>
				<input type="password" id="password" name="password" placeholder="Enter your password">
				<p style="color:red"><?php echo $password_e;?></p> <br>

				<button type="submit" name="register">ثبت نام</button>
				<p><?php if(isset($check_reg)){echo $check_reg;} ?></p>
			</form>
		</div>
		<div class="form-container" style="background-color: #e6e6e6;">
			<h2>ورود</h2>
			<form action="#" method="POST">
                <label for="usernamel">نام کاربری</label>
				<input type="text" id="usernamel" name="usernamel" placeholder="Enter your username">

				<label for="password">گذرواژه</label>
				<input type="passwordl" id="passwordl" name="passwordl" placeholder="Enter your password">
				<button type="submit" name="login">ورود</button> <br> 
				<p style="color:red	"><?php if(isset($check_log)){echo $check_log;} ?></p> <br> <br>
				<a href="remember.php">فراموشی گذرواژه</a>
			</form>
		</div>
	</div>

</body>
</html>

