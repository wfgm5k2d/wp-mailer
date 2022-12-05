# wp-mailer

<h2> Описание </h2>
<p>
  Плагин для подключения и настройки SMTP на CMS Wordpress. Работает на основе PHPMailer. Плагин является лишь проводником для установки и подключения PHPMailer, основную работу выполняет класс MailService являющийся декоратором.
</p>
<h2>Установка</h2>

<p>
Для тех кто первый раз сталкивается с плагинами на wordpress. Плагины обычно ставятся в wp-content/plugins (cd wp-content/plugins). Далее в wp-content/plugins кладется папка плагина (mailer-service). Внутри папки открыть консоль и прописать:
</p>
<pre>composer install</pre>
<p>
Далее положить класс в папку с вашей темой. К примеру:
</p>
<pre>wp-content/themes/{вашатема}/include/services/</pre>
<p>
После подключить файл в файле functions.php вашей темы
</p>

<h2>Использование</h2>

<p>В настройках класса прописать доступы к вашему SMTP</p>

### Вызов через экземпляр класса

```php
    <?php 
    // Вызвать экземпляр класса
    $obMailer = new MailService();
    $obMailer->setTo('mail@example.com')
             ->setSubject('Тема сообщения')
             ->setBody('Тело сообщения')
             ->send();
    ?>
```

### Вызов через статическую функцию load()

```php
    <?php 
    MailService::load()
               ->setTo('mail@example.com')
               ->setSubject('Тема сообщения')
               ->setBody('Тело сообщения')
               ->send();
    ?>
```

### Отправка нескольким получателям

```php
    <?php 
    MailService::load()
               ->setTo([
                  'mail@example.com',
                  'mail@example1.com',
                  'mail@example2.com'
               ])
               ->setSubject('Тема сообщения')
               ->setBody('Тело сообщения')
               ->send();
    ?>
```

### По умолчанию используются заголовки Content-type: text/plain
### Отправка своих заголовков на примере Content-type: text/html

```php
    <?php 
    MailService::load()
               ->setHeaders([
                    'Content-type' => 'text/html'
                ])
               ->setTo('mail@example.com')
               ->setSubject('Тема сообщения')
               ->setBody('Тело сообщения')
               ->send();
    ?>
```

### Установить отправителя

```php
    <?php 
    MailService::load()
               ->setTo('mail@example.com')
               ->setFrom('sender@example.com', 'Sender')
               ->setSubject('Тема сообщения')
               ->setBody('Тело сообщения')
               ->send();
    ?>
```

## Описание классов
- MailService
    - load
    - setTo
    - setFrom
    - setSubject
    - setBody
    - send
