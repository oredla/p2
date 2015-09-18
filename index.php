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
            
            <div id="PWGenBox" style="text-align:center;font-size:3em;"> <?php echo $password ?></div>
                <!-- HTML form used to ask user for an input -->
                <!-- the php if statements are used to set the values user entered after the form has been submitted -->
                <form method='POST' action='index.php' class="pure-form">
                    Enter a number: (1-9)
                    <input type='number' name='wordCount' placeholder="(1-9), default: 4" max=9 min=1 style="width: 10em" value="<?php echo $UserInput[$wordCount];?>" required>
                    <br>
                    <br> Add a number
                    <input type='checkbox' <?php if ($UserInput[$addNumber] == 'on') echo 'checked';?> name='addNumber'>
                    <br>
                    <br> Add a symbol
                    <input type='checkbox' <?php if ($UserInput[$addSymbol] == 'on') echo 
'checked';?> name='addSymbol'>
                    <br>
                    <br>Select a separator ( -.*&amp;^%$#! )
                    <select name="addSeparator">
                        <option <?php if($UserInput[$addSeparator] == '-') echo 'selected';?>value="-">-</option>
                        <option <?php if($UserInput[$addSeparator] == '.') echo 'selected';?> value=".">.</option>
                        <option <?php if($UserInput[$addSeparator] == '*') echo 'selected';?> value="*">*</option>
                        <option <?php if($UserInput[$addSeparator] == '&') echo 'selected';?> value="&">&amp;</option>
                        <option <?php if($UserInput[$addSeparator] == '^') echo 'selected';?> value="^">^</option>
                        <option <?php if($UserInput[$addSeparator] == '%') echo 'selected';?> value="%">%</option>
                        <option <?php if($UserInput[$addSeparator] == '$') echo 'selected';?> value="$">$</option>
                        <option <?php if($UserInput[$addSeparator] == '#') echo 'selected';?> value="#">#</option>
                        <option <?php if($UserInput[$addSeparator] == '@') echo 'selected';?> value="@">@</option>
                        <option <?php if($UserInput[$addSeparator] == '!') echo 'selected';?> value="!">!</option>
                        
                    </select>
                    <br>
                    <br>
                    <input type='submit' value='Generate Password' class="pure-button pure-button-primary">

                </form>


                <?php //print_r($_POST); ?>
                
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
