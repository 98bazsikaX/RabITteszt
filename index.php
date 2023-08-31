<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RabIT Test</title>
</head>
<body>
<?php
include_once './Controller/Route.php';
include_once './Controller/Router.php';
include_once './View/AdView.php';
include_once './View/UsersView.php';
include_once './View/IndexView.php';
$routes =
    [
        new Route(['','/','/index'], new IndexView()),
        new Route(['/ads', '/advertisements'], new AdView()),
        new Route(['/users'], new UsersView())
    ];

$router = new Router($routes);
$router->display();

?>
</body>
</html>