Задача
======

Требуется создать веб-приложение реализующее функциональность администратора водителей рейсовых автобусов автопарка. В реализации должны присутствовать следующие экраны:

1. Список водителей
2. Экран редактирования водителя

Объект «Водитель» содержит следующие поля:

* Имя
* Фамилия
* Сотовый телефон
* Возраст
* флаг «Активен»
* Модели автобусов, которыми способен управлять водитель

Из списка пользователей должна быть возможность удаления и установки/снятия флага «Активен» через Ajax.

В списке водителей должно присутствовать разбиение на страницы.

Реализация экрана редактирования — на усмотрение программиста.

Используемые технологии: PHP, AJAX, jQuery. Желательно использование фреймворка Yii. БД – MySql.

Оцениваться будут качество кода, время выполнения и достоверность работы системы

Время
=====
* Собственно разработка — 3 часа
* Пояснение про Yii Framework - полчаса

Установка
=========

Зависимости в проекте управляются [Composer](http://getcomposer.org), приложение реализовано на Symfony 2.1.3. Вот [мое пояснение](http://wrttn.in/6c8522), почему не стоит использовать Yii для разработки публично доступных веб-приложений.

В общем случае конфигурация сводится к установке Composer и зависимостей, настройке доступа к БД в [app/config/parameters.yml](https://github.com/kix/wtpro-test/blob/master/app/config/parameters.yml) и выполнении команды ``app/console doctrine:schema:create`` для инициализации схемы БД. Assetic в проекте не используется, т.к. все скрипты и стили лежат в шаблонах, а jQuery подтягивается с CDN Яндекса.

Работоспособность проверялась под Nginx/PHP-FPM 5.3.17, но гораздо проще запускать приложение командой ``php -S app.dev:8080  -t web/``, тогда приложение будет доступно на ``8080`` порту хоста ``app.dev`` (ключ ``-S`` появился в PHP с версии 5.4)

Публично доступный путь — ``web/``, в него должен смотреть паблик сервера.