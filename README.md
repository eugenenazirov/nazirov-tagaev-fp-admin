# MailingsBot Admin Panel
## Kolesa Backend Upgrade 2022. Final Project 
Команда: Евгений Назиров, Асылхан Тагаев.
Ментор: Еркебулан Абен

Вы находитесь в репозитории веб-сервиса для создания и отправки рассылок MailingsBot. Это его первый компонент (микросервис): админ панель.
Разработана на PHP с использованием фреймворка Lumen.
Финальный проект в рамках курса Kolesa Upgrade для Backend разработчиков.


### Как развернуть админку на локальной машине?
1. Запустите базу данных. Мы используем MySQL в Docker-контейнере на порту 3306.
2. Перейдите в корневую директорию проекта. Создайте файл конфигурации .env (dotenv) в корневой директории.
    Заполните файл необходимыми данными. Укажите реквизиты для подключения к БД и
    токен бота, полученный от [BotFather](https://t.me/BotFather "Создать своего телеграм-бота").
    В качестве образца используйте .env.example
    ```
    cd nazirov-tagaev-fp-bot
    touch .env
    ```
    Примените миграции командой:
    ```
    make migrations
    ```

3. Запустите бота с помощью команды

   ```make start-bot```

    По умолчанию админка стартует на порту 3000.

4. Перейдите в браузере по адресу http://localhost:3000

Готово! Теперь запустите [телеграм-бота](https://github.com/eugenenazirov/nazirov-tagaev-fp-bot "MailingsBot") и пользуйтесь сервисом :)
