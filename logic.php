<?php
    //Variables
    $WordList = Array('about', 'after', 'again', 'air', 'all', 'word', 'first', 'was', 'good', 'love', 'patience', 'could', 'apple', 'orange', 'banana'); 
    $SymbolList = Array('!', '@', '$', '%', '^', '*', '.', '-'); 
    $wordCount = 'wordCount';
    $addNumber = 'addNumber';
    $addSymbol = 'addSymbol';
    $addSeparator = 'addSeparator';
    $itIsON = 'on';
    $password = ''; 
    #How Secure is My Password? 
    $lengthOfPassword = '';
    $howSecureTime = '';
    $guessPerSecond = '1000';
    $howSecureColor = '';
    $howSecurePrecentage ='0';
    $usedNum = Array();
    #debug printout for $WordList
    //print_r ($WordList);

    #debug printout for viewing User's Input in $_POST
    //print_r ($_POST);

    //$_GET is the User Input
    $UserInput = Array();
    //$UserInput = Array($wordCount => '4', $addNumber => '', $addSymbol => '', $addSeparator => '-');

    #dummy variables for logic.php to test. 
    //$_GET = Array($wordCount => '4', $addNumber => 'on', $addSymbol => 'on', $addSeparator => '-');

# Use a foreach loop to loop through the User Inputs array
foreach($_GET as $key => $value) {
    $UserInput[$key] = $value;
} # End of FOREACH loop

#test if user input $wordCount, if nothing input, it will automatically set it to 4
if(!array_key_exists($wordCount, $UserInput)){
    $UserInput[$wordCount] = '';
}

#test if user input $addSeparator, if nothing input, it will automatically set it to '-'
if(!array_key_exists($addSeparator, $UserInput)){
    $UserInput[$addSeparator] = '-';
}

#test if the valid number has been entered
if($UserInput[$wordCount] > 9){
    $password = "Invalid Entry: Too many words requested, pls. enter a number between 1 to 9.";
}
else if(!in_array($UserInput[$addSeparator], $SymbolList)){
    echo $UserInput[$addSeparator];
    $password = "Invalid Entry: Separator selected is not allowed, please choose from: -.*&amp;^%$#!.";
}
else{
    # a for loop for the total numbers of WORDS user requested ($wordCount)
    for($i = 0; $i < $UserInput[$wordCount]; $i++){

        #use php rand() to generate a number from 0 to total number of $WordList - 1. 
        $randNum = rand(0,count($WordList)-1);

        #use a while loop to generate unique randNum. 
        while(true){

            #test if the rand() is already in the array $usedNum 
            if(in_array($randNum, $usedNum)){

                #this is to regenerate number when $randNum is already used in $usedNum
                $randNum = rand(0,count($WordList)-1);
            }
            #take action will occur when $randNum is new. 
            else{

                #record the $randNum as used in the array $usedNum
                array_push($usedNum, $randNum);

                #add a new word to the STRING $password from the ARRAY $WordList
                $password = $password . $WordList[$randNum];

                #only add a separator when we are NOT at the very end
                if ($i < $UserInput[$wordCount] -1){
                    $password = $password . $UserInput[$addSeparator];
                }

                #debug print the values of $randNum & $password each time it is in the loop
                #echo $randNum . ' | ' . $password . ' || <br>';

                #break out of the while loop
                break;
            } #End of IF loop
        } #End of WHILE loop
    } # End of FOR loop

    #add a number to $password if user selected $addNumber. 
    if (array_key_exists($addNumber, $UserInput)){
        #check if #addNumber == 'on' ($itIsON)
        if($UserInput[$addNumber] == $itIsON){
            $randNum = rand(0,9);
            $password = $password . $randNum;
            #debug print the values of $randNum & $password
            //echo $randNum . ' | ' . $password . ' || <br>';
        }
    }
    #add a symbol if user selected $addSymbol 
    if (array_key_exists($addSymbol, $UserInput)){
        #check if #$addSymbol == 'on' ($itIsON)
        if($UserInput[$addSymbol] == $itIsON){
            $randNum = rand(0,count($SymbolList)-1);
            $password = $password . $SymbolList[$randNum];
            #debug print the values of $randNum & $password
            //echo $randNum . ' | ' . $password . ' || <br>';
        }
    }
    #Calculate how secure is my password? (using the xkcd example of 1000 guess/second.) 
    #$password = 'maria-summer-claws-own-as31-';
    $lengthOfPassword = strlen($password);
    #echo $lengthOfPassword;
    if ($lengthOfPassword > 0){
        $howSecureTime = pow(2, $lengthOfPassword);
        #echo " | exponential: " . $howSecureTime;
        $howSecureTime = $howSecureTime / $guessPerSecond / 3600 / 24;
        $howSecureColor = $howSecureTime / 3650;
        $howSecureTime = round($howSecureTime, 2);
        #echo " | time: " . $howSecureTime . " days.";
        $howSecureTime = "It'll take " . $howSecureTime . " days at " . $guessPerSecond . " guesses/second to guess this password.";
        #echo $howSecureColor; 
        if ($howSecureColor >= 0.8) {
            $howSecureColor = "progress-bar-success";
            $howSecurePrecentage = '100';
        } elseif ($howSecureColor >= 0.3) {
            $howSecureColor = "progress-bar-warning";
            $howSecurePrecentage = '70';
        } else {
            $howSecureColor = "progress-bar-danger";
            $howSecurePrecentage = '50';
        }
        #echo $howSecureColor; 
    }   
}
?>
