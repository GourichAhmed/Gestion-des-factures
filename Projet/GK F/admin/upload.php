<?php
$cn=mysqli_connect("localhost","root","","facture") or die("Could not Connect My Sql");
$output_dir = "images/";/* Path for file upload */
	$RandomNum   = time();
	$ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][0]));
	$ImageType      = $_FILES['image']['type'][0];
 
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	$ImageExt       = str_replace('.','',$ImageExt);
	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
    $ret[$NewImageName]= $output_dir.$NewImageName;
	   
$designation=$_POST['designation'];
$prix=$_POST['prix'];
$description=$_POST['description'];
$tva=$_POST['tva'];
$msg="Le Produit bien ajouter";
$error="Something went wrong. Please try again";

	/* Try to create the directory if it does not exist */
	if (!file_exists($output_dir))
	{
		@mkdir($output_dir, 0777);
	}               
	move_uploaded_file($_FILES["image"]["tmp_name"][0],$output_dir."/".$NewImageName );
	     $sql = "INSERT INTO `produits`( `designation`, `description_produit`, `prix`, `tva`, `image`) VALUES ('$designation','$description','$prix','$tva','$NewImageName')";
		if (mysqli_query($cn, $sql)) {
			echo "successfully !";
           // header("location:javascript://history.go(-1)");
           header('Location: AjouterProduit.php?');

           header("location: AjouterProduit.php?msg=".$msg."");
           
		}
		else {
            header("location: AjouterProduit.php?error=".$error."");
            
		echo "Error: " . $sql . "" . mysqli_error($cn);
	 }

?>