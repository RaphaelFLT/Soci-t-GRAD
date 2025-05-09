
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Nos prestations - Ste GRAD</title>

		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

		<!-- jQuery -->
		<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
		
	</head>
	<body>
		<!-- NAVIGATION BAR -->
		<?php include 'navbar.php'; ?>

		<!-- CARROUSEL -->
		<?php include 'carrousel.php'; ?>

		<!-- BODY -->
		<div class="container p-3">
			<div class="row">
				<div class="col-md-6">
					<p id="prestation1-txt">
						LES AMÉNAGEMENTS D’ESPACE
						S’il y a bien des détails qu’il ne faut pas négliger, ce sont bien
						ceux qui constituent votre extérieur. Des bacs à plantes aux carrés
						potagers, des mobiliers de jardin à la cabane pour enfants, nos
						collections apporteront à la fois une ambiance chaleureuse et un
						cadre moderne.
					</p>
				</div>

				<div class="col-md-6">
					<img src="./ressources/prestations/amenagement.jpg" alt="" id="prestation1-img" class="img-fluid">
				</div>
			</div>

			<div class="row">
				<div class="col-6">
					LES ESCALIERS
					Véritable lieu de passage, l’escalier grad a été pensé pour vous
					simplifier la vie. À lui seul, il satisfait toutes les attentes que vous
					pourriez avoir : robustesse, stabilité et élégance. Sa surface rainurée
					lui confère une adhérence à toute épreuve.
					Adaptable en longueur et en largeur, il vous offrira un confort de
					déplacement très appréciable au quotidien. 
				</div>

				<div class="col-6">
					<img src="./ressources/prestations/escalier-GC.jpg" alt="" id="prestation2-img" class="img-fluid">
				</div>
			</div>
		</div>

		<!-- FOOTER -->
		<?php include 'footer.php'; ?>