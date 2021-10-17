<?php

    // setcookie("category","Books",time() + 86400,"/");  // cokkies creatiuon
    // echo "Cookie is set";

    
    session_start();
    $_SESSION['username'] ="Rupesh";
    $_SESSION['favCat'] ="Books";
    echo "we have saved the session";



?>