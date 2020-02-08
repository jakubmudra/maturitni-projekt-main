<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

        <title>Title</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/sale.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">EETPos</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="sale-main container mt-4">
            <div class="row">
                <div class="col-4 sale-receipt p-0">
                    <div class="d-flex align-content-end flex-column h-100 p-0">
                        <div class="sale-receipt--receiptId px-3 border-bottom">
                            <p>Receipt ID: <span class="float-right">10202211</span> </p>
                        </div>
                        <div class="sale-receipt--items">
                            <table class="w-100">
                                <thead class="border-bottom px-3">
                                    <tr class="">
                                        <th class="px-3">X</th>
                                        <th>Položka</th>
                                        <th class="px-3">Cena</th>
                                    </tr>
                                </thead>
                                <tbody id="CART">

                                </tbody>

                            </table>
                        </div>
                        <div class="sale-receipt--suma mt-auto px-3 py-4">
                            <p>MEZISOUČET: <span class="float-right" id="SUBTOTAL"></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">

                        <?php
                        //data prepare

                        include 'api/index.php';

                        $posRenderer = new posRenderer(6,6, "pay");
                        $posRenderer->_preRenderTable();
                        //var_dump($posRenderer->table);
                        echo $posRenderer->renderTable();

                        ?>

                    </div>
                </div>
            </div>
        </section>

    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sale.js"></script>

    </body>
</html>