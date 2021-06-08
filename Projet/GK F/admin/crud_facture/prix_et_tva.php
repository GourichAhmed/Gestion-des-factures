
<?php 
	require 'DbConnect.php';

	if(isset($_POST['ref'])) {
		
		require 'DbConnect.php';
		$stmt = $con->prepare("SELECT * FROM produits WHERE ref = " . $_POST['ref']);
		$stmt->execute();
		$prod = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($prod);
	}
	function loadAuthors() {
		require 'DbConnect.php';
		$stmt = $con->prepare("SELECT * FROM produits  ORDER BY ref DESC");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}
    $stmt = $con->prepare("SELECT * FROM produits  ORDER BY ref DESC");
    $stmt->execute();
 ?>
 