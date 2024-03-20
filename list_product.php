<?php
    require_once("product.class.php");
?>
<?php
    include_once("header.php");
    $prods = Product::list_product();
?>
<table>
    <tr>
        <th>ID sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Số lượng</th>
        <th>Mô tả</th>
        <th>Hình ảnh</th>
    </tr>
    <?php foreach($prods as $item): ?>
    <tr>
        <td><?php echo $item["ProductID"]; ?></td>
        <td><?php echo $item["ProductName"]; ?></td>
        <td><?php echo $item["Price"]; ?></td>
        <td><?php echo $item["Quantity"]; ?></td>
        <td><?php echo $item["Description"]; ?></td>
        <td><img src="<?php echo $item["Picture"]; ?>" alt="<?php echo $item["ProductName"]; ?>" style="width: 100px; height: 100px;"></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include_once("footer.php"); ?>
