<?php
session_start();
session_destroy();
session_regenerate_id(TRUE);
include("sign_in_form.php");
?>