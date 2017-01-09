<script>
$(document).ready(function(e) {
	$('#carousel-example-generic').carousel({
		interval: 5000
	});
    $('.caption-text').addClass('display-none');
	$('#caption-img').css('height','auto');
});
</script>
<style>
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
	width: 100%;
	max-height:350px;
	margin: auto;
}
</style>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    </ol> 
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="img/carousel/lineavoz.jpg">
            <div class="carousel-caption">
            	<h3>Servicios de voz - Líneas de voz</h3>
            </div>
        </div>
        <div class="item">
            <img src="img/carousel/centralita.jpg">
            <div class="carousel-caption">
                <h3>Servicios de voz - Centralitas virtuales</h3>
            </div>
        </div>
        <div class="item">
            <img src="img/carousel/interaire.jpg">
            <div class="carousel-caption">
            	<h3>Servicios de internet - AIRE</h3>
            </div>
        </div>
        <div class="item">
            <img src="img/carousel/interpro.jpg">
            <div class="carousel-caption">
            	<h3>Servicios de internet - Profesional</h3>
            </div>
        </div>
    </div>
 
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    	<span class="glyphicon-pro glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    	<span class="glyphicon-pro glyphicon-chevron-right"></span>
    </a>
</div> <!-- Carousel -->