<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Just Relax and Explore</title>

    <style>
        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/projectCSS.css"/>
</head>

<body>
    <?php include "templates/menu.php"; ?>

    <?php include "templates/Floter.php"; ?>

    <?php include "templates/Content.php"; ?>
</body>

<script src="js/scripts.js"></script>

</html>
