<?php
session_start();
session_destroy();  // Détruit toutes les données de session
header("Location: /main");  // Redirige vers la page de connexion
exit();