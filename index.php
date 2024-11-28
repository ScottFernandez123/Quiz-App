<?php
$conn = new mysqli('localhost', 'root', '', 'quiz');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $check_user = $conn->query("SELECT * FROM leaderboard WHERE user_name = '$user_name'");
    if ($check_user->num_rows > 0) {
        
        echo "<script>
                alert('You have already taken the quiz!');
                window.location.href = 'index.php';
              </script>";
        exit();
    } else {
        header('Location: submit.php?name=' . urlencode($user_name));
        exit();
    }
}


$result = $conn->query("SELECT * FROM questions ORDER BY RAND()");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roman History Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #f4f4f4;
        }
        form {
            margin: 20px auto;
            text-align: left;
            display: inline-block;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #333;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Roman History Quiz</h1>
    <form method="POST">
        <label for="user_name">Your Name:</label><br>
        <input type="text" id="user_name" name="user_name" required><br><br>
        <?php $question_num = 1; ?>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <p><?php echo $question_num . '. ' . $row['question']; ?></p>
            <input type="radio" name="q<?php echo $row['id']; ?>" value="1" required> <?php echo $row['option1']; ?><br>
            <input type="radio" name="q<?php echo $row['id']; ?>" value="2"> <?php echo $row['option2']; ?><br>
            <input type="radio" name="q<?php echo $row['id']; ?>" value="3"> <?php echo $row['option3']; ?><br>
            <input type="radio" name="q<?php echo $row['id']; ?>" value="4"> <?php echo $row['option4']; ?><br><br>
            <?php $question_num++; ?>
        <?php } ?>
        <button type="submit">Submit Quiz</button>
    </form>
</body>
</html>
