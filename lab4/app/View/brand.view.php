<?php

$result = (new Labs\Lab4\Database\Database())->searchBrand($_GET['brand']);

if ($result != false) {
    foreach ($result as $tent) { ?>
        <div>
            <p><?= $tent['title'] ?></p>
            <img alt="" width="450" height="450"
                 src="<?= \Labs\Lab4\Controller\PictureController::getPicturePath($tent['picture']) ?>" loading="lazy">
        </div>
        <?php
    }
} else {
    ?><p style="color:rgba(220,30,100,1);; font-size:18px;">Нет палаток указанного бренда.</p><?php
}