<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anti Boring Spam</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <a class="navbar-brand" href="/">Anti Boring Spam</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="?logout">Logout</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="post"
                  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <input class="form-control mr-sm-2" name="email" type="email" placeholder="email" aria-label="email"
                       value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ""; ?>">
                <input class="form-control mr-sm-2" name="password" type="password" placeholder="password"
                       aria-label="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ""; ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Scan</button>
            </form>
        </div>
    </nav>
</header>