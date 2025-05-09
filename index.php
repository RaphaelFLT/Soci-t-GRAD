<? //php include 'connexion.php'?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Page d'accueil - Site GRAD</title>

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
				
				<!-- DESCRIPTION -->
				<div class="col-6">
					<p class="description" id="desc">
						GRAD, VOTRE SPÉCIALISTE BOIS
						La société grad est une entreprise de création d’équipements extérieurs implantée depuis 1988 en Alsace, au Nord de Strasbourg.
						Spécialisée dans les aménagements extérieurs en mix-matières bois, grès cérame, aluminium, Inox, verre… et pionniers dans la terrasse, nous occupons depuis 2005 la place de leader national dans ce domaine.
						« Nous occupons depuis 2005 la place de leader national »
						Notre savoir-faire et notre esprit d’innovation nous valent une réputation d’excellence qui dépasse les frontières du pays avec de nombreux concepts brevetés. Le développement européen est en cours avec déjà des implantations fortes en Allemagne, Autriche, Suisse et Belgique.
						Forts de plus de 25 années expériences, nous pouvons aujourd’hui prétendre apporter la solution aux demandes les plus pointues, les plus originales, les plus novatrices…
						La prise de participation par l’entreprise alsacienne Burger, depuis avril 2016, nous permettra d’atteindre le très haut niveau de notoriété qui nous revient dans le domaine de l’aménagement de terrasse.
						grad c’est qui ?
						C’est 49 collaborateurs au siège alsacien (production, logistique, administration,…).
						C’est un réseau de près de 100 partenaires formés, répartis dans toute la France pour poser nos produits, chez vous.
						C’est de nombreux partenaires à l’étranger pour des chantiers jusqu’au bout du monde !
					</p>
				</div>
				
				<!-- ACTUALITÉS -->
				<div class="col-6">
					<div class="row">
						<img src="./ressources/actualite/actu1.jpg" alt="" id="news1" class="img-fluid">
					</div>

					<div class="row">
						<img src="./ressources/actualite/actu2.jpg" alt="" id="news2" class="img-fluid">
					</div>
				</div>
			</div>
		</div>

		<!-- FOOTER -->
		<?php include 'footer.php'; ?>

