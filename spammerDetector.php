<?php
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
$consumerKey = "BojzoX0hbo2apAoKl7MhQrNGm";
$consumerSecret = "B1srUkfz599vBKtFiBGf6MmtgdT1KU32eEu8mQ1p9aYlYvqGcw";
$access_token = "407673525-R7cNepBNpQYFB1fNRW41H3bCSKf4ICXF6wqKKRnL";
$access_token_secret = "mzQYK3JhTQ2mbvLGgJh72PbjTcBkhDbSV3prmCnkDpGyf";
$connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token, $access_token_secret);
$content = $connection->get("account/verify_credentials");
$numTweet = 25;
if(isset($_POST["userName"])){
    $statuses = $connection->get("statuses/user_timeline", ["screen_name"=>$_POST["userName"],"count" => $numTweet, "exclude_replies" => true]);
    $username = $statuses[0]->user->name;
}
$spamCount = 0;
$arSpam = array();
if(isset($_POST["userName"])){
    foreach ($statuses as $iter){
        $flagSpam = exec("python RE_spammerDetector.py \"$iter->text\"");
        array_push($arSpam,$flagSpam);
        if($flagSpam != "-1"){
            $spamCount ++;
        }
    }
    $numTweet = count($arSpam);
    if($numTweet % 2 == 0){
        if($spamCount >= ($numTweet/2)){
            $category = "Spammer";
            $colorCount = "Red";
        }else{
            $category = "Clean";
            $colorCount = "#008CBA";
        }
    }else{
        if($spamCount >= (($numTweet+1)/2)){
            $category = "Spammer";
            $colorCount = "Red";
        }else{
            $category = "Clean";
            $colorCount = "#008CBA";
        }
    }
}
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
            <a href="index.php"><img href="#" src="logo.png" class="littleLogo"></a>            
            <li><a href="homeDetector.php">Home Detector</a></li>
            <li><a href="spammerDetector.php">Spammer Detector</a></li>            
            <li><a href="homeDetector.php">How to Use</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        <div class="row">
            <div class="col s12 m4 l3"> <!-- Note that "m4 l3" was added -->
                <form action="spammerDetector.php" method="post">
                    <div class="row">
                        <h4 class="title">Spammer Detector</h4>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" name="userName" class="validate">
                            <label for="last_name">username</label>
                        </div>
                        <div class="col s12">
                            <p>Algoritma</p>
                            <br>
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
                        </div>
                        <div class="col s12">
                            <button class="btn waves-effect waves-light cyan accent-4" type="submit" name="action" id="btnRight">Check</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s12 m8 l9">
                <h2 class="title"><?php  
                if(isset($_POST["userName"]))
                echo $username
                ?></h2>
                <h3 style="margin-top :  5px; text-align :  center; color : #008CBA"><?php if(isset($_POST["userName"])){echo "is";}?><br><span style="color : <?php if(isset($_POST["userName"])){echo $colorCount;}?>;"><?php if(isset($_POST["userName"])){echo $category;}?></span></h3> 
                <p style="color : #008CBA;"><?php if(isset($_POST["userName"])){echo "Detect";}?> : <span style= "color : <?php if(isset($_POST["userName"])){echo $colorCount;}?>;"><?php if(isset($_POST["userName"])){echo $spamCount;}?></span><?php if(isset($_POST["userName"])){echo " from ",$numTweet;}?></p>
                <?php 
                if(isset($_POST["userName"])){
                    $i = 0;
                    foreach ($statuses as $iter){
                        if($arSpam[$i] == "-1"){
                            echo '<div class="postContainer">
                                    <img src=',$iter->user->profile_image_url,' alt="" class="circle">
                                    <div>
                                        <div class="name">
                                            <a id="screenName" href="#">',$iter->user->name,' </a>
                                            <span id="username">@',$iter->user->screen_name,'</span>
                                        </div>
                                        <div class="tweetText">
                                            <p>',$iter->text,'</p>
                                        </div>
                                    </div>
                                </div>';
                        }else{
                            echo '<div class="postContainer spam">
                                    <img src=',$iter->user->profile_image_url,' alt="" class="circle">
                                    <div>
                                        <div class="name">
                                            <a id="screenName" href="#">',$iter->user->name,' </a>
                                            <span id="username">@',$iter->user->screen_name,'</span>
                                        </div>
                                        <div class="tweetText">
                                            <p>',$iter->text,'</p>
                                        </div>
                                    </div>
                                </div>';
                        }
                        $i++;
                    }
                }
                ?>
            </div>
        </div>
    </body>
    <script src="materialize.min.js"></script>        
</html>