<?php
unset($_SESSION['username'],$_SESSION['loggedin']);
header('location:home');