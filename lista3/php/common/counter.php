<?php
include 'db.php';

$stmt = $conn->prepare("SELECT `id` FROM `counter` WHERE `ip` = ? AND TIMESTAMPADD(DAY, 1, `timestamp`) > FROM_UNIXTIME(?)");

$ip = getVisitorIp();
$timestamp = time();

$stmt->bind_param("si", $ip, $timestamp);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) == 0){
    mysqli_query($conn, "INSERT INTO `counter` (`ip`) VALUES('$ip')");
}

$query_count = "SELECT COUNT(*) AS `count` FROM `counter`";
$result_counter = mysqli_query($conn, $query_count);
$counter = mysqli_fetch_array($result_counter)['count'];

echo("Visitors: $counter");

function getVisitorIp() {
    if (!empty($_SERVER['REMOTE_ADDR'])) {
      $ip=$_SERVER['REMOTE_ADDR'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    return $ip;
}
?>