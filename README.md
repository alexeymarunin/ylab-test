# Установка
Убедитесь, что установлен Apache, PHP, composer, NPM
Не требуется MySQL! Работаем с SQLite (дабы не усложнять окружение)

## Запуск composer
```
composer global require "fxp/composer-asset-plugin"
composer install
```

Проверяем наличие необходимых системных компонентов
```
php requirements.php
```
Обращаем внимание на warnings, не должно быть ошибок

## Настройка рабочего окружения
Копируем файл `.env.dist` в `.env`, меняем в нем нужные настройки.

Копируем файл `web/.htaccess.example` в `web/.htaccess` (если в качестве веб-сервера установлен Apache).

В каталоге runtime созадаем пустой файл `data.db`

## Миграции
Запускаем миграции
```
php yii migrate
```

## Frontend API

`/api/tasks` - просмотр всех задач

`/api/task/10` - просмотр задачи с id=10

`/api/task/10/change-status` - сменить статус для задачи с id=10