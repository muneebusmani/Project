<?php
ob_start();
?>
    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>JusticiaLaw</title>
    <!--This code will load every css and js including bootstrap, libraries, etc which i have placed inside their respective folders-->
    <?php
    user::inc_favicon()?>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="app/view/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="app/view/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <?php
    user::inc_css();
    ?>
    </head>