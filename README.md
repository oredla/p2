# CSCI E-15, P2, Kar Ho Lau

## Live URL
<http://p2.orangeedward.xyz>

## Description
This is the 2nd assignment, P2, a php xkcd style password generator. It generates a password with a chosen number of words and optionally add a symbol and a number. After password is generated, it will also show user how secure the password is and how long it will take for a computer to guess the password at 1000 guesses/sec. 


## Demo
TBA

## Details for teaching team
* `$usedNum`: is used to store the random number used, so no words will be picked twice for the password. `Line 88 - 92`
* `$WordList`: function from `Line 28 - 41` will scrap the word list from paulnoll.com's pages (01-02, 03-04, 05-06). 

* `Line 64 - 76`: validation test. To test if user has inputted number for `$UserInput[wordCount]` and correct `$UserInput[addSeparator]` (this will dummy proof any invalid input from URL or from the html form). HTML form is also set to accept only number input from 1 to 9 as well. 

* user can choose the separator from a dropdown list.

* once validation test passed, it will go into the `else` statement from `Line 77 - 200`, the main function of this logic. 

* **How Secure is my Password?** is added from `Line 147 - 198` to calculate how long it will take to guess this password with 1000 guesses/second. 


## Outside code
* *PureCSS*: [http://purecss.io/](http://purecss.io/) for the basic responsive grid. 

* *Bootstrap*: [http://getbootstrap.com/](http://getbootstrap.com/) for the description toggle with an accordion panel and for "How Secure is My Password?". 

* *How Secure is my Password?*: inspired by [https://howsecureismypassword.net/](https://howsecureismypassword.net/), I added a meter showing how long this password would take for a computer to crack (no code taken from this website). 