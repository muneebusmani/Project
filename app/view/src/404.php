    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 400px;
        }

        h1 {
            font-size: 36px;
            color: #333333;
            margin-top: 0;
        }

        p {
            font-size: 18px;
            color: #666666;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }
    </style>
    <div class="container">
        <h1>Oops! Page Not Found</h1>
        <p>The page you're looking for doesn't exist.</p>

        <p>Go back to <a href="http://localhost<?php print_r($GLOBALS['project_root']).'home'?>">Home</a>.</p>
    </div>