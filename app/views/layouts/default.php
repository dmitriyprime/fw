<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php \fw\core\base\View::getMeta(); ?>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/main.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="max-width: 1200px; margin: 30px auto; border: 3px solid #ccc; border-radius: 10px; padding: 25px">
    <h2 style="text-align: center;"><b>default layout</b></h2>

    <?php if(!empty($menu)): ?>

    <ul class="nav nav-pills">
        <li role="presentation"><a href="/">Home</a></li>
        <li role="presentation"><a href="/page/about">About</a></li>
        <li role="presentation"><a href="/admin">Admin panel</a></li>
        <li role="presentation"><a href="/user/signup">Sign up</a></li>
        <li role="presentation"><a href="/user/login">Login</a></li>
        <li role="presentation"><a href="/user/logout">Logout</a></li>
        <?php /*foreach ($menu as $item): */?><!--
            <li><a href="category/<?/*=$item['id'] */?>"><?/*=$item['title'] */?></a></li>
        --><?php /*endforeach; */?>
    </ul>

    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error'])  ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success'])  ?>
        </div>
    <?php endif; ?>

    <?=$content ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
    <?php
    foreach ($scripts as $script) {
        echo $script;
    }
    ?>
</body>
</html>
