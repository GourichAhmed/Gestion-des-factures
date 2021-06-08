<?php
session_start();
error_reporting(0);
include('includes/config2.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
$user=$_SESSION['alogin'];
if(isset($_POST['update']))
{
    $tele=$_POST['tele'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];   
    $email=$_POST['email']; 

    $sql="UPDATE `admin` SET `Nom_admin`=:lastName,`Prenom_admin`=:firstName,`Email_admin`=:email,`Tel_admin`=:tele WHERE UserName=:user";
    $query = $con->prepare($sql);
    $query->bindParam(':lastName',$lastName,PDO::PARAM_STR);
    $query->bindParam(':firstName',$firstName,PDO::PARAM_STR);
    $query->bindParam(':user',$user,PDO::PARAM_STR);
    
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':tele',$tele,PDO::PARAM_STR);
    $query->execute();
    $msg="votre compte bien modifier";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Utilisateur | mon compte</title>
        
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
                        <div class="page-title">Mon Compte</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatemp">
                                    <div>
                                        <h3>Les information pour modifier mon compte</h3>
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col m6">
                                                        <div class="row">


                                                        <?php 
                                                           //Nom_admin,Prenom_admin,Email_admin,Tel_admin
                                                            $user=$_SESSION['alogin'];
                                                            $sql = "SELECT Tel_admin,Prenom_admin,Nom_admin,Email_admin FROM `admin` WHERE UserName=:user";
                                                            $query = $con -> prepare($sql);
                                                            $query -> bindParam(':user',$user, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt=1;
                                                            if($query->rowCount() > 0)
                                                            {
                                                            foreach($results as $result)
                                                            {               
                                                        ?> 
                                                            <div class="input-field col  s12">
                                                                <label for="empcode">UserNam</label>
                                                                <input  name="UserNam" id="UserNam" value="<?php echo "$user";?>"  type="text" autocomplete="off" readonly required>
                                                                <span id="empid-availability" style="font-size:12px;"></span> 
                                                            </div>


                                                            <div class="input-field col m6 s12">
                                                                <label for="firstName">Prenom</label>
                                                                <input id="firstName" name="firstName" value="<?php echo htmlentities($result->Prenom_admin);?>"  type="text" required>
                                                            </div>

                                                            <div class="input-field col m6 s12">
                                                                <label for="lastName">Nom </label>
                                                                <input id="lastName" name="lastName" value="<?php echo htmlentities($result->Nom_admin);?>" type="text" autocomplete="off" required>
                                                            </div>







                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col m6">
                                                        <div class="row">

                                                            <div class="input-field col s12">
                                                                <label for="email">Email</label>
                                                                <input  name="email" type="email" id="email" value="<?php echo htmlentities($result->Email_admin);?>" readonly autocomplete="off" required>
                                                                <span id="emailid-availability" style="font-size:12px;"></span> 
                                                            </div>
                                                           

                                                            <div class="input-field col s12">
                                                                <label for="phone">Telephone</label>
                                                                <input id="phone" name="tele" type="tel" value="<?php echo htmlentities($result->Tel_admin);?>" maxlength="10" autocomplete="off" required>
                                                            </div>

                                                            <?php }}?>


                                                            


                                                        
                                                            <div class="input-field col s12">
                                                            <button type="submit" name="update"  id="update" class="waves-effect btn  btn-lg m-b-xs">Modifier</button>
                                                            <a href="changerPass.php" class="waves-effect btn  btn-lg m-b-xs">Changer le Mot de pass</a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        
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