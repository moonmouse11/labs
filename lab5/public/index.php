<?php

require 'templates/header.php';

echo '<pre>';
$pledgesList = (new \Labs\Lab5\Controller\PledgeController())->index();
$expertsList = (new \Labs\Lab5\Controller\ExpertController())->index();
$clientsList = (new \Labs\Lab5\Controller\ClientController())->index();

echo '</pre>';

?>
    <input type="text" id="Client" onkeyup="clientFilter()" placeholder="Поиск клиента">
    <input type="text" id="Expert" onkeyup="expertFilter()" placeholder="Поиск эксперта">
    <div class="table_component" role="region" tabindex="0">
        <table id="Pledges">
            <caption>Список залогов</caption>
            <tr class="header">
                <th>Название</th>
                <th>Цена</th>
                <th>Клиент</th>
                <th>Оценщик</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
            </tr>
           <?php
                foreach ($pledgesList as $pledge) : ?>
                    <tr>
                        <td><?= $pledge['name'] ?></td>
                        <td><?= $pledge['price'] ?></td>
                        <td><?= $pledge['full_name'] ?></td>
                        <td><?= $pledge['expert_full_name'] ?></td>
                        <td><?= $pledge['start_date'] ?></td>
                        <td><?= $pledge['over_date'] ?></td>
                        <td style="border: none; text-align: left">
                            <button class="update">Редактировать</button>
                            <button class="delete">Удалить</button>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
            </table>
    </div>

    <div class="table_component" role="region" tabindex="0">
        <table id="Experts">
            <caption>Список экспертов</caption>
            <tr class="header">
                <th>Имя</th>
                <th>Номер телефона</th>
                <th>Дата трудоустройства</th>
            </tr>
           <?php
                foreach ($expertsList as $pledge) : ?>
                    <tr>
                        <td><?= $pledge['full_name'] ?></td>
                        <td><?= $pledge['phone'] ?></td>
                        <td><?= $pledge['hiring_date'] ?></td>
                        <td style="border: none; text-align: left">
                            <button class="update">Редактировать</button>
                            <button class="delete">Удалить</button>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
            </table>
    </div>

    <div class="table_component" role="region" tabindex="0">
        <table id="Clients">
            <caption>Список клиентов</caption>
            <tr class="header">
                <th>Имя</th>
                <th>Номер телефона</th>
                <th>Номер паспорта</th>
            </tr>
           <?php
                foreach ($clientsList as $pledge) : ?>
                    <tr>
                        <td><?= $pledge['full_name'] ?></td>
                        <td><?= $pledge['phone'] ?></td>
                        <td><?= $pledge['passport_number'] ?></td>
                        <td style="border: none; text-align: left">
                            <button class="update">Редактировать</button>
                            <button class="delete">Удалить</button>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
            </table>
    </div>
<?php
require 'templates/footer.php';

