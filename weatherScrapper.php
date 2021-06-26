<?php

    if($_GET["city"]){
        $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=fca375c1cdf8dc1f898432e928554a29");
        $weatherArray = json_decode($urlContents, true);
        if($weatherArray['cod'] == 200){
            $weather = "The weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description'].". ";
            $tempInCelsius = floor($weatherArray['main']['temp'] - 273.15);
            $weather.= " The temperature is ".$tempInCelsius."&degC and the wind speed is ".$weatherArray['wind']['speed']."m/s ";
        }else{
            $notWeather = "City not found. Try again";
        }
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title> Weather Scraper </title>

        <style type="text/css">
            
            html { 
                background: url(weather.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            
            body{
                background: none;
                color: white;
            }

            .container{
                text-align: center;
                margin-top: 200px;
                width: 470px;
            }

            label{
                font-weight: bold;
            }

            input{
                margin: 30px 0 15px 0;
            }

            #weather{
                margin-top: 10px;
            }

        </style>

    </head>
    <body>  
        
        <div class="container">

            <form>
                <div class="form-group">
                    <p><h1> What's the weather ?</h1> </p>
                    <label for="city">Enter the name of a city</label>
                    <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="Ex - London, New York etc.">
                </div>
                <button type="submit" class="btn btn-primary">Show weather</button>
            </form>

            <div id="weather"><?php
                if($weather){
                    echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                }else if($notWeather){
                    echo '<div class="alert alert-danger" role="alert">'.$notWeather.'</div>';
                }
                ?>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>