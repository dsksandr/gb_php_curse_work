<?php
/** @var ProductModel $product */

use app\models\ProductModel; ?>

<h2><?= $product->name ?></h2>
<img width="200"
     src="/images/products/<?= $product->image ?>"
><br>
<p><?= $product->description ?></p>

