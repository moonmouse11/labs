<?php

require 'templates/header.php';

$averageList = (new \Labs\Lab5\Controller\ReportController())->getAverage();
$storageList = (new \Labs\Lab5\Controller\ReportController())->getStorageItems();
$pledgesItemsList = (new \Labs\Lab5\Controller\ReportController())->getPledgesTimes();

?>

    <h1>Отчеты</h1>
    <div class="table_component" role="region" tabindex="0">
        <table id="Pledges">
            <caption>Средняя сумма залога</caption>
            <tr class="header">
                <th>Клиент</th>
                <th>Средняя сумма залога</th>
            </tr>
            <?php
            foreach ($averageList as $average) : ?>
                <tr>
                    <td><?= $average['client_full_name'] ?></td>
                    <td><?= $average['average'] ?></td>
                </tr>
            <?php
            endforeach; ?>
        </table>
    </div>
    <div class="table_component" role="region" tabindex="0">
        <table id="Pledges">
            <caption>Количество залогов за период</caption>
            <tr class="header">
                <th>Период</th>
                <th>Количество залогов</th>
            </tr>
            <?php
            foreach ($pledgesItemsList as $pledgeItem) : ?>
                <tr>
                    <td><?= $pledgeItem['period'] ?></td>
                    <td><?= $pledgeItem['num_pledges'] ?></td>
                </tr>
            <?php
            endforeach; ?>
        </table>
    </div>
    <div class="table_component" role="region" tabindex="0">
        <table id="Pledges">
            <caption>Срок нахождения имущества на складе</caption>
            <tr class="header">
                <th>Залог</th>
                <th>Количество дней</th>
            </tr>
            <?php
            foreach ($storageList as $storageItem) : ?>
                <tr>
                    <td><?= $storageItem['name'] ?></td>
                    <td><?= $storageItem['days_in_storage'] ?></td>
                </tr>
            <?php
            endforeach; ?>
        </table>
    </div>

<?php
require 'templates/footer.php';