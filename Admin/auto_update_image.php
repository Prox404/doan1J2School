
<?php

if (!isset($connect)) {
  require_once './root/connect.php';
}

function checkLength($str){
  if(strlen($str > 0)){
    return true;
  }else{
    return false;
  }
}

$path    = './photos/';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));


$query = "SELECT image FROM product";
$result = mysqli_query($connect, $query);
$image_array = mysqli_fetch_assoc($result);
$db_image_array = array();

foreach ($result as $key) {
  $db_image_array[] = $key['image'];
}

foreach($files as $key => $value){
  if(in_array($value, $db_image_array)){
    $search_result = (int)array_search($value, $db_image_array);
  }else{
    $search_result = -1;
  }
  if($search_result >= 0){
    // echo 'notDelete';
  }else{
    // echo 'delete: ' . $value;
    unlink($path . $value);
  }
}
?>
