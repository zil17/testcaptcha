<?php
    $siteKey = "6LcGd00oAAAAAPRqLHEAzNQo4jeOMd3Di-J63O-Y";
    $secretKey = "6LcGd00oAAAAADq_RFtlNJQrAS6EmSNCVsYrg-Z0";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $siteKey; ?>"></script>
    
</head>
<body>
    <h1>Hello World!</h1>

    <form id="demo-form" action="#" method="post">
        <p><label>Имя:<input type="text" name="my_name"></label></p>
        <p><label>Телефон:<input type="text" name="my_phone"></label></p>
        <input type="hidden" id="token" name="token">
        <button type="submit" name="post">Отправить</button>
    </form>

    <script>
        document.querySelector('form').addEventListener('submit', (e) => {
            e.preventDefault();
            let tk;
            grecaptcha.ready(function() {
                grecaptcha.execute('<?php echo $siteKey; ?>', {action: 'homepage'}).then(function(token) {
                    tk = token;
                    document.getElementById('token').value = token;
                    const data = new URLSearchParams();
                    for (const pair of new FormData(document.querySelector('form'))) {
                        data.append(pair[0], pair[1]);
                    }
                    fetch('send.php', {
                        method: 'post',
                        body: data,
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result['om_score'] >= 0.5) {
                            console.log('Человек');
                            // Отправка данных на почту
                        }
                        else {
                            console.log('Бот');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>