<?php 

function checkPassword($str){
    $passwordStrongRegex = '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*(?=.*[0-9]).*$/m';

    if (preg_match($passwordStrongRegex, $str)){
        return true;
    }else{
        return false;
    }
}

?>