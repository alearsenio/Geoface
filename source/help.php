<!--pagina contenente una descrizione del sito e del suo funzionamento-->

<?php include("top.php"); ?>

    <div class="container">
        <h1 id="how" class="animated fadeInDown">How does it works?</h1>
        <div class="row">
            <div class="col-sm-6  animated fadeInLeft" id="homePlay">
                <h4 id="geoface">Geoface</h4><h4> is a game where you have to guess
                    people origins observing their face.</h4>
                <h4>You have 10 seconds for each question and three life in total</h4>
                <h4>Subscribing to the site, your face will automatically and anomously be part of the game
                    so that you can see everytime you want in your Profile, what others people thinks about where you're
                    from
                </h4>
                <?php if (!isset($_SESSION["name"])) { ?>
                    <a href="register.php">
                        <button type="button" class="btn-lg choose btn-primary box-shadow--16dp"
                                id="homePlayButton">Subscribe
                        </button>
                    </a>
                <?php } ?>
            </div>
            <div class="col-sm-6  animated fadeInRight">
                <div>
                    <img src="page-pics/example2.jpg" class="img-fluid" alt="Responsive image" id="tutorialPic">
                </div>
            </div>
        </div>
    </div>


<?php include("bottom.php"); ?>