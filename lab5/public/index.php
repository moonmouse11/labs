<?php

require 'templates/header.php';

echo '<pre>';
$pledgesList = (new \Labs\Lab5\Controller\PledgeController())->index();
$expertsList = (new \Labs\Lab5\Controller\ExpertController())->index();
$clientsList = (new \Labs\Lab5\Controller\ClientController())->index();

echo '</pre>';

?>
    <div class="table_component" role="region" tabindex="0">
        <table>
            <caption>Список залогов</caption>
            <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Client</th>
                <th>Expert</th>
                <th>Date Start</th>
                <th>Date Over</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($pledgesList as $pledge) : ?>
                <tr>
                    <td><?= $pledge['name'] ?></td>
                    <td><?= $pledge['name'] ?></td>
                    <td><?= $pledge['name'] ?></td>
                    <td><?= $pledge['name'] ?></td>
                </tr>
            <?php
            endforeach; ?>
            </tbody>
        </table>
    </div>
    <pre>
<?php
                var_dump($pledgesList); ?>
    </pre>
<?php
require 'templates/footer.php';

