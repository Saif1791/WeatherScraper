<?php
$weather="";
$error="";
$city=str_replace(' ', '', $_GET['city']);
if ($_GET['city']) {
    $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $error= "Oops, that city could not be found!";
}
else {
    $page = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
    $top = explode('<p class="b-forecast__table-description-content"><span class="phrase">', $page);
    $down= explode('<h2>London Weather (4&ndash;7 days)</h2></div><p class="b-forecast__table-description-content"><span class="phrase">Light rain (total 5mm), mostly falling on Fri night. Very mild (max 16&deg;C on Fri afternoon, min 10&deg;C on Fri night). Mainly fresh winds.</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9"><div class="b-forecast__table-description-title"><h2>10 Day London Weather</h2>', $top[1]);
    $weather = $down[0];
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Weather Scraper</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<style>
    html {
        background-image: url("bg.jpg");
        background-position: center;
    }

    body {
        background-image: url("bg.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-position-x: fixed;
    }

    .container {
        width: 50%;
        margin: auto;
        text-align: center;
        margin-top: 100px;
    }
    #weather{
        margin-top: 20px;
    }
</style>

<body>
    <div class="container">
        <h1>What's the Weather?</h1>
        <p>Enter the name of the city.</p>
        <form>
            <div class="mb-3">
                <input type="text" class="form-control .col-sm-*" id="city" name="city" placeholder="eg: London, Tokyo">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="weather">
            <?php
            if($weather!=""){
            echo '<div class="alert alert-success" role="alert">' . $weather . '</div>';
            }
            else{
            echo '<div class="alert alert-danger" role="alert">' . $error  . '</div>';    
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="" async defer></script>
</body>

</html>