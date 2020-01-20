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
                                <tbody>
                                    <tr>
                                        <td class="px-3">1</td>
                                        <td>Test extrémné dlouhého názvu zboží bez autority <small><br>+ add <br> + extra add</small> </td>
                                        <td class="px-3">23,90</td>
                                    </tr>
                                    <tr>
                                        <td class="pl-3">1</td>
                                        <td>Test</td>
                                        <td class="px-3">23,90</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="sale-receipt--suma mt-auto px-3 py-4">
                            <p>Mezisoučet: <span class="float-right">47,80</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        <?php

                        for ($y = 1; $y <= 6; $y++)
                        {
                            for ($x = 1; $x <= 6; $x++) {
                                ?>
                                <div class="col-2 sale-item">
                                    <div class="sale-item--inner active" data-x="<?= $x ?>" data-y="<?= $y ?>" data-price="" data-name="" data-productId="">
                                       <p>sale item</p>
                                    </div>
                                </div>
                                <?
                            }
                        }

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
