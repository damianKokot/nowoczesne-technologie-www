<?php
include 'db.php';
session_start();

if (isset($_SESSION['username'])){
    if (isset($_POST['content'])) {        
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $content = mysqli_real_escape_string($conn, $_POST['content']);

        $stmt = $conn->prepare('INSERT INTO comments (project_id, user_id, username, content, submit_date) VALUES (?,?,?,?,NOW())');
        $stmt->bind_param("iiss", $project_id, $user_id, $username, $content);
        $stmt->execute();
    }
}


//retrieve all comments
$stmt = $conn->prepare('SELECT * FROM `comments` WHERE `project_id` = ? ORDER BY submit_date DESC');
$stmt->bind_param("i", $project_id);
$stmt->execute();
$comments = mysqli_fetch_all($stmt->get_result(),MYSQLI_ASSOC);

foreach ($comments as $comment) {
    // Add the comment to the $html variable
    echo '
    <div class="comment">
        <p class="name">' . htmlspecialchars($comment['username'], ENT_QUOTES) . '</p>
        <p class="date">' . time_elapsed_string($comment['submit_date']) . '</p>
        <p class="content">' . (htmlspecialchars($comment['content'], ENT_QUOTES)) . '</p>
    </div>
    ';
}


?>

<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>