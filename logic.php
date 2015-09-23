<?php
    #Variables
    $WordList = Array('about', 'after', 'again', 'air', 'all', 'word', 'first', 'was', 'good', 'love', 'patience', 'could', 'apple', 'orange', 'banana', 'get', 'zoo'); 
    $SymbolList = Array('!', '@', '$', '%', '^', '*', '.', '-'); 
    $wordCount = 'wordCount';
    $addNumber = 'addNumber';
    $addSymbol = 'addSymbol';
    $addSeparator = 'addSeparator';
    $itIsON = 'on';
    $password = ''; 

    #$_GET is the User Input, $UserInput used to store all the data
    $UserInput = Array();

    #Variables init for "How Secure is My Password?" 
    $lengthOfPassword = '';
    $howSecureTime = '';
    $guessPerSecond = 1000;
    $howSecureColor = '';
    $howSecurePrecentage = 0;
    $usedNum = Array();
    $returnText = '';

    #####################################
    #Function to scrap the word list files
    #####################################
    $output = Array();
    $input = Array();
    for($j = 1; $j <= 5; $j=$j+2){
        $URL1 = '0' . $j;
        $URL2 = '0' . strval($j+1);
        $scraper_URL = 'http://www.paulnoll.com/Books/Clear-English/words-' . $URL1 . '-' . $URL2 . '-hundred.html';
        //echo "scraper URL: " .$scraper_URL . " | ";
        $input = file_get_contents($scraper_URL); 
        preg_match_all("/<li>(.*?)<\/li>/s", $input, $output, PREG_SET_ORDER);
        //print_r ($output);
        for($i = 0; $i < count($output); $i++){
            array_push($WordList, trim($output[$i][1]));
        }
    }
    #debug printout for $WordList
    //print_r ($WordList);

    #dummy variables for logic.php to test. 
    //$_GET = Array($wordCount => '4', $addNumber => 'on', $addSymbol => 'on', $addSeparator => '-');

# Use a foreach loop to loop through the User Inputs array
foreach($_GET as $key => $value) {
    $UserInput[$key] = $value;
} # End of FOREACH loop

#test if user input $wordCount, if nothing input, it will initialize to -1
if(!array_key_exists($wordCount, $UserInput)){
    $UserInput[$wordCount] = 0;
}

#test if user input $addSeparator, if nothing input, it will initialize to '-'
if(!array_key_exists($addSeparator, $UserInput)){
    $UserInput[$addSeparator] = '-';
}

#Validation test for $UserInput[$wordCount]
if(!is_numeric($UserInput[$wordCount])){
    $password = "Invalid Entry: input is not numeric, pls. enter a number between 1 to 9.";
    //echo $password;
}
else if(($UserInput[$wordCount] > 9) or ($UserInput[$wordCount] < 0)){
    $password = "Invalid Entry: input is not numeric, pls. enter a number between 1 to 9.";
    //echo $password;
}
#Validation test for $UserInput[$addSeparator], it must match one of the value from the $SymbolList
else if(!in_array($UserInput[$addSeparator], $SymbolList)){
    #echo $UserInput[$addSeparator];
    $password = "Invalid Entry: Separator selected is not allowed, please choose from: -.*&amp;^%$#!.";
}
else{
    #a for loop for the total numbers of WORDS user requested ($wordCount)
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
        }//end IF loop
    } //end IF loop
    
    #add a symbol if user selected $addSymbol 
    if (array_key_exists($addSymbol, $UserInput)){
        
        #check if #$addSymbol == 'on' ($itIsON)
        if($UserInput[$addSymbol] == $itIsON){
            $randNum = rand(0,count($SymbolList)-1);
            $password = $password . $SymbolList[$randNum];
            
            #debug print the values of $randNum & $password
            //echo $randNum . ' | ' . $password . ' || <br>';
        }//end IF loop
    }//end IF loop
    
    #####################################    
    #Calculate how secure is my password? (using the xkcd example of 1000 guess/second.) 
    #####################################
    //for($k=0;$k<50;$k++){ //this for loop is for testing the calculation of the time
    //$lengthOfPassword = $k;
    
    $lengthOfPassword = strlen($password); 
    #echo $lengthOfPassword;
    
    if ($lengthOfPassword > 0){
        $howSecureTime = pow(2, $lengthOfPassword);
        //echo "<br> | howSecureTime: " . $howSecureTime;
    
        $returnText = "The Length of Password: " . $lengthOfPassword . ". It'll take ";
        
        if ($howSecureTime / $guessPerSecond / 60 < 60){
            $howSecureTime = round($howSecureTime / $guessPerSecond / 60, 2);
            $returnText = $returnText . $howSecureTime . " minute(s)";
            $howSecureColor = 0;
        }
        elseif ($howSecureTime / $guessPerSecond / 3600 < 24){
            $howSecureTime = round($howSecureTime / $guessPerSecond / 3600, 2);
            $returnText = $returnText . $howSecureTime . " hour(s)";
            $howSecureColor = 0.2;
        }
        elseif ($howSecureTime / $guessPerSecond / (3600*24) < 30){
            $howSecureTime = round($howSecureTime / $guessPerSecond / (3600*24), 2);
            $returnText = $returnText . $howSecureTime . " day(s)";
            $howSecureColor = 0.5;
        }
        elseif ($howSecureTime / $guessPerSecond / (3600*24*30) < 12){
            $howSecureTime = round($howSecureTime / $guessPerSecond / (3600*24*30), 2);
            $returnText = $returnText . $howSecureTime . " month(s)";
            $howSecureColor = 0.7;
        }
        else{
            $howSecureTime = round($howSecureTime / $guessPerSecond / (3600*24*365), 2);
            $returnText = $returnText . $howSecureTime . " year(s)";
            $howSecureColor = $howSecureTime / 3;
        }
        
        //echo " | showSecureTime: " . $howSecureTime . " | text: " .$returnText;
        
        $returnText = $returnText . " at " . $guessPerSecond . " guesses/second to guess this password.";
        
        //echo $howSecureColor; 
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
        //echo $howSecureColor; 
    }// end IF loop for How Secure is my Password? 
    //} //end for loop for testing   
} // end if
?>
