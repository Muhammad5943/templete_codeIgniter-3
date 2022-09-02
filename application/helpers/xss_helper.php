<?php
    function xss_function($x){
        echo htmlentities($x, ENT_QUOTES, 'UTF-8');
    }
?>