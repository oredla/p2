<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kar Ho Lau: P2: xkcd password generator</title>
    <!-- include the head.php for CSS and other external resources -->
    <?php include("head.php") ?>
</head>

<body>
    <header>
        <div class="pure-g">
            <div class="pure-u-1 pure-u-lg-1-8"></div>
            <div class="pure-u-1 pure-u-lg-3-4">
                <h1> xkcd password generator</h1>
            </div>
            <div class="pure-u-1 pure-u-lg-1-8"></div>
        </div>
    </header>
    <div class="pure-g">
        <div class="pure-u-1 pure-u-lg-1-8"></div>
        <div class="pure-u-1 pure-u-lg-3-4">

            <!-- include the algorithm php file -->
            <?php require("logic.php") ?>

                <!-- HTML form used to ask user for an input -->
                <form method='POST' action='index.php' class="pure-form">

                    <input type='number' name='wordCount' placeholder="Enter a Number (1-9), default: 4" max=9>
                    <br>
                    <br>
                    <input type='checkbox' name='addNumber'> Add a number
                    <br>
                    <br>
                    <input type='checkbox' name='addSymbol'> Add a symbol
                    <br>
                    <br>

                    <input type='submit' value='Generate Password' class="pure-button pure-button-primary">

                </form>


                <?php print_r($_POST); ?>

                    <!-- Brief Description -->
                    <h3>What is xkcd password generator?</h3>
                    <img src="http://imgs.xkcd.com/comics/password_strength.png" width=500>
        </div>
        <div class="pure-u-1 pure-u-lg-1-8"></div>
    </div>

    <footer>
        <!-- include the footer.php file for credit at the bottom -->
        <?php include("footer.php") ?>
    </footer>

</body>

</html>
