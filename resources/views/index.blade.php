<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <section class="main">
        <div class="container main__container">
            <div class="main__messages">
                <ul class="message-items">
                    @foreach ($messages as $message)
                        <li class="message-item">{{ $message->msg_text }}</li>
                    @endforeach
                </ul>
            </div>
            
            <form action="/send" method="post" class="main__form">
                <input type="text" class="form__input" name="message">
                <button type="submit" class="btn form__btn">
                    Send Message
                </button>
            </form>
        </div>
    </section>   
</body>
</html>