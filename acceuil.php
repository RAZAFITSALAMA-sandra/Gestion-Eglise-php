<?php
require "connect.php";
?>
<?php require "header.php"; ?>
<p class="text-center h3 mt-5 text-success">Histogramme montrant le mouvement de caisse</p>
<div class="container" style="margin-top:50px;">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center border-bottom">
                    Mouvement de caisse entrant
                </div>
                <div class="card-body">
                    <canvas id="chart1" height="210px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center border-bottom">
                    Mouvement de caisse sortant
                </div>
                <div class="card-body">
                    <canvas id="chart2" height="210px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>