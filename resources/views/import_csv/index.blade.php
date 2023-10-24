<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="/insert/kirim" method="post" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        <input type="file" name="temp" id="temp">
        <input type="submit" value="submit" id="submit" name="submit">
    </form>
</body>
</html>