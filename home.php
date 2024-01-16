<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameJam Homepage</title>
    <style>
        body {
            background-color: #2e1a4a; /* Dark purple background */
            color: #fff; /* White text */
            font-family: 'SansSerif', Verdana;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            padding: 20px;
            background-color: #3f2a6d; /* Slightly lighter purple for header */
        }

        h1 {
            margin: 0;
            font-size: 36px;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
        }

        .create-team-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5d479c; /* Lighter purple for button */
            color: #fff;
            text-decoration: none;
            font-size: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .create-team-btn:hover {
            background-color: #7b6aae; /* Darker purple on hover */
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
    </style>
</head>
<body>
<header class="navbar">
    <a class="navadn" href="home.php">Home</a>
    <a class="navadn" href="team.php">Create Team</a>
    <a href="http://ers.scv.si" target="_blank">
        <img src="slike/scv.png" alt="Logo" height="40">
    </a>
    <h1>GameJam Information</h1>
</header>

<section>
    <p>Welcome to our GameJam! Here, you can find all the information you need to get started.</p>
    <p>Get ready to showcase your skills and creativity!</p>
    <a class="create-team-btn" href="team.php">Create Your Team Here</a>
</section>
</body>
</html>
