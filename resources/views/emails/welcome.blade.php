<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <style type="text/css">
        ul {
            list-style: none;
            margin:0;
            padding:0;
        }
        ul li{
            font-size: 18px;
            font-weight: 100;
            padding: 5px;
        }
        </style>
    </head>
    
    <body style="max-width: 1000px;">
    
    <div style="background-color: #333333; padding: 10px; color: #FFF; text-align: center; border-radius: 4px 4px 0 0;">
    Wisheek
    </div>

    <div style="background-color: rgba(0,0,0,0.04); padding: 50px; text-align: center;">

        <h1 style="font-weight: 100; margin-top:0;"><img src="<?php echo $message->embed('../public/img/welcome.png'); ?>" width="400";  style="display: inline-block;"></h1>
        <div style="margin: 15px 0; font-size: 18px">You registered to Woofyard with following info</div>

        <ul>
        <li>Username: <b>{!! $username !!}</b></li>
        <li>First Name: <b>{!! $first_name !!}</b></li>
        <li>Last Name: <b>{!! $last_name !!}</b></li>
        <li>Password: <b>{!! $password !!}</b></li>
        </ul>

    </div>


    </body>
</html>