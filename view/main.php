<?php

?>

<html>
<head>
    <title>Simple PHP Shopping Cart</title>
    <link href="assets/style.css" type="text/css" rel="stylesheet" />
</head>
<body>

<div id="product-grid">
    <a id="btnEmpty" href="/?page=cart"><img width="40" src="/assets/images/shopping-cart.jpg"></a>
    <div class="txt-heading">Products</div>
        <?php if (isset($products)): ?>
            <?php foreach ($products as $key=>$value): ?>
                <div class="product-item">
                    <form method="post" action="/">
                        <div class="product-image"><img src="<?= $products[$key]["img"]; ?>"></div>
                        <div class="product-tile-footer">
                            <div class="product-title"><?= $products[$key]["name"]; ?></div>
                            <div class="product-price"><?= $products[$key]["price"]."₴"; ?></div>
                            <div class="cart-action">
                                <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                <input type="text" name="title" hidden value="<?= $products[$key]["name"]; ?>"/>
                                <input type="text" name="price" hidden value="<?= $products[$key]["price"]; ?>"/>
                                <input type="submit" value="Add to Cart" name="add" class="btnAddAction" />
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

</div>
</body>
</html>