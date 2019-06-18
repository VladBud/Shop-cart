<html>
<head>
    <title>Simple PHP Shopping Cart</title>
    <link href="assets/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="shopping-cart">
    <div class="txt-heading">Shopping Cart</div>

    <a id="btnEmpty" href="/?page=cart">Empty Cart</a>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align:left;">Name</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>

            <?php if (isset($allCart)): ?>
                <?php $total_quantity = 0; $total_price = 0; ?>
                <?php foreach ($allCart as $key=>$value): ?>
                    <tr>
                        <td>
                            <img src="<?= $allCart[$key]["img"]; ?>" class="cart-item-image" /><?= $allCart[$key]["product"]; ?>
                        </td>
                        <td style="text-align:right;"><?= $allCart[$key]["quantity"]; ?></td>
                        <td  style="text-align:right;"><?= $allCart[$key]["price"]."₴"; ?></td>
                        <td style="text-align:center;">
                            <a href="index.php?action=remove&code=<?= $item["code"]; ?>" class="btnRemoveAction">
                                <img src="assets/images/icon-delete.png" alt="Remove Item" />
                            </a>
                        </td>
                    </tr>
                    <?php $total_quantity += $allCart[$key]["quantity"]; ?>
                    <?php $total_price += ($allCart[$key]["price"] * $allCart[$key]["quantity"] ); ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2" align="left">Total:</td>
                    <td align="right"><?= $total_quantity ?></td>
                    <td align="right" colspan="2">
                        <strong><?= $total_price ."₴"?></strong>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
<!--        --><?php
//    } else {
//        ?>
<!--        <div class="no-records">Your Cart is Empty</div>-->
<!--        --><?php
//    }
//    ?>
</div>
</body>
</html>
