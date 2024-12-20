<?php

require 'templates/header.php';

$request = $_POST;

if (array_key_exists('create_pledge', $request) || array_key_exists('update_pledge', $request)):
    $clients = (new \Labs\Lab5\Controller\ClientController())->index();
    $experts = (new \Labs\Lab5\Controller\ExpertController())->index();
    if (array_key_exists('update_pledge', $request)) {
        $pledge = (new \Labs\Lab5\Controller\PledgeController())->get($request['update_pledge']);
    } ?>
    <form class="form_component" action="index.php" method="POST" id="pledge_form">
        <label for="name">Название залога</label>
        <input type="text" id="name" name="name" value="<?= $pledge['name'] ?? '' ?>">
        <label for="price">Цена залога</label>
        <input type="number" id="price" name="price" value="<?= $pledge['price'] ?? '' ?>">
        <label for="client_id">Клиент
            <select name="client_id">
                <?php
                foreach ($clients as $client) : ?>
                    <option value="<?= $client['id'] ?>"><?= $client['full_name'] ?></option>
                <?php
                endforeach; ?>
            </select>
        </label>
        <label for="expert_id">Оценщик</label>
        <label>
            <select name="expert_id">
                <?php
                foreach ($experts as $expert) : ?>
                    <option value="<?= $expert['id'] ?>"><?= $expert['full_name'] ?></option>
                <?php
                endforeach; ?>
            </select>
        </label>
        <label for="start_date">Дата начала залога</label>
        <input type="date" id="start_date" name="start_date" value="<?= $pledge['start_date'] ?? '' ?>">
        <label for="over_date">Дата окончания залога</label>
        <input type="date" id="over_date" name="over_date" value="<?= $pledge['over_date'] ?? '' ?>">
        <?php
        if (isset($pledge)) : ?>
            <button class="update" form="pledge_form" name="pledge_update_id" value="<?= $pledge['id'] ?>">Обновить
            </button>
        <?php
        else: ?>
            <button class="create" form="pledge_form" name="pledge_create" value=""> Сохранить</button>
        <?php
        endif; ?>
    </form>
<?php
endif;

if (array_key_exists('create_expert', $request) || array_key_exists('update_expert', $request)):
    if (array_key_exists('update_expert', $request)) {
        $expert = (new \Labs\Lab5\Controller\ExpertController())->get($request['update_expert']);
    } ?>
    <form class="form_component" action="index.php" method="POST" id="expert_form">
        <label for="full_name">Имя эксперта</label>
        <input type="text" id="full_name" name="full_name" value="<?= $expert['full_name'] ?? '' ?>">
        <label for="phone">Номер телефона эксперта</label>
        <input type="tel" id="phone" name="phone" value="<?= $expert['phone'] ?? '' ?>">
        <label for="hiring_date">Дата приема на работу</label>
        <input type="date" id="hiring_date" name="hiring_date" value="<?= $expert['hiring_date'] ?? '' ?>">
        <?php
        if (isset($expert)) : ?>
            <button class="update" form="expert_form" name="expert_update_id" value="<?= $expert['id'] ?>">Обновить
            </button>
        <?php
        else: ?>
            <button class="create" form="expert_form" name="expert_create" value=""> Сохранить</button>
        <?php
        endif; ?>
    </form>

<?php
endif;

if (array_key_exists('create_client', $request) || array_key_exists('update_client', $request)):
    if (array_key_exists('update_client', $request)) {
        $client = (new \Labs\Lab5\Controller\ClientController())->get($request['update_client']);
    } ?>
    <form class="form_component" action="index.php" method="POST" id="client_form">
        <label for="full_name">Имя клиента</label>
        <input type="text" id="full_name" name="full_name" value="<?= $client['full_name'] ?? '' ?>">
        <label for="phone">Номер телефона клиента</label>
        <input type="tel" id="phone" name="phone" value="<?= $client['phone'] ?? '' ?>">
        <label for="passport_name">Паспортные данные клиента</label>
        <input type="text" pattern="[0-9 ]+" id="passport_number" name="passport_number"
               value="<?= $client['passport_number'] ?? '' ?>">
        <?php
        if (isset($client)) : ?>
            <button class="update" form="client_form" name="client_update_id" value="<?= $client['id'] ?>">Обновить
            </button>
        <?php
        else: ?>
            <button class="create" form="client_form" name="client_create" value=""> Сохранить</button>
        <?php
        endif; ?>
    </form>

<?php
endif;