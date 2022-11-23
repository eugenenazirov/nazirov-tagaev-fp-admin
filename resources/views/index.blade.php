<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MailingsBot</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <section class="main">
        <div class="container main__container">
            <div class="main__logo">
                <a href="/"><img class="main__logo-img" src="images/logo.svg" alt="Логотип Mailings Bot"></a>
            </div>

            <div class="main__messages" id="messages">
                <ul class="messages__items">
                    @if (!$messages)
                        <p class="messages__no-messages">Нет сообщений!</p>
                    @endif
                    @foreach ($messages as $message)
                        <li class="message-item">
                            <span class="message-item__time">{{ $message->created_at }}</span>{{ $message->msg_text }}</li>
                    @endforeach
                </ul>
            </div>
            
            <form action="/send" method="post" class="main__form">
                <textarea id="textInput" type="text" class="form__input" name="message" placeholder="Ваше сообщение..."></textarea>
                <button id="btn" type="submit" class="btn form__btn">
                    Send Message
                </button>
            </form>
        </div>
    </section>
    <script src="scripts/main.js"></script>
</body>
</html>