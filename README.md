# Проект Интернет-магазина
##  _Документация по установке:_
* ###  Склонировать репозиторий себе в папку
 > $ git clone git@github.com:shigetor/beta.git

* ### Переходим в папку проекта 
 > cd /../beta

* ###  Создать в папке проекта файл .env.local и прописать в нем
> DATABASE_URL="mysql://db_user:db_password@localhost/db_name?serverVersion=8.0&charset=utf8"

* ### Установка пакетов из composer
 > $ composer install

* ### Cоздать символическую ссылку на файл local.nginx 
> $ cd /etc/nginx/sites-enabled/

> $ sudo ln -s /.../beta/config/nginx/local.nginx beta.my

> $ sudo nano /etc/hosts

* ### Добавить имя beta.my в список доменных имен, после этого обновить сервер

> $sudo service nginx restart

* ### Миграция базы данных

> $ bin/console doctrine:schema:update --force

* ### Создание новой базы данных

> bin/console doctrine:database:create

# *Установка webpack, node_modules

> $ npm install

> $ sudo apt install nodejs npm 

> $ npm run build

* ### Создание  шаблонов Главная страница, карточка Товара, страница  Авторизации
  ### Скачали готовый пакет с сайта HTML5up.net , папку assets с главными файлами main.css и main.js разместили в папке проектa public.
 ### На основании файла из готового пакета  index.html Через Visual Studio Code  создали  файлы : 
> default/index.html.twig -Главная страница,  
> product/product.html.twig -cтраница Товара,
 ### Верстку шаблонов разбили на основные компоненты, которые помещены в папке templates/layout : (12 компонентов). Подключение компонентов в файлах с помощью комманды  include.
### Подключение шаблонов :
## homepage: 
>  path: /
 > controller: App\Controller\DefaultController::index

## product:
  >path: /product/{id}
  >controller: App\Controller\DefaultController::productShow
## Логин и регистрация пользователей
> /login

>/registration

## Авторизация суперпользователя
* Создание суперпользователя
> $ php bin/console fos:user:create adminuser –super-admin

> /admin

>/admin/login
