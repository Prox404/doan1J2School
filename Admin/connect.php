<?php 
    $connect = mysqli_connect('localhost', 'root','','doan1j2school');
    mysqli_set_charset($connect, 'utf8');
    echo mysqli_error($connect);
?>