<?php
$conn = new mysqli('localhost', 'root', '', 'quiz');
$user_name = $_GET['name'];
$score = 0;

// Calculate the score
foreach ($_POST as $key => $value) {
    if (strpos($key, 'q') === 0) {
        $question_id = str_replace('q', '', $key);
        $result = $conn->query("SELECT correct_option FROM questions WHERE id = $question_id");
        $row = $result->fetch_assoc();
        if ($row['correct_option'] == $value) {
            $score++;
        }
    }
}

// Save the score to the leaderboard
$conn->query("INSERT INTO leaderboard (user_name, score) VALUES ('$user_name', $score)");

header('Location: leaderboard.php');
exit();
?>
