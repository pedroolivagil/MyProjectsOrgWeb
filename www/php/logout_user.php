<?php

require_once('../../config.php');
Tools::logout();
header("Location: " . _ROOT_PATH_ . "home");
