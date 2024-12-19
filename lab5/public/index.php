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
                <th>Название</th>
                <th>Цена</th>
                <th>Клиент</th>
                <th>Оценщик</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
            </tr>
            </thead>
            <tbody>
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
            <td style="border: none; text-align: left">
                <button class="create">Добавить</button>
            </td>
            </tbody>
        </table>
    </div>

    <div class="table_component" role="region" tabindex="0">
        <table>
            <caption>Список клиентов</caption>
            <thead>
            <tr>
                <th>Имя</th>
                <th>Номер телефона</th>
                <th>Номер паспорта</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach (
                $clientsList

                as $client
            ) : ?>
                <tr>
                    <td><?= $client['full_name'] ?></td>
                    <td><?= $client['phone'] ?></td>
                    <td><?= $client['passport_number'] ?></td>
                    <td style="border: none; text-align: left">
                        <button class="update">Редактировать</button>
                        <button class="delete">Удалить</button>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            <td style="border: none; text-align: left">
                <button class="create">Добавить</button>
            </td>
            </tbody>
        </table>
    </div>
    <div class="table_component" role="region" tabindex="0">
        <table>
            <caption>Список оценщиков</caption>
            <thead>
            <tr>
                <th>Имя</th>
                <th>Номер телефона</th>
                <th>Дата приема на работу</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach (
                $expertsList

                as $expert
            ) : ?>
                <tr>
                    <td><?= $expert['full_name'] ?></td>
                    <td><?= $expert['phone'] ?></td>
                    <td><?= $expert['hiring_date'] ?></td>
                    <td style="border: none; text-align: left">
                        <button class="update">Редактировать</button>
                        <button class="delete">Удалить</button>
                    </td>
                </tr>
            <?php
            endforeach; ?>
            <td style="border: none; text-align: left">
                <button class="create">Добавить</button>
            </td>
            </tbody>
        </table>
    </div>
    <pre>
<?php
//                var_dump($pledgesList); ?>
    </pre>
<?php
require 'templates/footer.php';

