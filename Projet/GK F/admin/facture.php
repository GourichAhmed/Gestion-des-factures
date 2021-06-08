<?php
session_start();
error_reporting(0);

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
            
                
            //echo '<script>window.location.href="facture?num_facture='.$num_facture.'"</script>';
                
                
            } 
        }

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="js css/bootstrap.min.css">
    
    <script src="js css/bootstrap.min.js"></script>
    <script src="js css/jquery-1.12.4.js"></script>
    <link rel="stylesheet" type="text/css" href="js css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="js css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="js css/style.css">
	<link rel="stylesheet" type="text/css" href="js css/dataTables.min.css">
	<link rel="stylesheet" href="js css/jquery-ui.css">
	<link rel="stylesheet" media="screen" href="js css/main-clock.css"/>

	<script src="js css/google.jquery.js"></script>
	<script src="js css/jquery-3.3.1.min.js"></script>
	<script src="js css/jquery-1.12.4.js"></script>
	<script src="js css/jquery-ui.js"></script>
	<script src="js css/font-awesome.min.js"></script>
    <script src="js css/bootstrap.min.js"></script>
    <script src="js css/dataTables.min.js"></script>
    <script language="javascript" type="text/javascript" src="js css/jquery.thooClock.js"></script> 
        
        <!-- Title -->
        <title>Utilisateur | Gestion des produits dans la facture</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

        <!-- Theme Styles -->
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body>
       <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
            <main class="mn-inner">
                <div class="row">
                
                    <div class="col s12">
                        <div class="page-title">Gestion des produits dans la facture</div>
                    </div>
                    <div class="col s12 m12 l12">
                    <div >
                    <div class="dropdown">
                    
                    <h5 name="num_f">facture N :&nbsp;<?php echo $num_facture; ?> </h5> 
                      
                            <button type="button" class="waves-effect btn  btn-lg m-b-xs" data-toggle="modal" data-target="#addProduits"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> ajouter produit sur facture</button>
                        
                        <a href="impr/d.php?num_facture=<?php echo $num_facture; ?>" target="_blank" data-toggle="modal">
                            <button type='button' class='waves-effect btn  btn-lg m-b-xs'> &nbsp;Detail de facture N :<?php echo $num_facture; ?></button>
                        </a>
                    </div>
                    <br>
                    
                </div>
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Les information des produits</span>
                                 <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>reference de produit</th>
                                            <th>Description</th>
                                            <th>quantite</th>
                                            <th>prix</th>
                                            <th>tva</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
                    $sql = "SELECT seule_produit.ref_seule_produit , produits.designation, seule_produit.qte, seule_produit.ref,seule_produit.tva, seule_produit.prix FROM `seule_produit`,produits,allprodruits  WHERE allprodruits.ref_all_produit=seule_produit.ref_all_produit AND seule_produit.ref=produits.ref AND allprodruits.Num_f='$num_facture'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $id = $row['ref_seule_produit'];
                            $designation = $row["designation"];
                            $qte = $row['qte'];
                            $prix = $row['prix'];
                            $tva = $row['tva'];
                            $ref=$row['ref'];

              ?>  
                                        <tr>
                                            <td> <?php echo "#".$id;?></td>
                                            <td> <?php echo $ref;?></td>
                                            <td><?php echo $designation;?></td>
                                            <td><?php echo $qte;?></td>
                                            <td><?php  echo $prix." "."DH";?></td>
                                            <td><?php echo $tva." "."%";?></td>
                                            <td> <a href="#edit<?php echo $id;?>" data-toggle="modal"><i class="material-icons">mode_edit</i>
                                                </a>
                                                <a href="facture.php?del=<?php echo $id;?>&num_facture=<?php echo $num_facture;?>" onclick="return confirm('Do you want to delete');"> <i class="material-icons">delete_forever</i></a>
                                            </td>


                                             <!--Edit Item Modal -->
                                                <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog" style="height: 1000px;">
                                                    <form method="post" class="form-horizontal" role="form">
                                                        <input type="hidden" id="num_facture"  name="num_facture" value="<?php echo $num_f; ?>">
                                                        <div class=" ">
                                                            <!-- Modal content-->
                                                            <div >
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Modifier le produit</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="edit_item_id" value="<?php echo $id; ?>">
                                                                    <div class="form-group">
                                                                        
                                                                        <label for="item_code">reference de produit:</label>
                                                                        <input type="text" readonly class="form-control" id="item_code" name="item_code" disabled value="<?php echo $ref; ?>" placeholder="Item Code" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="item_name">Prix de produit (DH):</label>
                                                                        <input type="text" class="form-control" id="item_name" name="prix_modifier" value="<?php echo $prix; ?>" placeholder="Item Name" required autofocus>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="item_description">TVA (%):</label>
                                                                        <input type="text" class="form-control"  name="tva_modifier" placeholder="tva" value="<?php echo $tva; ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="item_category">Quantite:</label>
                                                                        <input type="number" class="form-control" id="item_category" name="qte_modifier" value="<?php echo $qte; ?>" placeholder="Quantite" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" style="margin-left: 10px;margin-right: 10px;" class="btn btn-lg" name="update_item"><i class="material-icons">mode_edit</i> Modifier</button>
                                                                    <button type="button" style="margin-left: 10px;margin-right: 10px;" class="btn btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Annuler</button>
                             
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                               

                                        </tr>
                                        <?php ?>
                                        <!--------------------------------------------------------------------->


                                       


                                        <!------------------------------------------------------------>
                                         <?php $cnt++; }?>
                                         <?php
                        }
                        


                    //Modifier le produit---------------------------------------------------------------------------------------------------------
                        if(isset($_POST['update_item'])){
                            $ref_seule=$_POST['edit_item_id'];
                            $edit_prix = $_POST['prix_modifier'];
                            $edit_tva = $_POST['tva_modifier'];
                            $edit_qte = $_POST['qte_modifier'];
                           
                   
                            $num_f=$_POST['num_facture'];
                            $sql = "UPDATE `seule_produit` SET 
                                `qte`='$edit_qte',
                                `tva`='$edit_tva',
                                `prix`='$edit_prix' 
                                WHERE ref_seule_produit='$ref_seule'";
                            if ($conn->query($sql) === TRUE) {
                                echo '<script>window.location.href="facture.php?num_facture='.$num_f.'"</script>';
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        }
                    // Supprimer le produit---------------------------------------------------------------------------------------------------------

                        if(isset($_POST['delete'])){
                                
                                $delete_id = $_POST['delete_id'];
                                $num_f=$_POST['num_facture'];
                                $sql = "DELETE FROM `seule_produit` WHERE ref_seule_produit='$delete_id' ";
                                if ($conn->query($sql) === TRUE) {
                                   
                                    
                                    echo '<script>window.location.href="facture.php?num_facture='.$num_f.'"</script>';
                                      
                                      
                                } else {
                                    echo "Error deleting record: " . $conn->error;
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

                           
                            echo '<script>window.location.href="facture.php?num_facture='.$num_facture.'"</script>';
                           
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
                   ?>


                                    </tbody>
                                </table>
                              
                                   
    
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
        </div>

         
 
    
   





            <!-- Modal content-->
            <div>
            <div>
                <form method="POST" role="form" style="height: 400px;"   id="addProduits" class="modal fade form-horizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" class="modal-content">
                <input type="hidden" id="num_facture"  name="num_facture" value="<?php echo $num_f; ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ajouter article</h4>
                    </div>
                    <div class="modal-body">
                                
                                <script type="text/javascript">
                                     $(document).ready(function(){
                                        $("#ref2").change(function(){
                                             var ref = $("#ref2").val();
                                            $.ajax({
                                                url: 'crud_facture/prix_et_tva.php',
                                                method: 'post',
                                                data: 'ref=' + ref
                                            }).done(function(prod){
                                                console.log(prod);
                                                prod = JSON.parse(prod);
                                                $('#prix').empty();
                                                $('#tva').empty();
                                                prod.forEach(function(prod1){
                                                    $('#prix2').html( '<input name="prix_n" class="form-control" placeholder="00" type="text" value="'+prod1.prix+'" >');
                                                    $('#tva2').html( '<input name="tva_n" class="form-control" placeholder="00" type="text" value="'+prod1.tva+'" >')
                                                })
                                            })
                                        })
                                    })
                                </script>
                                <script>
                                    function myScript2()
                                    {
                                        var x = document.getElementById("demo2");
                                        x.style.display="block";
                                    }
                                </script>
                                         <div class="form-group" >
                                                <label for="validationCustom04" class="control-label col-sm-2 form-label" >Produits</label>
                                                <div class="col-sm-4">
                            
                                                <select  id="ref2"  name="ref" onchange="myScript2()">
                                                    <option selected="" disabled="" value="-1">chiosie le produit...</option>
                                                    <?php 
                                                     $queryProduit="SELECT `ref`, `designation` FROM `produits` ORDER BY ref DESC";
                                                    // $queryProduit->execute();
                                                    $resultprod = $conn->query($queryProduit);
                                                        
                                                        while($rowp=$resultprod->fetch_assoc()){
                                                            echo "<option id='".$rowp['ref']."' value='".$rowp['ref']."'>".$rowp['designation']."</option>";
                                                        }
                                                    ?>      
                                                </select>
                                                </div>
                                                
                                        </div>
                                        <div class="form-group" id="demo2" style="display: none;">      
                                                        <label class="control-label col-sm-2">Prix (DH)</label>
                                                        <div id="prix2" class="col-sm-3"></div>
                                                        <label class="control-label col-sm-2">TVA (%)</label>
                                                        <div id="tva2" class="col-sm-3"></div>
                                         
                                        </div>            
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="item_category">Quantite:</label>
                            <div class="col-sm-4">
                                <input type="number" min="1" class="" id="item_category" name="Quantite" placeholder="Item Category" autocomplete="off" required>
                            </div>
                            
                        </div>
       
                    </div>
                    <div class="modal-footer" style="height: 10px;">
                        <button type="submit" class="btn btn-lg" style="margin-left: 10px;margin-right: 10px;" name="add_item"><span class="glyphicon glyphicon-plus"></span> ajouter le produit</button>
                        <button type="button" class="btn btn-lg" style="margin-left: 10px;margin-right: 10px; " data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Annuler</button>
                    </div>
                </form>
            </div>
            </div>


        <div class="left-sidebar-hover"></div>


        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>






   
       
</html>
