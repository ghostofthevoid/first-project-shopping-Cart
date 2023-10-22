<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/cart.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <header>
        <div class="header-body">
            <a href="index.php" id="homeBtn">Home</a>
            <nav class="navbar">
                <a href="">Add products</a>
                <a href="">View products</a>
                <!-- how to change the quantity without reloading the page -->
                <a href="cartPage.php"><i class='bx bxs-cart'><span><sup id="quantity"><?= $quantity ?></sup></span></i></a>
            </nav>
        </div>
    </header>

</head>