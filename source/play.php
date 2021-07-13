<?php
//pagina relativa al gioco
include("top.php"); ?>
<?php include("functions.php");
ensure_logged_in(); ?>


<div class="container-fluid" id="playPage">


    <div class="row">
        <div class="col" id="timer">10 s</div>
        <div class="col"><h4>score: </h4><h4 id="score">0</h4></div>
        <div class="col lifes"><i class="fa fa-heart heart" id="life1"></i><i class="fa fa-heart heart"
                                                                              id="life2"></i><i
                    class="fa fa-heart heart" id="life3"></i></div>
    </div>

    <div class="container  picArea2 box-shadow--16dp">
        <div class="container animated bounceInLeft box-shadow--16dp picArea">
        </div>
    </div>

    <div class="col-md-4 questionDiv">

        <h4 class="animated bounceInRight">Where is this person from?</h4>

    </div>
    <div id="answers">
        <div class="buttondiv animated bounceInLeft delay-200" id="answer1">
            <button type="button" class="btn-lg choose btn-primary box-shadow--16dp answer" id="button1"></button>
        </div>
        <div class="buttondiv animated bounceInRight delay-500">
            <button type="button" class="btn-lg choose btn-success box-shadow--16dp fadeInRight answer"
                    id="button2"></button>
        </div>
        <div class="buttondiv animated bounceInLeft delay-800">
            <button type="button" class="btn-lg choose btn-danger box-shadow--16dp fadeInLeft answer"
                    id="button3"></button>
        </div>
        <div class="buttondiv animated bounceInRight slow delay-1000">
            <button type="button" class="btn-lg choose btn-warning text-light box-shadow--16dp fadeInRight answer"
                    id="button4"></button>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" id="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Game Over</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="playAgain" data-dismiss="modal">Play again
                        </button>
                        <button type="button" class="btn btn-primary" id="goProfile">Go to Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include("bottom.php"); ?>

