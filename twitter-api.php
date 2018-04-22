<?php
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
$consumerKey = "BojzoX0hbo2apAoKl7MhQrNGm";
$consumerSecret = "B1srUkfz599vBKtFiBGf6MmtgdT1KU32eEu8mQ1p9aYlYvqGcw";
$access_token = "407673525-R7cNepBNpQYFB1fNRW41H3bCSKf4ICXF6wqKKRnL";
$access_token_secret = "mzQYK3JhTQ2mbvLGgJh72PbjTcBkhDbSV3prmCnkDpGyf";
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token, $access_token_secret);
$content = $connection->get("account/verify_credentials");

$statuses = $connection->get("statuses/home_timeline", ["count" => 20, "exclude_replies" => true]);

$index = 0;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tugas Besar Stima 3</title>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Lobster" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="materialize.min.css" />
    <!-- <script src="main.js"></script> -->
</head>
    <body>
        <ul class="nav">
            <!-- <li><a href="default.asp">Home</a></li> -->
            <!-- <a href="news.asp"><img href="#" src="logo.png" class="littleLogo"></a>           -->
            <div class="dropdown">
                <a href="news.asp" class="dropbtn"><img href="#" src="logo.png" class="littleLogo"></a>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <li><a href="news.asp">Apps</a></li>
            <li><a href="contact.asp">How to Use</a></li>
            <li><a href="about.asp">About</a></li>
        </ul>
        <br>
        <div class="container">
            <div class="title">
                <img src="logo.png" class="bigLogo">
                <!-- <h1 id="Logo"><span id="Twitter">Twitter</span><span id="Analyzer">Analyzer</span></h1> -->
                <p id="Caption">Analyze your tweet !!</p>
            </div>
            <div class="content">
                <form action="index.php" method="post">
                    <div class="input-field col s6">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Keyword</label>
                    </div>
                    Algoritma
                    <br>
                    <!-- <div>
                        <input type="radio" name="selectedAlgo" value="boyerMoore" checked> Boyer-Moore<br>
                        <input type="radio" name="selectedAlgo" value="kmp"> KMP<br>
                        <input type="radio" name="selectedAlgo" value="Regex"> Regex
                    </div> -->
                    <p>
                        <label>
                            <input class="with-gap" name="selectedAlgo" value="boyerMoore" type="radio"/>
                            <span>Bayer-Moore</span>
                        </label>
                        <label>
                            <input class="with-gap" name="selectedAlgo" value="kmp" type="radio"/>
                            <span>KMP</span>
                        </label>
                        <label>
                            <input class="with-gap" name="selectedAlgo" value="Regex" type="radio"/>
                            <span>Regex</span>
                        </label>
                    </p>
                    <button class="btn waves-effect waves-light" type="submit" name="action" id="btnRight">Submit</button>  
                </form>
                <br>
                <hr class="style13">
                <h2>Result</h2>
                <?php
                foreach ($statuses as $iter)
                    echo '<div class="postContainer"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';
                ?>
            </div>
        </div>
    </body>
    <script src="materialize.min.js"></script>        
</html>