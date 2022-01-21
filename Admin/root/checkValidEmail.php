<?php 
    if(!isset($connect)){
        require_once 'connect.php';
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];

        $query = "SELECT * FROM employee WHERE email = '$email'";
        $rows = mysqli_query($connect,$query);
		$count = mysqli_num_rows($rows);

        if($count >=1){
            echo 1;
        }else{
            echo 0;
        }
    }
    
?>