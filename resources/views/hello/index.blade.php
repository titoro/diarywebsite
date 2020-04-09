<html>
    <head>
        <title>Hello/Index</title>
    </head>
    <body>
        <h1>Blade/Index</h1>
        <form method="POST" action="/hello">
        {{csrf_field()}}
        <input type="text" name="msg">
        <input type="submit">
        </form>
    </body>
</html>