<link rel="stylesheet" href="bootstrap.min.css">
 <?php
	session_start();
	//include('../assets/securite/conexion.php');
	//include('../fonctions-panier.php');
	//include('./tableau_des_langues.php');
    include('connection.php');
	


	$sql="SELECT client.Nom,client.Prenom,client.Adresse,client.Tel,facture.Num_f,facture.Date,facture.id_C,allprodruits.ref_all_produit from client,facture,allprodruits WHERE client.id_C=facture.id_C AND facture.Num_f=allprodruits.Num_f AND facture.Num_f=2";
	$stmt=$con->prepare($sql);
	$stmt->execute();
	$row_detail=$stmt->fetch();
	$ref_all_produit=$row_detail["ref_all_produit"];
	$sql_produit="SELECT produits.ref, produits.designation,produits.description_produit,seule_produit.qte ,seule_produit.prix ,seule_produit.tva from allprodruits,seule_produit,produits WHERE allprodruits.ref_all_produit=seule_produit.ref_all_produit AND produits.ref=seule_produit.ref AND allprodruits.ref_all_produit=:ref_all_produit";
	$stmt_produit=$con->prepare($sql_produit);
	$stmt_produit->execute(["ref_all_produit"=>$ref_all_produit]);
     
	
		define("CONSTANT", 18);
	

	//$id_facture = strip_tags(htmlentities(addslashes($_GET['commande'])));
	//$req_facture = "select * from facture where id='$id_facture'";
//	$res_facture = mysql_query($req_facture);
//	$data_facture = mysql_fetch_assoc($res_facture);


	/*if($data_facture['statut'] == 5)
	{
		define("CONSTANT", 20);
	}
	else
	{
		define("CONSTANT", 24);
	}

	*/



	// $table_langue=get_langues($data_facture['langue']);

	//$table_langue=get_langues($data_facture['langue'],$data_facture['date'],$data_facture['statut']);



	// if ($data_facture['statut'] == 5) {
	// 	header("location: imprimer_facture_fin.php?commande=$id_facture");
	// }



	//$type_prix = $data_facture['devis'];

//	$data_source = mysql_fetch_array(mysql_query("select * from source_commande where id =" . $data_facture['source_commande']));
	//$data_foire = mysql_fetch_array(mysql_query("select * from foire where id =" . $data_source['foire']));


	//$data_supplement_facture = mysql_fetch_array(mysql_query("select * from supplument_facture_artefino where facture = " . $id_facture));


	$nombre_produit_page = CONSTANT;
	$nombre_detail=0; 
	$cpt=1;
	$total_facture = 0;

	//$req_detail_facture = "select *  from detail_facture where commande = " . $id_facture;
	//$res_detail_facture = mysql_query($req_detail_facture);
	while ($row_produit=$stmt_produit->fetch()) 
	{
		 $nombre_detail++;
		 //$is_calculed=true;
		//$req_particu = "select * from facture_particularite where detail_facture = " . $data_detail_facture['id']."";
	//	$res_particu = mysql_query($req_particu);
		/*while ($data_particu = mysql_fetch_array($res_particu)) 
		{ 
			$nombre_detail++; 
			if ($is_calculed) 
			{
				$nombre_detail+=1;
				$is_calculed=false; 
			}
		} */
		
	}

 	$reste=($nombre_detail % CONSTANT);


	/*$data_partcularite = mysql_fetch_array(mysql_query("select count(id) as nbr_partucilarite  from facture_particularite where ));
	= $data_partcularite['nbr_partucilarite'];*/

	$nombre_ligne=$nombre_detail;

	$nombre_pages=ceil($nombre_detail/$nombre_produit_page);

	$cpt_ligne=1;
	
	// echo $reste ; die();

	
	if($reste > 13 || $reste == 0)
	{
		$nombre_pages+=1;
	}
	
	

	?>
 <!DOCTYPE html>
 <html>

 <head>
 	<title> <?php echo $table_langue['facture']; ?> AF-N°<?php echo $data_facture['numero'] . '/' . $data_foire['ref'];  ?></title>
 	
 	<link rel="shortcut icon" href="assests/images/brand/logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="./css/all.css">
 	<meta charset="utf-8">
 </head>
 <body> 

		
		 <?php  
		 
//--------------------------------------------------------------------------------------------------------------------------------


$sql="SELECT client.Nom,client.Prenom,client.Adresse,client.Tel,facture.Num_f,facture.Date,facture.id_C,allprodruits.ref_all_produit from client,facture,allprodruits WHERE client.id_C=facture.id_C AND facture.Num_f=allprodruits.Num_f AND facture.Num_f=2";
$stmt=$con->prepare($sql);
$stmt->execute();
$row_detail=$stmt->fetch();
$ref_all_produit=$row_detail["ref_all_produit"];
$sql_produit="SELECT produits.ref, produits.designation,produits.description_produit,seule_produit.qte ,seule_produit.prix ,seule_produit.tva from allprodruits,seule_produit,produits WHERE allprodruits.ref_all_produit=seule_produit.ref_all_produit AND produits.ref=seule_produit.ref AND allprodruits.ref_all_produit=:ref_all_produit";
$stmt_produit=$con->prepare($sql_produit);
$stmt_produit->execute(["ref_all_produit"=>$ref_all_produit]);


$resulta_pr = $stmt_produit->fetchAll(\PDO::FETCH_ASSOC);
	

$co=3;
		  
	
		
		
		 $nombre_des_produits_sur_1_page=$nombre_produit_page;
		 $nombre_des_page=$nombre_pages;
		 $nombre_de_tou_les_ligne=$nombre_ligne;
		 $d=$nombre_de_tou_les_ligne;
		 $g=0;
		 
     
		 for($i=0; $i < $nombre_de_tou_les_ligne ; $i=$i+$nombre_des_produits_sur_1_page)
		 {
			include('h.php');
			$g=$g+1;
			
			
			  ?>
				<div  style="<?php echo $height; ?>">	 
					<div style="width: 100%;">
						<table class="table table-striped  ">
							<tr>
								<td>
									<table>
										<tr>
											<td>la date de facture</td>
											<td>10/05/2000</td>
										</tr>			
									</table>
								</td>	
								<td><strong>Client</strong></td>
							</tr>
							<tr >
								<td>
								</td>
								<td style="width: 40%;">
									<table >
										<tr>
											<td>numero de client</td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>2</td>
										</tr>
										<tr>
											<td>ICE </td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>24568789465454</td>
										</tr>
										<tr>
											<td>Nom et Prenom </td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>Gourich Ahmed</td>
										</tr>
										<tr>
											<td>Societe</td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>GPX.T</td>
										</tr>
										<tr>
											<td>Adresse</td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>Matmata</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>gpx.t@gmail.com</td>
										</tr>
										<tr>
											<td>Telephone</td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>0631994856</td>
										</tr>
										<tr>
											<td>Adresse facturation</td>
											<td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
											<td>rue 13</td>
										</tr>
									</table>
								</td>
							
							</tr>

						</table>
					</div>
						<!-- Header Taif -->
				




		
 		<div style="padding: 10px;margin-top: -25px; display: inline-block;width: 100%;">
 			
			 <table class="table table-striped table-hover " border="1">
            
                        <thead>  
                            <tr>
                                <th scope="col" >reference</th>
                                <th scope="col" >Désignation</th>
                               
                                <th scope="col" >Quantité</th>
                                <th scope="col" >Prix unitaire</th>
                                <th scope="col" > Montant</th>
                                <th scope="col" >tva de produit (%)</th>
                            </tr>
                        </thead>
					
			  
			<?php
		
		
if($d==$reste)
{
	$pp=$nombre_des_produits_sur_1_page-$reste;

	$nombre_des_produits_sur_1_page=$nombre_des_produits_sur_1_page-$pp;
}



	$h=$i+$nombre_des_produits_sur_1_page ;
		 for ($j=$i; $j < $h; $j++)
		 {  
			
			
			?>


			<?php
		
			
			 
		 	$height="height:1034px;";
		 	if($nombre_pages==1 || $nombre_pages==2)
		 	{
		 		$height="height:1018px;";
		 	}	
			
			
			
			 ?>  

                        
							<tbody> 
                               <tr >
								
                                    <td> <?php  echo $resulta_pr[$j]["ref"]; ?></td>
                                    <td> <?php  echo "".$resulta_pr[$j]["designation"];?> </td>
                                    
                                    <td> <?php echo $resulta_pr[$j]["qte"];?> </td>
                                    <td class="td_dh"> <?php echo $resulta_pr[$j]["prix"]." DH";?> </td>  
                                    <td class="td_dh" > <?php $montant=$resulta_pr[$j]["qte"]*$resulta_pr[$j]["prix"] ;
                                    echo $montant." DH";
                                    
                                    ?></td>  
                                    <td> <?php ?> </td>
									 

								 </tr>                                    
   
  							 </tbody>            
                                 
 			
 <?php




}	

 
  
	 
 
$d=$d-$nombre_des_produits_sur_1_page;
 ?>
  
</table>





	 
 </div>
 
 <?php if($i == $nombre_pages  && $var_nombre_ligne <=10) // include("./paiement_artefino.php"); //?>



 <!-- All facture-->


</div> 
</div> 
<div>	
</div>  
<?php //include("./footer_artefino.php"); ?>							
<?php if($i == $nombre_pages  && $var_nombre_ligne > 10)  include("./nouvelle_page.php"); //?>












<?php  } // FOR ?>


 	

 </body>

 </html>