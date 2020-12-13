<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <!--Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <style>
        *{
            font-family: Roboto;
        }
        .container{
            width: 100%;
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .content{
            width: 100%; height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 10%;
        }

        .success-text{
            color: #54c454;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <h4 class="success-text">
            Unsubscribed successfully!
        </h4>
        <p>You will no longer receive email form {{$sender}}</p>
    </div>
</div>
</body>
<script>

</script>
</html>
