<?php

$result = (new Labs\Lab4\Database\Database())->searchNumber($_GET['number']);

if ($result != false) {
    foreach ($result as $tent) { ?>
        <div>
            <p><?= $tent['title'] ?></p>
            <p><?= $tent['description'] ?></p>
        </div>
        <?php
    }
} else {
    ?><p style="color:rgba(220,30,100,1);; font-size:18px;">Нет палаток с таким количеством мест.</p><?php
}