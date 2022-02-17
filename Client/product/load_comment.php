<?php
$load_comment = "SELECT rate_product.*,customer.name FROM rate_product JOIN customer ON rate_product.customer_id = customer.id WHERE product_id = '$id'";
$comment_result = mysqli_query($connect, $load_comment);
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