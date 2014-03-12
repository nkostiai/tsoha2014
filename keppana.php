
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/jumbotron-narrow.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>

        <div class="container">
            <div class="header">
                <ol class="breadcrumb">
                    <li class="active"><a href="etusivu.html">Etusivu</a></li>
                    <li class="active"><a href="kategoria.html">Yleinen keskustelu</a></li>
                    <li class="active">Aihe 1</li>
                    <li class="pull-right"><a href="login.html">Log In</a></li>
                </ol>
            </div>
            <ul class="pager">
                <li class="previous disabled"><a href="#">&larr; Older</a></li>
                <li class="next disabled"><a href="#">Newer &rarr;</a></li>
            </ul>
            <div class="well">

                <?php
                $yhteys = new PDO("pgsql:");
                $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "select * from viesti";
                $kysely = $yhteys->prepare($sql);
                $kysely->execute();

                $tulokset = array();
                foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {

                    echo "<div class = \"panel panel-default\">";
                    echo "<div class = \"panel-heading\">";
                    echo "<h6 class = \"pull-right\">";
                    echo $tulos->kirjoittaja;
                    echo "</h6>";
                    echo "<h3 class = \"panel-title\">Aihe</h3>";
                    echo "</div>";
                    echo "<div class = \"panel-body\">";
                    echo $tulos->viestin_sisalto;
                    echo "</div>";
                    echo "</div>";
                }
                ?>
                
<!--                VIESTIN ALKU 
                <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <h6 class = "pull-right">Kirjoittaja</h6>
                        <h3 class = "panel-title">Aihe</h3>

                    </div>
                    <div class = "panel-body">
                        Viestin sisältö
                    </div>
                </div>
                VIESTIN LOPPU -->


            </div>
            <ul class = "pager">
                <li class = "previous disabled"><a href = "#">&larr;
                        Older</a></li>
                <li class = "next disabled"><a href = "#">Newer &rarr;
                    </a></li>
            </ul>

            <div class = "well well-sm">
                <p>&copy;
                    Company 2014</p>
            </div>

        </div> <!--/container -->


        <!--Bootstrap core JavaScript
        ================================================== -->
        <!--Placed at the end of the document so the pages load faster -->
    </body>
</html>
