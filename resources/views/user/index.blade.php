<html>
    <head>
        <title>User/Index</title>
    </head>
    <body>
        <h1>Blade/Index</h1>
        <form method="POST" action="/hello">
        {{csrf_field()}}
        <input type="text" name="msg">
        <input type="submit">
        </form>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->name}}</td>
            </tr>
        @endforeach
    </body>
</html>