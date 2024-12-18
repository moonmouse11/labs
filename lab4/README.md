# Лабораторная работа 4
***

Данные для подключения к БД
```php
        'host' => '0.0.0.0',
        'port' => 3306,
        'dbname' => 'lab4',
        'charset' => 'utf8mb4',
        'user' => 'root',
        'password' => 'strong_password'
```
Команда для создания таблицы в MySQL
```sql
create table tents ( 
    id int primary key auto_increment,
    title varchar(255) not null,
    brand varchar(255) not null,
    category varchar(255),
    places int,
    description text,
    picture varchar(255)
);
```
