<?php
// initiate session
session_start();

// generate the random number of right value
if (empty($_SESSION['number'])) {
    $_SESSION['number'] = rand(1, 10);
}
$number = $_SESSION['number'];

// Initialize attempt count
if (empty($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta
    name="viewport" content="width=device-width, initial-scale=1"
    charset="UTF-8">
    <title>Guessing Game by Nurzafirah Izzati 206086</title>
    <style>
        body {
            text-align: center;
            font-family: monospace, sans-serif;
            color: white;
            background: url('bg.jpeg');
        }
        form {
            display: inline-block;
            text-align: left;
            border: 2px solid white;
            padding: 10px;
            border-radius: 5px;
            background-color: #ad88b0;
            color: black;
            margin-top: 20px;
        }
        h1, h3 {
            margin-bottom: 0;
        }
        #guess {
            margin-bottom: 10px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .info {
            color: blue;
            margin-top: 10px;
        }

        .myDiv {
          border: 5px outset #929cb0;
          background-color: #4a4f6e;
          text-align: center;
        }

        .centerBox{
          padding:10px;
          border:10px solid #ad88b0;
          border-radius:10px;
          width:50%;
          margin-top: 120px;
          margin-left: auto;
          margin-right: auto;


        }
    </style>
</head>

<body>
    <div class="myDiv">
    <h1>&#128640; &#8987;	&#127918;  Welcome to Number Guessing Game 	&#127918; &#8987; &#128640;</h1>
    <p></p>
    </div>

    <div class="centerBox">
    <h3>You might be the lucky one! Come on and take a guess! &#128516;</h3>
    <p>I've picked a random number from 1 to 10. Can you guess it?</p>

    <form action="" method="post">
        <label for="guess">Your Guess:</label>
        <input type="text" id="guess" name="guess" <?php if(empty($_POST['guess']) || strlen($_POST['guess']) < 1){ echo 'placeholder="Your guess is too short"'; } elseif(isset($_POST['submit'])){ if($_POST['guess']==$number) { echo 'disabled';} } ?>><br>

        <button type="submit" name="submit" <?php if(isset($_POST['submit'])){ if($_POST['guess']==$number) { echo 'disabled';} } ?>>SUBMIT</button>
        <button type="submit" name="reset">RESET</button>
    </form>

    <?php
    // if post method triggers
    if ($_POST) {
        // check if submit button pressed or not
        if (isset($_POST['submit'])) {
            // increment attempt
            $attempt = $_SESSION['attempts'] + 1;
            $_SESSION['attempts'] = $attempt;

            if(!isset($_POST['guess']) || empty($_POST['guess'])){
                echo "<div class='error'>Missing guess parameter</div>";
            } elseif (strlen($_POST['guess']) < 1) {
                echo "<div class='error'>Your guess is too short</div>";
            } elseif (!is_numeric($_POST['guess'])) {
                echo "<div class='error'>Your guess is not a number</div>";
            } elseif ($_POST['guess'] < $number) {
                echo "<div class='info'>Attempt $attempt, Your guess is too low</div>";
            } elseif ($_POST['guess'] > $number) {
                echo "<div class='info'>Attempt $attempt, Your guess is too high</div>";
            } else {
                echo "<div class='success'>Congratulations - You are right with $attempt attempt(s)</div>";
                // Destroy the session to prevent further guesses
                session_destroy();
            }

            // Display the number of attempts
            echo "<p>Number of attempts: {$_SESSION['attempts']}</p>";

          }
          elseif(isset($_POST['reset'])){
            //if reset button pressed then destroy the session
            session_destroy();
          }
        }
        ?>
</div>
</body>
</html>
