<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <style>
        html,
        body {
            margin: 0;
            padding: 10px;
            font-size: 20px;
        }

        input {
            font-family: georgia, times;
            font-size: 24px;
            line-height: 1.2em;
        }

        a {
            color: blue;
            font-family: georgia, times;
            line-height: 1.2em;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            color: #000000;
            font-size: 41px;
            border-bottom: 1px dotted #cccccc;
        }

        td {
            padding: 1px 30px 1px 0;
        }
    </style>
</head>

<body>
    <h1><?php echo $title ?></h1>