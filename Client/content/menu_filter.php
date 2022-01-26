<div class="filter">
    <form method="$_GET" action="" name="filter">
        <h3>Hãng sản xuất</h3>
        <select name="filter-manufacturer" class="filter-manufacturer">
            <option value="" selected>Tất cả</option>
            <?php foreach ($manufacturer_result as $manufacturer) { ?>
                <option value="<?php echo $manufacturer['id'] ?>"><?php echo $manufacturer['name'] ?></option>
            <?php } ?>
        </select>
        <h3>Loại sản phẩm</h3>
        <select name="filter-type" class="filter-type">
            <option value="" selected>Tất cả</option>
            <?php foreach ($type_result as $type) { ?>
                <option value="<?php echo $type['id'] ?>"><?php echo $type['name'] ?></option>
            <?php } ?>
        </select>
        <h3>Giá</h3>
        <input type="text" name="start-price" placeholder="Giá từ" value="<?php
                                                                            if (isset($_GET['start-price'])) {
                                                                                echo $_GET['start-price'];
                                                                            } else {
                                                                                echo "";
                                                                            } ?>">
        <input type="text" name="end-price" placeholder="Giá đến" value="<?php
                                                                            if (isset($_GET['end-price'])) {
                                                                                echo $_GET['end-price'];
                                                                            } else {
                                                                                echo "";
                                                                            } ?>">
        <button type="submit" class="btn btn-primary" name="filter-submit">Áp dụng</button>
    </form>
</div>

</div>