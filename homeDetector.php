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
<!-- <!DOCTYPE html> -->
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
                <form action="homeDetector.php" method="post">
                    <div class="row">
                        <h4 class="title">Home Detector Spam</h4>
                        <div class="input-field col s6">
                            <input id="last_name" name="keyWord" type="text" class="validate">
                            <label for="last_name">Keyword</label>
                        </div>
                        <div class="col s12">
                            <p>Algoritma</p>
                            <br>
                            <p>
                                <label>
                                    <input class="with-gap" name="selectedAlgo" value="Boyer-moore" type="radio"/>
                                    <span>Bayer-Moore</span>
                                </label>
                                <label>
                                    <input class="with-gap" name="selectedAlgo" value="Kmp" type="radio"/>
                                    <span>KMP</span>
                                </label>
                                <label>
                                    <input class="with-gap" name="selectedAlgo" value="Regex" type="radio"/>
                                    <span>Regex</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light cyan accent-4" type="submit" name="action" id="btnRight">Detect</button>  
                </form>
            </div>
            <div class="col s12 m8 l9"> 
                <h2 class="title">Result</h2>
                <p style="color : lightblue;">Keyword : <?php 
                if (isset($_POST["keyWord"])){
                    echo $_POST["keyWord"];
                } 
                ?> </p>
                <p style="color : lightpink;">Selected Algoritma : <?php 
                if (isset($_POST["selectedAlgo"])){
                    echo $_POST["selectedAlgo"];
                } 
                ?>
                </p>
                <?php
                if(!isset($_POST["keyWord"])){
                    foreach ($statuses as $iter){
                        echo '<div class="postContainer"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';
                    }                    
                }else{
                    foreach ($statuses as $iter){
                        if($_POST["selectedAlgo"] == "Boyer-moore"){
                            // echo '<div class="postContainer"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';
                            $key = $_POST["keyWord"];
                            if(exec("python BM.py $key \"$iter->text\"") == "-1"){
                                echo '<div class="postContainer"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';
                            }else{
                                echo '<div class="postContainer spam"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';                                
                            }
                        }
                        if($_POST["selectedAlgo"] == "Kmp"){
                            // echo '<div class="postContainer"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';
                            $key = $_POST["keyWord"];
                            if(exec("python KMP.py $key \"$iter->text\"") == "-1"){
                                echo '<div class="postContainer"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';
                            }else{
                                echo '<div class="postContainer spam"><div class="name"><a id="screenName" href="#">',$iter->user->name,' </a><span id="username">@',$iter->user->screen_name,'</span></div><div class="tweetText"><p>',$iter->text,'</p></div></div>';                                
                            }
                        }
                    }

                } 
                ?>
            </div>
        </div>
    </body>
    <script src="materialize.min.js"></script>        
</html>