<?php
include 'include/controller.php';
include 'DbConnect.php';
if(in_array($_SERVER['REQUEST_METHOD'], ['GET'])) {
    $num_f= $_GET['num_facture'];
    $num_facture=$num_f;
}
else{
    $num_facture=$_GET['num_facture'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/loader.css">
    <link rel="stylesheet" type="text/css" href="dashboard/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/responsive.bootstrap.min.css">
</head>

<body onload="myFunction()" style="margin:1cm;">
    <div class="container">
        <div class="dropdown">
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb"style="background-color:#fff;"> 
                <li class="breadcrumb-item"><a href="../../index.php">accueil</a></li>
                <li class="breadcrumb-item"><a href="../index.php">Les Factures</a></li>
                <li class="breadcrumb-item active" aria-current="page">Les produits se trouve dans la facture N <?php echo $num_facture; ?></li>
            </ol>
        </nav>
           <h1 name="num_f">facture N :&nbsp;<?php echo $num_facture; ?> </h1> 
            <a href="#add" data-toggle="modal">
                <button type='button' class='btn btn-success btn-sm'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> ajouter produit sur facture</button>
            </a>
            <a href="../pdf/pdf.php?num_facture=<?php echo $num_facture; ?>" target="_blank" data-toggle="modal">
                 <button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> &nbsp;Detail de facture N :<?php echo $num_facture; ?></button>
            </a>
        </div>
        <br>
        <table id="example" class="display nowrap table table-striped table-hover "  cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">reference de produit</th>
                    <th scope="col">Description</th>
                    <th>quantite</th>
                    <th>prix</th>
                    <th>tva</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>reference de produit</th>
                    <th>Description</th>
                    <th>quantite</th>
                    <th>prix</th>
                    <th>tva</th> 
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                <?php 
                    $sql = "SELECT seule_produit.ref_seule_produit , produits.description, seule_produit.qte, seule_produit.ref,seule_produit.tva, seule_produit.prix FROM `seule_produit`,produits,allprodruits  WHERE allprodruits.ref_all_produit=seule_produit.ref_all_produit AND seule_produit.ref=produits.ref AND allprodruits.Num_f='$num_facture'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $id = $row['ref_seule_produit'];
                            $description = $row["description"];
                            $qte = $row['qte'];
                            $prix = $row['prix'];
                            $tva = $row['tva'];
                            $ref=$row['ref'];
                    ?>
                <tr>
                     
                    <th >
                        <?php echo "#".$id;  ?>
                    </th>
                    <td>
                        <?php echo $ref;  ?>
                    </td>
                    <td>
                        <?php echo $description; ?>
                    </td>
                    <td>
                        <?php echo $qte; ?>
                    </td>
                    <td>                        
                               <?php echo $prix." "."DH"; ?>                       
                    </td>
                    <td>
                                <?php echo $tva." "."%"; ?>   
                    </td>
                    <td>
                    edit
                       
                        <a href="#edit<?php echo $id;?>" data-toggle="modal">
                            <button type='button' class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></button>
                        </a>
                        <a href="#delete<?php echo $id;?>" data-toggle="modal">
                            <button type='button' class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
                        </a>
                      
                    </td>
                   

                  
                    <!--Edit Item Modal -->
                    <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog">
                        <form method="post" class="form-horizontal" role="form">
                            <input type="hidden" id="num_facture"  name="num_facture" value="<?php echo $num_f; ?>">
                            <div class="modal-dialog modal-sm">
                                <!-- Modal content-->
                                <div class="modal-content">
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
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="update_item"><span class="glyphicon glyphicon-edit"></span> Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--Delete Modal -->
                    <div id="delete<?php echo $id; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <form method="post">
                            <input type="hidden" id="num_facture"  name="num_facture" value="<?php echo $num_f; ?>">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Supprimer</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                                        <div class="alert alert-danger">vous vouler vraiment suprimer cette produit dans la facture <strong>
                                                <?php echo $description; ?>?</strong> </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                            <button type="submit" name="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> OUI</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </tr>
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
                                echo '<script>window.location.href="p3.php?num_facture='.$num_f.'"</script>';
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
                                   
                                    
                                    echo '<script>window.location.href="p3.php?num_facture='.$num_f.'"</script>';
                                      
                                      
                                } else {
                                    echo "Error deleting record: " . $conn->error;
                                }
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

                           
                            echo '<script>window.location.href="p3.php?num_facture='.$num_f.'"</script>';
                           
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
    <!--Add Item Modal -->
    <div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <form method="post" action="factureg.php" class="form-horizontal" role="form">
                <input type="hidden" id="num_facture"  name="num_facture" value="<?php echo $num_f; ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ajouter article</h4>
                    </div>
                    <div class="modal-body">
                                <script src="jQuery.js"></script>
                                <script type="text/javascript">
                                     $(document).ready(function(){
                                        $("#ref2").change(function(){
                                            var ref = $("#ref2").val();
                                            $.ajax({
                                                url: 'prix_et_tva.php',
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
                            
                                                <select class="form-select form-control" id="ref2"  name="ref" onchange="myScript2()">
                                                    <option selected="" disabled="" value="-1">chiosie le produit...</option>
                                                    <?php 
                                                     $queryProduit="SELECT `ref`, `description` FROM `produits` ORDER BY ref DESC";
                                                    // $queryProduit->execute();
                                                    $resultprod = $conn->query($queryProduit);
                                                        
                                                        while($rowp=$resultprod->fetch_assoc()){
                                                            echo "<option id='".$rowp['ref']."' value='".$rowp['ref']."'>".$rowp['description']."</option>";
                                                        }
                                                    ?>      
                                                </select>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select a valid state.
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
                                <input type="number" min="1" class="form-control" id="item_category" name="Quantite" placeholder="Item Category" autocomplete="off" required>
                            </div>
                            
                        </div>
       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="add_item"><span class="glyphicon glyphicon-plus"></span> ajouter le produit</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function() {
            $('#example').DataTable({});
        });

    </script>
</body>

</html>
