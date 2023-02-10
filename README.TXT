получение access и refresh токенов:
    домен:   http://alexefml.beget.tech
        /authorization.php - получает и записывает токены в файл tokens.txt
        /create.php - создает сделку с данными введенными в форму
        /webhook.php - добавляет теги и источник к сделкам созданным вручную

        /refresh.php - обновление access токена с помощью refresh после истечения времени работы acess токена
            /log.txt - запись даты и времени обновления access токена
        /contacts.php - содержит функцию get_phones(), которая возвращает массив  всех телефонов  системе
