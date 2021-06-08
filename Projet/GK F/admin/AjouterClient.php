<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/config2.php');

if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['add']))
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

$sql="INSERT INTO `client`( `Nom`, `Prenom`, `Raison_soc`, `Adresse_Facturation`, `ICE_C`, `Adresse`, `Tel`, `email`) VALUES (:lastName,:firstName,:Raison_S,:adresseFact,:ICE_c,:AdresseLivr,:Telephone,:email)";
$query = $con->prepare($sql);
$query->bindParam(':lastName',$lastName,PDO::PARAM_STR);
$query->bindParam(':firstName',$firstName,PDO::PARAM_STR);
$query->bindParam(':ICE_c',$ICE_c,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':Telephone',$Telephone,PDO::PARAM_STR);
$query->bindParam(':Raison_S',$Raison_S,PDO::PARAM_STR);
$query->bindParam(':adresseFact',$adresseFact,PDO::PARAM_STR);
$query->bindParam(':AdresseLivr',$AdresseLivr,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $con->lastInsertId();
if($lastInsertId)
{
$msg="Client record added Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Ajouter Client</title>
        
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
        <script src="crud_facture/jQuery.js"></script>
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
    <script type="text/javascript">
function valid()
{
if(document.addemp.password.value!= document.addemp.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.addemp.confirmpassword.focus();
return false;
}
return true;
}
</script>

<script>
function checkAvailabilityEmpid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'empcode='+$("#empcode").val(),
type: "POST",
success:function(data){
$("#empid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function checkAvailabilityEmailid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#emailid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>



    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Ajouter Client</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addemp">
                                    <div>
                                        <h3>Les Information de Client </h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">
                                         <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                         else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>


 <div class="input-field col  s12">
<label for="ICE_c">ICE de Client</label>
<input  name="ICE_c" id="ICE_c" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>


<div class="input-field col m6 s12">
<label for="firstName">Prenom</label>
<input id="firstName" name="firstName" type="text" required>
</div>

<div class="input-field col m6 s12">
<label for="lastName">Nom</label>
<input id="lastName" name="lastName" type="text" autocomplete="off" required>
</div>

<div class="input-field col s12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col s12">
<label for="tel">Telephone</label>
<input id="tel" name="Telephone" type="tel" maxlength="10" autocomplete="off" required>
</div>
</div>
</div>
                                                    
<div class="col m6">
<div class="row">
<div class="input-field col  s12">
<label for="Raison_S">Societe</label>
<input  name="Raison_S" id="Raison_S" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>


                                                    

<div class="input-field col  s12">
<label for="adresseFact">Adresse Factuation</label>
<input  name="adresseFact" id="adresseFact" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>



<div class="input-field col  s12">
<label for="AdresseLivr">Adresse de Livraison</label>
<input  name="AdresseLivr" id="AdresseLivr" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>

</div>

                                                            

                                                        
<div class="input-field col s12">
<a href="dashboard.php"><button type="button" class="waves-effect btn  btn-lg m-b-xs" data-dismiss="modal"> annuler</button></a>

<button type="submit" name="add" onclick="return valid();" id="add" class="waves-effect btn  btn-lg m-b-xs">Ajouter</button>

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