<?php
session_start();
error_reporting(0);

include('includes/config2.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['add']))
{
$deptname=$_POST['departmentname'];
$deptshortname=$_POST['departmentshortname'];
$deptcode=$_POST['deptcode'];   
$sql="INSERT INTO tbldepartments(DepartmentName,DepartmentCode,DepartmentShortName) VALUES(:deptname,:deptcode,:deptshortname)";
$query = $dbh->prepare($sql);
$query->bindParam(':deptname',$deptname,PDO::PARAM_STR);
$query->bindParam(':deptcode',$deptcode,PDO::PARAM_STR);
$query->bindParam(':deptshortname',$deptshortname,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

$msg="Department Created Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
//----------------------------------------------------------------------------------------------------------------
$queryClient=$con->prepare("SELECT `id_C`, `Nom`, `Prenom` FROM `client` ORDER BY id_C DESC ");
$queryClient->execute();
        
   
if(isset($_POST['ajouter_facture']))
{

  $date_facture=$_POST['date'];
  $id_client=$_POST['id_C'];

  

  $sql="INSERT INTO `facture`( `Date`, `id_C`) VALUES (:datef,:id_C)";
  $stmt=$con->prepare($sql);
  $stmt->execute(['datef'=>$date_facture,'id_C'=>$id_client ]);

  //-------------recuperer la dernier facture ---------------
  $lastfacture=$con->prepare("SELECT  Num_f FROM facture  ORDER BY Num_f DESC   LIMIT 1");
  $lastfacture->execute();
  while($rownumfacture=$lastfacture->fetch()){
      $Num_f= (int)$rownumfacture['Num_f'];
  }

  $inserallprodruits="INSERT INTO `allprodruits`(`Num_f`) VALUES (:numf)";
  $stmt2=$con->prepare($inserallprodruits);
  $stmt2->execute(['numf'=>$Num_f]);
  $url="facture.php?num_facture=$Num_f";
  header("Location: $url");
  //crud_facture/p3.php?num_facture=<?php echo $num_f; ?
}


//----------------------------------------------------------------------------------------------------------------




    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Utilisateur | Nouveau facture</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
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
                        <div class="page-title">ajouter une nouveau facture</div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                   
                                    <div  role="dialog">
        <form method="post" class="form-horizontal" role="form">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                       
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                            <label for="validationCustom04" class="form-label">Clients</label>
                            <select class="form-select" name="id_C" id="validationCustom04"   required>
                                <option selected disabled value="-1" >chiosie le client...</option>
                                <?php    while($rowClient=$queryClient->fetch()){     ?>
                                <option  value="<?=$rowClient['id_C'];?>"><?=$rowClient['Nom']." ".$rowClient['Prenom']; ?></option>
                                <?php }?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                    </div>
                    <div class="form-group">
                            <label>Date de Facture</label>
                            <input type="date" name="date" class="form-control" placeholder="Order Placed on" required="required" />
                        </div>
                      
                    </div>
                    <div class="modal-footer">
                    <a href="dashboard.php"><button type="button" class="waves-effect btn  btn-lg m-b-xs" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> annuler</button></a>
                        <button type="submit" class="waves-effect btn  btn-lg m-b-xs" name="ajouter_facture"><span class="glyphicon glyphicon-edit"></span> Ajouter</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
                                </div>
                            </div>
                        </div>
                     
             
                   
                    </div>
                
                </div>
            </main>

        </div>
        
        <div class="left-sidebar-hover"></div>
        
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 