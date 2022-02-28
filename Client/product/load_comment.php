<?php
require_once './root/alert.php';

$load_comment = "SELECT rate_product.*,customer.name FROM rate_product JOIN customer ON rate_product.customer_id = customer.id WHERE product_id = '$id'";
$comment_result = mysqli_query($connect, $load_comment);
?>

<?php 

if(isset($_GET['delete_comment'])){
    $check_delete = "SELECT * FROM rate_product WHERE customer_id = $user_id and product_id = $id";
    $check_delete_result = mysqli_query($connect, $check_delete);
    if(mysqli_num_rows($check_delete_result) == 0){
        phpAlert('Anh bạn à =))');
        goto no_delete;
    }else{
        $delete_comment = "DELETE FROM rate_product WHERE customer_id = $user_id and product_id = $id";
        mysqli_query($connect,$delete_comment);
        header('location: product.php?id='.$id);
    }
    no_delete:
}

?>

<h3 style="margin-left: 15px;" id="comment_x">Đánh giá</h1>

<?php 
    if(mysqli_num_rows($comment_result) == 0){
        echo '<div class="content_container comment-box"> Chưa có đánh giá nào nào </div>';
    }
?>

<?php foreach ($comment_result as $product_comment) { ?>
    <div class="content_container comment-box">
        <img class="comment_avt" src="https://i.ibb.co/gjYSPt9/97387265-911934715945271-6195268394929881088-o.jpg" alt="">
        <div style="width: 100%">
            <div class="head-comment">
                <div class="left-head">
                    <p><?= $product_comment['name'] ?></p>
                </div>
                <div class="right-head">

                    <?php
                    $rating = $product_comment['rating'];
                    for ($i = 1; $i <= $rating; $i++) {
                        echo '
                                    <span class="fa fa-star checked"></span>
                                ';
                    }
                    for ($i = 1; $i <= 5 - $rating; $i++) {
                        echo '
                                    <span class="fa fa-star"></span>
                                ';
                    }
                        
                        if ($rating_result == 1 && $user_id == $product_comment['customer_id']){
                            // echo $check_rating_query;
                            $confirm_delete = 'Bạn muốn xóa đánh giá ư :((';
                            echo '<span><a class="fas fa-pen" title="Chỉnh sửa" href="#popup1"></a></span>';
                            echo '<span><a style="margin-left: 5px;" onclick="return confirm( \''. $confirm_delete  .'\')" class="fas fa-trash" title="Chỉnh sửa" href="?id=' . $id . '&delete_comment='. $user_id .'"></a></span>';
                        }
                    ?>
                    
                    <p></p>
                </div>
            </div>

            <div class="comment-content">
                <p><?= $product_comment['comment'] ?></p>
            </div>
        </div>
    </div>
<?php } ?>

<div id="popup1" class="overlay">
	<div class="popup">
        <?php 
            $cmt_query = "SELECT comment FROM rate_product WHERE product_id = '$id' and customer_id = '$user_id'";
            $cmt_result = mysqli_query($connect, $cmt_query);
            if(mysqli_num_rows($cmt_result) == 0){
                echo 'Anh bạn à =)) đừng phá tôi, nếu bạn vẫn phá tôi, tôi đành phải giảng hòa...';
                $old_cmt = "";
            }else{
                $old_cmt_arr = mysqli_fetch_array($cmt_result);
                $old_cmt = $old_cmt_arr['comment'];
            }

        ?>
		<h4>Sửa bình luận</h2>
		<a id="close" class="close" href="#comment_x">&times;</a>
		<div class="content" >
            <form action="" method="post">
                <fieldset class="rating">
                    <input type="radio" id="star5" name="re_rating" value="5" checked/><label class="full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4" name="re_rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3" name="re_rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                    <input type="radio" id="star2" name="re_rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="star1" name="re_rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                </fieldset>
                <textarea name="re_comment" id="" cols="30" rows="10"><?= $old_cmt ?></textarea>
                <input name="btn_edit_comment" type="submit" value="Bình luận">
            </form>
		</div>
	</div>

    