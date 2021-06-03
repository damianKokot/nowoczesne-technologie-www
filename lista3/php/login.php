<?php include 'parts/head.php';?>
<?php $currentpage='login'; ?>

<?php
include 'db.php';

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    if (!empty($username) && !empty($password)) {
        $stmt = "SELECT `id`, `username`, `password` FROM `users` WHERE `username`=?";
        $query= $conn->prepare($stmt);
        $query->bind_param('s', $username);
        $query-> execute();
        $results = $query->get_result();
        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_array($results);
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['success'] = "You are now logged in";
                $_SESSION['timestamp'] = time();
                echo "<script>window.location = 'index.php'</script>";
            } else {
              echo"<script>alert('Invalid name or password!');</script>";
            }
        } else {
          echo"<script>alert('Invalid name or password!');</script>";
        }
    }
}
?>

<body>
    <?php include 'parts/navbar.php';?>

    <main id="main_body" class="auth-form">
        <div class="header">
          <h2>Login</h2>
        </div>
  
        <form method="post" action="login.php">
            <div class="input-group">
              <label>Login</label>
              <input type="text" name="username" >
            </div>
            <div class="input-group">
              <label>Password</label>
              <input type="password" name="password">
            </div>
            <div class="input-group">
              <button type="submit" class="btn" name="login_user">Login</button>
            </div>
            <p>
              Don't have an account? <a href="register.php">Register!</a>
            </p>
        </form>
    </main>
<?php include 'parts/footer.php';?>