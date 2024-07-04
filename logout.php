<?php

# Sessiondaten löschen
session_start();

session_destroy();

# Weiterleitung zum Login
header('Location: index.php');

