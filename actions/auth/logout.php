<?php

session_start();
session_destroy();

header('Location: http://localhost/challenge/views/auth/login.php');