<?php
if (!isset($_SESSION)){
  session_start();
}

if (isset($_SESSION['username'])){
    if(time() - $_SESSION['timestamp'] > 5*60) {
      echo"<script>alert('Logging out!');</script>";
        unset(
            $_SESSION['user_id'],
            $_SESSION['username'],
            $_SESSION['success'],
            $_SESSION['timestamp']
        );
    } else {
        $_SESSION['timestamp'] = time();
    }
}
?>
