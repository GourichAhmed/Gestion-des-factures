
<link rel="stylesheet" href="bootstrap.min.css">
<?php
	session_start();
    include('connection.php');
	$num_fa= $_GET['num_facture'];


	$sql="SELECT client.Nom,client.Prenom,client.Adresse,client.Tel,facture.Num_f,facture.Date,facture.id_C,allprodruits.ref_all_produit from client,facture,allprodruits WHERE client.id_C=facture.id_C AND facture.Num_f=allprodruits.Num_f AND facture.Num_f='$num_fa'";
	$stmt=$con->prepare($sql);
	$stmt->execute();
	$row_detail=$stmt->fetch();
	$ref_all_produit=$row_detail["ref_all_produit"];
	$sql_produit="SELECT produits.ref, produits.designation,produits.description_produit,seule_produit.qte ,seule_produit.prix ,seule_produit.tva from allprodruits,seule_produit,produits WHERE allprodruits.ref_all_produit=seule_produit.ref_all_produit AND produits.ref=seule_produit.ref AND allprodruits.ref_all_produit=:ref_all_produit";
	$stmt_produit=$con->prepare($sql_produit);
	$stmt_produit->execute(["ref_all_produit"=>$ref_all_produit]);
     
	
    define("CONSTANT", 17);
	


	$nombre_detail=0; 
	$cpt=1;
	$total_facture = 0;

	while ($row_produit=$stmt_produit->fetch()) 
	{
		 $nombre_detail++;
	}

 	$reste=($nombre_detail % CONSTANT);
     if($reste>=14)
     {
        define("CONSTANT2", 14);
        $nombre_produit_page = CONSTANT2;
        $reste=($nombre_detail % CONSTANT2);
     }
     else
     {
        $nombre_produit_page = CONSTANT;
     }
	$nombre_ligne=$nombre_detail;
	
	$nombre_pages=ceil($nombre_detail/$nombre_produit_page);

	$cpt_ligne=1;
   

	
	?>

<?php  
		 
         //--------------------------------------------------------------------------------------------------------------------------------
         
         
         $sql="SELECT client.Nom,client.Prenom,client.ICE_C,client.Raison_soc,client.email,client.Adresse_Facturation,client.Adresse,client.Tel,facture.Num_f,facture.Date,facture.id_C,allprodruits.ref_all_produit from client,facture,allprodruits WHERE client.id_C=facture.id_C AND facture.Num_f=allprodruits.Num_f AND facture.Num_f='$num_fa'";
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
                  $brut_ht=0;
                  $tva_calculer=0;
                  $total_tva=0;
                  if($reste > 13 || $reste == 0)
                  {
                      $nombre_des_page=$nombre_des_page+1;
                      

                  }
                  

                  for($i=0; $i < $nombre_de_tou_les_ligne ; $i=$i+$nombre_des_produits_sur_1_page)
                  {
                   
                   
                      $g=$g+1;?>

                        <div style="height: 307mm;width: 210mm;">
                        <?php //include('h.php'); $g=$g+1;?>
                                    <div style="background-color: #00ACC1; height: 100px;">
                                    <div class="logo_complet">
                                        <div class="left_logo">
                                            <img  class="logo" src="LOGO2.png" alt="">
                                        </div>
                                        
                                    </div>
                                    </div>
                                    <div style="height: 254mm;">
                                    <div>
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
                                                   <H1>Facture N <span><?php  echo $row_detail["Num_f"]; ?></span></H1>
                                                </td>
                                                <td style="width: 50%;">
                                                    <table >
                                                        <tr>
                                                            <td>numero de client</td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["id_C"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ICE </td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["ICE_C"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nom et Prenom </td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["Nom"]." ".$row_detail["Prenom"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Societe</td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["Raison_soc"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Adresse</td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["Adresse"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["email"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Telephone</td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["Tel"]; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Adresse facturation</td>
                                                            <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                            <td><?php  echo $row_detail["Adresse_Facturation"]; ?></td>
                                                        </tr>
                                                    </table>
                                                </td>                                   
                                            </tr>
                                        </table>
                                    </div>
                                    <table class="table  " border="1">
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
                                if($d==$reste )
                                {
                                    $pp=$nombre_des_produits_sur_1_page-$reste; 
                                    $nombre_des_produits_sur_1_page=$nombre_des_produits_sur_1_page-$pp;
                                   
                                    
                                }
                                $suiv=$i;
                                    $h=$i+$nombre_des_produits_sur_1_page ;
                                   
                                    $lll=$suiv;
                                    if($d==$reste)
                                    {
                                        $lll=0;
                                      //  $lll=$d-13;
                                             
                                    }
                                    

                                    for ($j=$i; $j < $h; $j++) {?>
							<tbody> 
                               <tr >					
                                    <td> <?php  echo $resulta_pr[$j]["ref"]; ?></td>
                                    <td> <?php  echo "".$resulta_pr[$j]["designation"];?> </td>          
                                    <td> <?php echo $resulta_pr[$j]["qte"];?> </td>
                                    <td class="td_dh"> <?php echo $resulta_pr[$j]["prix"]." DH";?> </td>  
                                    <td class="td_dh" > <?php $montant=$resulta_pr[$j]["qte"]*$resulta_pr[$j]["prix"] ;
                                    echo $montant." DH";  
                                    $brut_ht=$brut_ht+$montant;      
                                    ?></td>  
                                    <td> <?php echo $resulta_pr[$j]["tva"]." %"; 
                                                $tva=$resulta_pr[$j]["tva"];
                                                $tva_calculer=($montant)*($tva/100);
                                                $total_tva=$total_tva+$tva_calculer;
                                    
                                    ?> </td>
								 </tr>                                    
  							 </tbody>            			
 <?php

 
 
}	
$d=$d-$nombre_des_produits_sur_1_page;




 ?> 
</table>
<?php

if($g==$nombre_des_page)
{?>
	<table class="table  " style="width: 40%;float: right;  border-collapse: collapse;" border="1" >
			<tr>
				<td style="background-color: #E7E7E7; border: solid 1px ;">total brut HT (DH)</td>
				<td style=" border: solid 1px ;"><?php echo $brut_ht."  DH";  ?></td>
			</tr>
			<tr>
				<td style="background-color: #E7E7E7; border: solid 1px ;">Total de TVA (DH)</td>
				<td style=" border: solid 1px ;"><?php echo $total_tva."  DH";  ?></td>	
			</tr>
			<tr>
				<td style="background-color: #E7E7E7; border: solid 1px ;">TTC (DH)</td>
				<td style=" border: solid 1px ;"><?php
                        $TTC=$brut_ht+$total_tva;
                         echo $TTC."  DH";  
                    ?></td>
			</tr>
</table>
<?php } ?>
</div>
<div style="height: 80;border-top: solid 1px;">
                                         <table align="center">
                                            <tr>
                                                <td>Adresse</td>
                                                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                <td>rue</td>
                                            </tr>
                                            <tr>
                                                <td>Telephone</td>
                                                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                <td>0585985654</td>
                                            </tr>
                                            <tr>
                                                <td>email</td>
                                                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                                                <td>GL_k@gmail.com</td>
                                            </tr>
                                         </table>
                                    </div>    
                        </div>
                        </div>
                        <?php } ?>

<style>
        .header
        {
            height: 100px;
            width:900px;
            margin-bottom: 30px;
            margin-top: 30px;
            
        }
        .logo_complet
        {
            line-height: 100PX;
            width: 20%;
            
        }
        .logo
        {
       
            line-height: 100PX;
            padding-left: 20px;
            height:100px;
            width: 120px;
        }
        .left_logo
        {
            
            line-height: 100px;
            width: 40px;
            float: left;
        }
        
      
    </style>
    <script>
        window.onload = function () {
            
            window.print();
        
        }
    
    </script>
  