<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamName = $_POST["teamName"];
    $email1 = $_POST["email1"];
    $email2 = $_POST["email2"];
    $email3 = $_POST["email3"];
    $email4 = $_POST["email4"];

    // Validate emails
    $validEmails = validateEmails([$email1, $email2, $email3, $email4]);

    // Check for duplicate emails
    $duplicateEmails = checkDuplicateEmails([$email1, $email2, $email3, $email4]);

    if ($validEmails && empty($duplicateEmails)) {
        // Check for existing team name
        $existingTeam = checkExistingTeam($teamName);

        if (!$existingTeam) {
            // Save to the database
            $sql = "INSERT INTO teams (team_name, email1, email2, email3, email4) 
                    VALUES ('$teamName', '$email1', '$email2', '$email3', '$email4')";

            if ($conn->query($sql) === TRUE) {
                echo "Shranjeno.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Ime '$teamName' že obstaja.";
        }
    } else {
        $errorMsg = '';

        if (!$validEmails) {
            $errorMsg .= "Uporabi šolski email. ";
        }

        if (!empty($duplicateEmails)) {
            $errorMsg .= "Ne uporabi isti email večkrat. ";
        }

        echo "Error: " . $errorMsg;
    }
}

// Function to validate emails
function validateEmails($emails)
{
    foreach ($emails as $email) {
        if (!empty($email) && (!filter_var($email, FILTER_VALIDATE_EMAIL) || !endsWith($email, '@scv.si'))) {
            return false;
        }
    }
    return true;
}

// Function to check for duplicate emails
function checkDuplicateEmails($emails)
{
    $nonEmptyEmails = array_filter($emails, function($email) {
        return !empty($email);
    });

    $uniqueEmails = array_unique($nonEmptyEmails);

    return count($nonEmptyEmails) != count($uniqueEmails);
}

// Function to check if a string ends with a specific suffix
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    return $length === 0 || (substr($haystack, -$length) === $needle);
}

// Function to check for existing team name in the database
function checkExistingTeam($teamName)
{
    global $conn;

    $result = $conn->query("SELECT team_id FROM teams WHERE team_name = '$teamName'");

    return $result->num_rows > 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Team</title>
    <style>
        body {
            font-family: 'SansSerif', Verdana;
            background-color: #2e1a4a;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin: 0;
            padding: 0;
        }

        form {
            display: inline-block;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 2px solid #5d479c;
            border-radius: 5px;
            background-color: #3f2a6d;
            color: #fff;
        }

        input[type="submit"] {
            background-color: #5d479c;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #7b6aae;
        }
        a {
            text-decoration: none; /* Remove underline */
            color: white; /* Match the background color */
        }
        .navbar {
            overflow: hidden;
        }

        .navbar .navadn {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar img {
            float: right;
            padding: 10px;
        }
        header {
            padding: 20px;
            background-color: #3f2a6d; /* Slightly lighter purple for header */
        }
    </style>
</head>
<body>
<header class="navbar">
    <a class="navadn" href="home.php">Home</a>
    <a class="navadn" href="team.php">Create Teams</a>
    <a href="http://ers.scv.si" target="_blank">
        <img src="slike/scv.png" alt="Logo" height="40">
    </a>
</header>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <br><br>
    <label for="teamName">Team Name:</label>
    <input type="text" name="teamName" required>

    <label for="email1">Email 1:</label>
    <input type="email" name="email1" required>

    <label for="email2">Email 2:</label>
    <input type="email" name="email2">

    <label for="email3">Email 3:</label>
    <input type="email" name="email3">

    <label for="email4">Email 4:</label>
    <input type="email" name="email4">

    <input type="submit" value="Create Team">
</form><br>
<a href="home.php">Back to Homepage</a>
</body>
</html>
