<?php
 
 $ref=$_POST['refup'];
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
    echo $NewImageName ;
 $designation=$_POST['designation'];
 $prix=$_POST['prix'];
 $description=$_POST['description'];
 $tva=$_POST['tva'];

 
 if (!file_exists($output_dir))
 {
     @mkdir($output_dir, 0777);
 }               
// 
 move_uploaded_file($_FILES["image"]["tmp_name"][0],$output_dir."/".$NewImageName );
      $sql = "UPDATE `produits` SET `designation`='$designation',`description_produit`='$description',`prix`='$prix',`tva`='$tva',`image`='$NewImageName' WHERE ref='$ref'";
     if (mysqli_query($cn, $sql)) {
         
        $msg="Le Produit bien Modifier";
        header("location: ModifierProduit.php?msg=".$msg."&ref=".$ref."");
     }
     else {
         $error="Something went wrong. Please try again";
         header("location: ModifierProduit.php?error=".$error."&ref=".$ref."");
        
  }