<?php

require 'templates/header.php';

(new \Labs\Lab5\Controller\MainController())->checkRequest($_REQUEST);

$pledgesList = (new \Labs\Lab5\Controller\PledgeController())->index();
$expertsList = (new \Labs\Lab5\Controller\ExpertController())->index();
$clientsList = (new \Labs\Lab5\Controller\ClientController())->index();

?>
    <h1>Главная страница</h1>
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
                    <td><?= $pledge['client_full_name'] ?></td>
                    <td><?= $pledge['expert_full_name'] ?></td>
                    <td><?= $pledge['start_date'] ?></td>
                    <td><?= $pledge['over_date'] ?></td>
                    <form action="form.php" method="POST" id="update_pledge""></form>
                    <form action="/" method="POST" id="delete_pledge""></form>
                    <td style="border: none; text-align: left">
                        <button class="update" form="update_pledge" name="update_pledge" value="<?= $pledge['id']?>">Редактировать</button>
                        <button class="delete" form="delete_pledge"  name="pledge_delete_id" value="<?= $pledge['id']?>"> Удалить</button>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            <form action="form.php" method="POST" id="create_pledge"></form>
            <td style="border: none; text-align: left">
                <button class="create" form="create_pledge" name="create_pledge">Добавить</button>
            </td>
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
            foreach ($expertsList as $expert) : ?>
                <tr>
                    <td><?= $expert['full_name'] ?></td>
                    <td><?= $expert['phone'] ?></td>
                    <td><?= $expert['hiring_date'] ?></td>
                    <form action="form.php" method="POST" id="update_expert""></form>
                    <form action="/" method="POST" id="delete_expert""></form>
                    <td style="border: none; text-align: left">
                        <button class="update" form="update_expert" name="update_expert" value="<?= $expert['id']?>">Редактировать</button>
                        <button class="delete" form="delete_expert"  name="expert_delete_id" value="<?= $expert['id']?>"> Удалить</button>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            <form action="form.php" method="POST" id="create_expert"></form>
            <td style="border: none; text-align: left">
                <button class="create" form="create_expert" name="create_expert">Добавить</button>
            </td>
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
            foreach ($clientsList as $client) : ?>
                <tr>
                    <td><?= $client['full_name'] ?></td>
                    <td><?= $client['phone'] ?></td>
                    <td><?= $client['passport_number'] ?></td>
                    <form action="form.php" method="POST" id="update_client"></form>
                    <form action="/" method="POST" id="delete_client""></form>
                    <td style="border: none; text-align: left">
                        <button class="update" form="update_client" name="update_client" value="<?= $client['id']?>">Редактировать</button>
                        <button class="delete" form="delete_client"  name="client_delete_id" value="<?= $client['id']?>"> Удалить</button>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            <form action="form.php" method="POST" id="create_client"></form>
            <td style="border: none; text-align: left">
                <button class="create" form="create_client" name="create_client">Добавить</button>
            </td>
        </table>
    </div>
<?php
require 'templates/footer.php';

