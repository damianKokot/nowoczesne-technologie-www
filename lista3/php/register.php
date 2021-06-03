<?php
include 'parts/head.php';
include 'db.php';
$currentpage='register';

if (isset($_POST['username'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

	if ($password_1 != $password_2 || $password_1 == "") {
		echo "<script>alert('Invalid password')</script>";
	} else {
		// form validation: ensure that the form is correctly filled ...
		$user_check_query = "SELECT 'username', 'email' FROM users WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($conn, $user_check_query);
	
		// if user exists
		if (mysqli_num_rows($result) == 0) {
			//encrypt the password before saving in the database
			$password_hash = password_hash($password_1, PASSWORD_DEFAULT);
	
			$query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password_hash')";
			mysqli_query($conn, $query);

			// Login
			$stmt = "SELECT `id`, `username`, `password` FROM `users` WHERE `username`=?";
			$query= $conn->prepare($stmt);
			$query->bind_param('s', $username);
			$query-> execute();
			$results = $query->get_result();
			if (mysqli_num_rows($results) == 1) {
					$row = mysqli_fetch_array($results);
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['success'] = "You are now logged in";
					$_SESSION['timestamp'] = time();
					echo "<script>window.location = 'index.php'</script>";
			} else {
				echo"<script>alert('Invalid results!');</script>";
			}
		} else {
			echo "<script>alert('User already exists!')</script>";
		}
	}
}
?>

<body>
    <?php include 'parts/navbar.php';?>

    <main id="main_body" class="auth-form"> 
			<div class="header">
				<h2>Register</h2>
			</div>
		
			<form method="post" action="register.php">
				<div class="input-group">
					<label>Username</label>
					<input type="text" name="username" value="<?php echo $username; ?>">
				</div>
				<div class="input-group">
					<label>Email</label>
					<input type="email" name="email" value="<?php echo $email; ?>">
				</div>
				<div class="input-group">
					<label>Password</label>
					<input type="password" name="password_1">
				</div>
				<div class="input-group">
					<label>Confirm password</label>
					<input type="password" name="password_2">
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="reg_user">Register</button>
				</div>
				<p>
					Already a member? <a href="login.php">Sign in</a>
				</p>
			</form>
		</main>
<?php include 'parts/footer.php';?>
