<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Mini App</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script>
        window.onload = function() {
            let tg = window.Telegram.WebApp;
            tg.expand();
            
            let userData = tg.initDataUnsafe.user;
            if (userData) {
                fetch('/api/telegram/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        telegram_id: userData.id,
                        first_name: userData.first_name,
                        last_name: userData.last_name,
                        username: userData.username,
                        photo_url: userData.photo_url
                    })
                }).then(response => response.json()).then(data => {
                    console.log(data);
                });
            }
        }
    </script>
</head>
<body>
    <h1>Welcome to the Telegram Mini App</h1>
</body>
</html>
