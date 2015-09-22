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
            <div class="pure-u-1 pure-u-lg-3-4" style="text-align:center;">
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

                <div id="PWGenBox" style="text-align:center;font-size:2em;word-wrap: break-word;">
                    <?php echo $password ?>
                </div>
                <div id="howSecureBox" style="text-align: center;font-size: 1.3em;word-wrap: break-word;background-color: #666;color: white;width: 70%;margin: auto;">
                    <?php echo $howSecureTime ?>
                        <div class="progress">
                            <div class="progress-bar <?php echo $howSecureColor ?> progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $howSecurePrecentage ?>%">
                            </div>
                        </div>
                </div>
                <br>
                <!-- HTML form used to ask user for an input -->
                <!-- the php if statements are used to set the values user entered after the form has been submitted -->
                <div style="text-align:center;">
                    <form method='GET' action='index.php' class="pure-form">
                        Enter a number: (1-9)
                        <input type='number' name='wordCount' placeholder="(1-9), default: 4" max=9 min=1 style="width: 10em" value="<?php echo $UserInput[$wordCount];?>" required>
                        <br>
                        <br> Add a number
                        <input type='checkbox' <?php if (array_key_exists($addNumber, $_GET))if ($_GET[$addNumber]=='on' ) echo 'checked';?> name='addNumber'>
                        <br>
                        <br> Add a symbol
                        <input type='checkbox' <?php if (array_key_exists($addSymbol, $_GET))if ($_GET[$addSymbol]=='on' ) echo 'checked';?> name='addSymbol'>
                        <br>
                        <br>Select a separator ( -.*^%$@! )
                        <select name="addSeparator">
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='-' ) echo 'selected';?> value="-">-</option>
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='.' ) echo 'selected';?> value=".">.</option>
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='*' ) echo 'selected';?> value="*">*</option>
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='^' ) echo 'selected';?> value="^">^</option>
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='%' ) echo 'selected';?> value="%">%</option>
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='$' ) echo 'selected';?> value="$">$</option>
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='@' ) echo 'selected';?> value="@">@</option>
                            <option <?php if (array_key_exists($addSeparator, $_GET))if ($_GET[$addSeparator]=='!' ) echo 'selected';?> value="!">!</option>
                        </select>
                        <br>
                        <br>
                        <input type='submit' value='Generate Password' class="pure-button pure-button-primary">

                    </form>
                </div>

                <?php //print_r($_POST); ?>
                    <div class="pure-g">
                        <div class="pure-u-1 pure-u-lg-1-8"></div>
                        <div class="pure-u-1 pure-u-lg-3-4" id="description">
                            <!-- Brief Description -->
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          What is xkcd password generator?
        </a>
      </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <img src="http://imgs.xkcd.com/comics/password_strength.png" width="500" alt="xkcd password strength">
                                            <a href="http://xkcd.com/936/" target="_blank">xkcd password strength original source</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pure-u-1 pure-u-lg-1-8"></div>
                        <footer>
                            <!-- include the footer.php file for credit at the bottom -->
                            <?php include("footer.php") ?>
                        </footer>
                    </div>
        </div>
        <div class="pure-u-1 pure-u-lg-1-8"></div>
    </div>
</body>

</html>
