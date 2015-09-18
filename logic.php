<?php
    //Variables
    $WordList = Array('about', 'after', 'again', 'air', 'all', 'word', 'first', 'was', 'good', 'love', 'patience', 'could'); 
    $SymbolList = Array('~', '!', '@', '#', '$', '%', '^', '&', '*', '.', '?', ';', ':', '/', '-', '_', '=', '+'); 
    $wordCount = 'wordCount';
    $addNumber = 'addNumber';
    $addSymbol = 'addSymbol';
    $addSeparator = 'addSeparator';
    $password = ''; 
    $itIsON = 'on';
    $usedNum = Array();
    #debug printout for $WordList
    //print_r ($WordList);

    #debug printout for viewing User's Input in $_POST
    //print_r ($_POST);

    //$_POST is the User Input
    $UserInput = Array($wordCount => '4', $addNumber => '', $addSymbol => '', $addSeparator => '-');

    #dummy variables for logic.php to test. 
    //$_POST = Array($wordCount => '4', $addNumber => 'on', $addSymbol => 'on', $addSeparator => '-');

# Use a foreach loop to loop through the User Inputs array
foreach($_POST as $key => $value) {
    $UserInput[$key] = $value;
} # End of FOREACH loop

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
            //echo $randNum . ' | ' . $password . ' || <br>';
            
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
?>
