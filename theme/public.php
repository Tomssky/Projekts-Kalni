<!DOCTYPE html>
<html>
<meta charset='UTF-8', name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='css/style.css'>
<script src='js/script.js'></script>
<body>
    <div class="bg">
        <div class="ok">
            <!--test navbar -->
            <?php
            if ($loginst == 1){ ?>
            <div class="topnav">
                <a href="/private.php">Home</a>
                <a href="priv-catalog.php">Private catalog</a>
                <a href="/contact.php">Contact</a>
                <a href="/about.php">About</a>
                <a class="right" href="logout.php">Logout</a>
            </div>

            <?php } else { ?>
            <div class="topnav">
                <a href="/index.php">Home</a>
                <a href="/catalog.php">Catalog</a>
                <a href="/contact.php">Contact</a>
                <a href="/about.php">About</a>
                <a class="right" href="login.php">Login</a>
            </div>
            <?php } ?>

            <!--logo-->
            <img src="/images/logoM2.png"
                 width="240" height="240" align="left">

            <h1>
                Noodle exchange
                </br>
                Materials
            </h1>

            </br>

            <!--welcome teksts-->
            <h2>
                Welcome to the offical website of Noodle exchange Materials!
            </h2>
            <h3>
                The best and most advanced material store in the city.
            </h3>
            <!-- tris apaksejas nodalas un prieks pogam-->
            <div class="row">
                <div class="column">
                    <h3>Check out our catalog and the items up for sale. our prices are the best in the city!</h3>
                    <a href="/catalog.php" class="homepage">Go to Catalog</a>
                </div>
                <div class="chop">
                    <img src="/images/chop.png"
                         width="50" height="440" align="left">
                </div>
                <div class="column">
                    <h3>Learn more about the store, our team and how we operate on a daily basis.</h3>
                    <a href="/about.php" class="homepage">Learn more</a>
                </div>
                <div class="chop">
                    <img src="/images/chop.png"
                         width="50" height="440" align="left">
                </div>
                <div class="column">
                    <h3>Our team contact information. Feel free to contact us if you have any questions!</h3>
                    <a href="/contact.php" class="homepage">Contact List</a>
                </div>
            </div>
        </div>
        <!--Jega vel kautko seit likti?-->
    </div>
    </div>
</body>
</html>
