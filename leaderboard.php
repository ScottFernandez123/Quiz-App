<?php
$conn = new mysqli('localhost', 'root', '', 'roman_quiz');
$result = $conn->query("SELECT user_name, score FROM leaderboard ORDER BY score DESC, created_at ASC LIMIT 10");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .button-container {
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Leaderboard</h1>
    <table>
        <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Score</th>
        </tr>
        <?php
        $rank = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>$rank</td>";
            echo "<td>{$row['user_name']}</td>";
            echo "<td>{$row['score']}</td>";
            echo "</tr>";
            $rank++;
        }
        ?>
    </table>

    <!-- Retake Quiz Button -->
    <div class="button-container">
        <button onclick="location.href='index.php'">Take the Quiz Again</button>
    </div>
</body>
</html>
