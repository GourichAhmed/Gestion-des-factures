<?php
session_start();
error_reporting(0);

include('includes/config2.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$idc=intval($_GET['id_c']);
if(isset($_POST['update']))
{

 //  ICE_c firstName lastName email Telephone Raison_S adresseFact AdresseLivr

 $ICE_c=$_POST['ICE_c'];
 $firstName=$_POST['firstName'];
 $lastName=$_POST['lastName'];   
 $email=$_POST['email']; 
 $Telephone=$_POST['Telephone']; 
 $Raison_S=$_POST['Raison_S']; 
 $adresseFact=$_POST['adresseFact']; 
 $AdresseLivr=$_POST['AdresseLivr']; 
 
 $sql="UPDATE client SET Nom=:lastName,Prenom=:firstName,Raison_soc=:Raison_S,Adresse_Facturation=:adresseFact,ICE_C=:ICE_c,Adresse=:AdresseLivr,Tel=:Telephone,email=:email WHERE id_C=:idc";
 $query = $con->prepare($sql);
 $query->bindParam(':lastName',$lastName,PDO::PARAM_STR);
 $query->bindParam(':firstName',$firstName,PDO::PARAM_STR);
 $query->bindParam(':ICE_c',$ICE_c,PDO::PARAM_STR);
 $query->bindParam(':email',$email,PDO::PARAM_STR);
 $query->bindParam(':Telephone',$Telephone,PDO::PARAM_STR);
 $query->bindParam(':Raison_S',$Raison_S,PDO::PARAM_STR);
 $query->bindParam(':adresseFact',$adresseFact,PDO::PARAM_STR);
 $query->bindParam(':AdresseLivr',$AdresseLivr,PDO::PARAM_STR);
 $query->bindParam(':idc',$idc,PDO::PARAM_STR);
 $query->execute();
$msg="Client bien modifier";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Utilisateur | Modifier le client</title>
        
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
                        <div class="page-title">Modifier le Client </div>
                        
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        <h3>Les information de Client modifier</h3>
                                        
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                                 else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                        <div class="page-title"> Code Client :&nbsp;<?php echo $idc ?> </div>
                                            <div class="wizard-content">
                                            
                                               
                                                
                                            
                                                <div class="row">
                                                
                                                    <div class="col m6">
                                                        <div class="row">
<?php 
$idc=intval($_GET['id_c']);
$sql = "SELECT `id_C`, `Nom`, `Prenom`, `Raison_soc`, `Adresse_Facturation`, `ICE_C`, `Adresse`, `Tel`, `email` FROM `client` WHERE id_C=:id";
$query = $con -> prepare($sql);
$query -> bindParam(':id',$idc, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?> 
 
 <div class="input-field col  s12">
<label for="ICE_c">ICE de Client</label>
<input  name="ICE_c" id="ICE_c" value="<?php echo htmlentities($result->ICE_C) ;?>" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>


<div class="input-field col m6 s12">
<label for="firstName">Prenom</label>
<input id="firstName" name="firstName" value="<?php echo htmlentities($result->Prenom) ;?>"  type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Nom</label>
<input id="lastName" name="lastName" type="text" value="<?php echo htmlentities($result->Nom) ;?>"  autocomplete="off" required>
</div>

<div class="input-field col s12">
<label for="email">Email</label>
<input  name="email" type="email" value="<?php echo htmlentities($result->email) ;?>"  id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col s12">
<label for="tel">Telephone</label>
<input id="tel" name="Telephone" type="tel" value="<?php echo htmlentities($result->Tel) ;?>"  maxlength="10" autocomplete="off" required>
</div>
</div>
</div>
                                                    
<div class="col m6">
<div class="row">
<div class="input-field col  s12">
<label for="Raison_S">Societe</label>
<input  name="Raison_S" id="Raison_S" value="<?php echo htmlentities($result->Raison_soc) ;?>"  onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>


                                                    

<div class="input-field col  s12">
<label for="adresseFact">Adresse Factuation</label>
<input  name="adresseFact" id="adresseFact" value="<?php echo htmlentities($result->Adresse_Facturation) ;?>"  onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>



<div class="input-field col  s12">
<label for="AdresseLivr">Adresse de Livraison</label>
<input  name="AdresseLivr" id="AdresseLivr" value="<?php echo htmlentities($result->Adresse) ;?>"  onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>
                                                            

<?php }}?>
                                                        
<div class="input-field col s12">
<button type="submit" name="update"  id="update" class="waves-effect waves-light btn indigo m-b-xs">Modifier</button>

</div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
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