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
        .divider{
            width: 100%;
            background-color: grey;
        }
        .footer{
            padding: 20px 10%;
        }
        .unsubscribe{
            color: gray;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <hr class="divider">
        <div class="content">
            {!! $content !!}
        </div>
        <hr class="divider">
        <div class="footer">
            <a href="https://multi-sender.com/unsubscribe?sender={{$sender}}&token={{$token}}" target="_blank" class="unsubscribe">Unsubscribe</a>
        </div>
    </div>
</body>
</html>
