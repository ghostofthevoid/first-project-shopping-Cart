<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/5544d71ff8.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Public\style\style.css">



    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fw-bolder py-3 fixed-top">
            <div class="container">
                <a href="#" class="navbar-brand">TaoBao</a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link">Add product</a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">View products</a>
                        </li>
                        <li class="nav-item">
                            <a href="cartPage.php"><i class="fa-solid fa-cart-shopping"><span><sup id="quantity"><?= $quantity ?></sup></span></i></a>
                        </li>

                    </ul>
                </div>
            </div>

        </nav>
    </header>

</head>