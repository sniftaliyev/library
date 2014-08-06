=======
Развертывание проекта:
Фреймворк должен лежать по пути dirname(__FILE__).'/../yii/framework/yii.php';
Дамп располжен /protected/data/schema.mysql.sql


Решения заданий:
1-4) Готово;
5) Реализация в коде проекта присутсвует котроллер ReportController 
Для базы "Библиотека Компании" я выбрал один из способов полнотекстового поиска с помощью таблицы-«зеркала» в MyISAM с индексом FULLTEXT. Так как все таблицы построены на движке InnoDB, индекс FULLTEXT построить не представляется возможным.
Таблицы-«зеркала» в MyISAM - это search_book, search_author, они хранят копии данных с основных таблиц и для возможности полнотекстового поиска выставлен FULLTEXT индекс по необходимым полям. Как известно MyISAM хорошо поддерживает полнотекстовый поиск и это можно использовать. 
Для синхронизации данных между основными таблицами и таблицами-зеркал использую триггеры на добавление, изменение и удаление.
Данный метод по сравнение с формированием запроса с помощью оператора like  горазда производительнее и быстрее.
Плюс этого метода является гибкость поиска за счет добавления FULLTEXT индексов. Обычно полей в таблице для полнотекстового поиска больше одного, и данный метод будет производителен даже при поиске по нескольким полям. Он также хорошо сортирует записи по релевантности.
Минусы такого способа – это излишнее хранение данных, как и в общем во всех способах с созданием таблиц-«зеркала». Поэтому его использовать имеет смысл при небольших объемах данных.
Создание MyISAM зеркал стоит использовать в случае, если в таблице записи порядка 10000-50000 записей, иначе необходимость возникает в сторонних разработках. Наиболее популярной из них является Sphinx, с большим списком основных возможностей он поддерживает MYSQL (для таблиц InnoDB, MyISAM и др.). Для Sphinx на yii существует, как компоненты, так и расширения.
6) Создать глобальный счетчик, который хранится в базе (redis, mysql не важно). На входящий скрипт поставить каунтер, который берет ip клиента, браузер и устройство клиента и сверяет его с наличием в базе за определенный период (период за который считается уникальность посещения). Полагаться на уникальность на один лишь ip не хорошо (допустим, в компаниях могут стоять сотни компов, которые лазиют по просторам интернета на одном ip)
