<?php
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
$consumerKey = "BojzoX0hbo2apAoKl7MhQrNGm";
$consumerSecret = "B1srUkfz599vBKtFiBGf6MmtgdT1KU32eEu8mQ1p9aYlYvqGcw";
$access_token = "407673525-R7cNepBNpQYFB1fNRW41H3bCSKf4ICXF6wqKKRnL";
$access_token_secret = "mzQYK3JhTQ2mbvLGgJh72PbjTcBkhDbSV3prmCnkDpGyf";
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token, $access_token_secret);
$content = $connection->get("account/verify_credentials");

$statuses = $connection->get("statuses/user_timeline", ["screen_name"=>"shafiraaputria","count" => 25, "exclude_replies" => true]);
$username = $statuses[0]->user->name;
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
            <a href="news.asp"><img href="#" src="logo.png" class="littleLogo"></a>            
            <li><a href="news.asp">Apps</a></li>
            <li><a href="contact.asp">How to Use</a></li>
            <li><a href="about.asp">About</a></li>
        </ul>
        <div class="row">
            <div class="col s12 m4 l3"> <!-- Note that "m4 l3" was added -->
                <form action="index.php" method="post">
                    <div class="row">
                        <h4 class="title">Spammer Detector</h4>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate">
                            <label for="last_name">username</label>
                        </div>
                        <div class="col s12">
                            <p>Algoritma</p>
                            <br>
                            <p>
                                <label>
                                    <input class="with-gap" name="selectedAlgo" value="boyerMoore" type="radio" checked />
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
                        </div>
                        <div class="col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="action" id="btnRight">Check</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s12 m8 l9"> 
                <h2 class="title"><?php echo $username ?></h2>
                <?php foreach ($statuses as $iter)
                    echo '<div class="postContainer"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';
                ?>
            </div>
        </div>
    </body>
    <script src="materialize.min.js"></script>        
</html>