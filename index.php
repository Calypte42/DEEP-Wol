<?php
include 'HTML/entete.html';


include 'verificationConnexion.php';
?>

<!--<div class="bg"></div> pour le background grotte d'avant-->
<?php if ($_SESSION['admin']==1){
  echo "<div style='display:block;margin-left:auto;margin-right:auto;z-index:2;' id=redirectionPhpPgAdmin>
    <form action=\"../../phppgadmin\">
      <input type=\"submit\" value=\"Vers phpPgAdmin\">
    </form>
  </div>";
  }
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="Images/dhaeseCDH15038.jpg" class="img-responsive" >
    </div>

    <div class="item">
      <img src="Images/dhaeseCDH14982.jpg" class="img-responsive">
    </div>

    <div class="item">
      <img src="Images/dhaeseCDH15079.jpg" class="img-responsive">
    </div>

    <div class="item">
      <img src="Images/Entomobryae.png" class="img-responsive">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <!--span class="glyphicon glyphicon-chevron-left"></span>-->
    <span class="sr-only">Précédent</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <!--<span class="glyphicon glyphicon-chevron-right"></span>-->
    <span class="sr-only">Suivant</span>
  </a>
</div>





<?php include 'HTML/pied.html'; ?>
