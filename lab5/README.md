# Лаборатораная работа 5
***

Данные для подключения к БД
```php
        'host' => '0.0.0.0',
        'port' => 3306,
        'dbname' => 'lab5',
        'charset' => 'utf8mb4',
        'user' => 'root',
        'password' => 'strong_password'
```

Структура БД
```sql
create table clients(
    id int auto_increment primary key,
    full_name varchar(255) not null,
    phone varchar(20)  not null,
    passport_number varchar(15) null
);

create table experts (
    id int auto_increment primary key,
    full_name varchar(255) not null,
    phone varchar(20) not null,
    hiring_date date
);

create table types(
    id int auto_increment primary key,
    type varchar(255)
);

create table types_experts
(
    type_id int,
    expert_id int,
    foreign key (type_id) references types(id) on delete cascade,
    foreign key (expert_id) references experts(id) on delete cascade
);

create table pledges(
    id int auto_increment primary key,
    name varchar(255) not null,
    price decimal not null,
    start_date date not null,
    over_date date,
    client_id int,
    expert_id int,
    foreign key (client_id) references clients(id) on delete set null,
    foreign key (expert_id) references experts(id) on delete set null 
);
```

