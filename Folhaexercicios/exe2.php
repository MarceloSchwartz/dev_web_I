<?php
    if ((isset($_POST['v1']))) {
        $v1 = $_POST['v1'];
                
        if ($v1 % 2 == 0){
            echo "O número " . " " . $v1 . " " . "é divisivel por 2";
        }else {
            echo "O número " . " " . $v1 . " " . "não é divisivel por 2";
        } 

    } 
?>    
