<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Nous contacter - Ste GRAD</title>

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
		<div class="container">
			<div class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="./ressources/entete/entete01.jpg" alt="" class="d-block w-100">
						<div class="carousel-caption d-none d-md-block">
							<h5 class="text-dark">Contactez-nous</h5>
						</div>
					</div>
					<div class="carousel-item">
						<img src="./ressources/entete/entete04.jpg" alt="" class="d-block w-100">
						<div class="carousel-caption d-none d-md-block">
							<h5 class="text-dark">Contactez-nous</h5>
						</div>
					</div>
					<div class="carousel-item">
						<img src="./ressources/entete/entete02.jpg" alt="" class="d-block w-100">
						<div class="carousel-caption d-none d-md-block">
							<h5 class="text-dark">Contactez-nous</h5>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- BODY -->





		<div class="container p-3">
			<form action="" method="post">
				<div class="row m-3">
					<div class="col-4"> Nom </div>

					<div class="col-8">
						<label class="form-label" for="srname">Nom</label>
						<input class="form-control" type="text" id="surname" name="nom">
					</div>
				</div>

				<div class="row m-3">
					<div class="col-4">
						Prénom
					</div>

					<div class="col-8">
						<label class="form-label" for="name">Prénom</label>
						<input class="form-control" type="text" id="name" name="prenom">
					</div>
				</div>

				<div class="row m-3">
					<div class="col-4">
						CP - Ville
					</div>

					<div class="col-3">
						<label class="form-label" for="zip">CP</label>
						<input class="form-control" type="number" maxlength="5" id="zip"name="cp">
					</div>

					<div class="col-5">
						<label class="form-label" for="surname">Ville</label>
						<input class="form-control" type="text" id="city" name="ville">
					</div>

				</div>

				<div class="row m-3">
					<div class="col-4"> Email </div>

					<div class="col-8">
						<label class="form-label" for="surname">Email</label>
						<input class="form-control" type="email" id="email" name="email">
					</div>
				</div>

				<div class="row m-3">
					<div class="col-4"> Téléphone </div>

					<div class="col-4">
						<label class="form-label" for="phone">Téléphone</label>
						<input class="form-control" type="tel" id="phone" name="telephone">
					</div>
				</div>

				<div class="row m-3">
					<div class="col-4"> Votre message </div>

					<div class="col-8">
						<label class="form-label" for="message" name="message">Message</label>
						<textarea class="form-control" id="message" rows="3" name="message"></textarea>
					</div>
				</div>

				<div class="row">
					<button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
				</div>

			</form>
		</div>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$nom = $_POST["nom"];
				$prenom = $_POST["prenom"];
				$ville = $_POST["ville"];
				$email = $_POST["email"];
				$telephone = $_POST["telephone"];
				$message = $_POST["message"];

				try {
					$dsn = "mysql:host=127.0.0.1;dbname=gradu";
					$username = "mysql";
					$password = "mysql";

					$conn = new PDO($dsn, $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql = "INSERT INTO utilisateurs (nom, prenom, ville, email, telephone, message) 
							VALUES (:nom, :prenom,:ville, :email, :telephone, :message)";
						$stmt = $conn->prepare($sql);
					$stmt->bindParam(':nom', $nom);
					$stmt->bindParam(':prenom', $prenom);
					$stmt->bindParam(':ville', $ville);
					$stmt->bindParam(':email', $email);
					$stmt->bindParam(':telephone', $telephone);
					$stmt->bindParam(':message', $message);
					$stmt->execute();

				} catch (PDOException $e) {
					echo "Erreur d'insertion : " . $e->getMessage();
				} finally {
					$conn = null;
				}
			}
		?>


		<!-- FOOTER -->
		<?php include 'footer.php'; ?>