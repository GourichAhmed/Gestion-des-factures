<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/config2.php');


include('crud_facture/prix_et_tva.php');
if(in_array($_SERVER['REQUEST_METHOD'], ['GET'])) {
    $num_f= $_GET['num_facture'];
    $num_facture=$num_f;
}
else{
    $num_facture=$_GET['num_facture'];
}


include 'crud_facture/include/connection.php';
include 'crud_facture/DbConnect.php';


if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
        if(isset($_GET['del']))
        {
            $delete_id = $_GET['del'];
            $num_f=$_POST['num_facture'];
            $sql = "DELETE FROM `seule_produit` WHERE ref_seule_produit='$delete_id' ";
            if ($conn->query($sql) === TRUE) {
            
                
            echo '<script>window.location.href="facture?num_facture='.$num_f.'"</script>';
                
                
            } 
        }
         //Ajouter produits---------------------------------------------------------------------------------------------------------       
         if(isset($_POST['add_item'])){
            if($_POST['tva_n']>0 && $_POST['prix_n']>0)
            {
                $tva_prod_ajouter=$_POST['tva_n'];
                $prix_prod_ajouter=$_POST['prix_n'];
        
            }
            else
            {
                $prix_nouveau=999;
                $tva_nouveau=999;
            }
            $num_f=$_POST['num_facture'];
            $ref_prod_ajouter = $_POST['ref'];
            $qte_prod_ajouyer = $_POST['Quantite'];
          
           
            //------------------recuperer ref_all_produit--------------------
            $sql_ref_all_produit="SELECT `ref_all_produit` FROM `allprodruits` WHERE Num_f='$num_facture'";
            $stmt=$con->prepare($sql_ref_all_produit);
            $stmt->execute();
            
            $row_ref_all_produit_recuperer=$stmt->fetch();
            $ref_all_produit_recuperer=$row_ref_all_produit_recuperer['ref_all_produit'];
            //------------------insert into seule_produit-----------------------
            $sql2 = "INSERT INTO `seule_produit`(`ref_all_produit`, `qte`, `ref`, `tva`, `prix`) VALUES ('$ref_all_produit_recuperer','$qte_prod_ajouyer','$ref_prod_ajouter','$tva_prod_ajouter','$prix_prod_ajouter')";
            if ($conn->query($sql2) === TRUE) {

               
                echo '<script>window.location.href="facture.php?num_facture='.$num_f.'"</script>';
               
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
         
           /*
            if ($con->prepare($sql_ref_all_produit) === TRUE) {

                   echo '<script>window.location.href="p3.php"</script>';
                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }*/
        }


    }



    ?>