<?php
session_start();
error_reporting(0);
include('includes/config2.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
    $ref=intval($_GET['ref']);
    if(isset($_GET['msg']))
    {
        $msg=$_GET['msg'];
    }
    if(isset($_GET['error']))
    {
        $error=$_GET['error'];
    }

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Utilisateur | Modifier le produit</title>
        
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
                        <div class="page-title">Edit Leave Type</div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <form class="col s12" name="chngpwd" action="uploadUpdate.php" method="post" enctype="multipart/form-data">

                        <?php

                        $ref=intval($_GET['ref']);
                        $sql = "SELECT * from produits where ref=:ref";
                        $query = $con -> prepare($sql);
                        $query->bindParam(':ref',$ref,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                        foreach($results as $result)
                        {               ?>  

<?php if($error){?><div class="errorWrap"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div><?php } 
                                                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                        <div class="row">
                                        <input type="hidden" value="<?php echo $ref; ?>" name="refup">
                                            <div class="input-field col s12">
                                                <input id="leavetype" type="text" value="<?php echo htmlentities($result->designation); ?>"  class="validate" autocomplete="off" name="designation"  required>
                                                <label for="leavetype">designation</label>
                                            </div>

                                            <div class="input-field col s12">
                                                <label >Prix</label>
                                                <input type="text" name="prix" value="<?php echo htmlentities($result->prix); ?>" class="form-control" >
                                            </div>
                                            <div class="input-field col s12">
                                                <label >TVA</label>
                                                <input type="text" name="tva" value="<?php echo htmlentities($result->tva); ?>" class="form-control" >
                                            </div>
                                  
                                             <div class="input-field col s12">
                                                <textarea id="textarea1" name="description" class="materialize-textarea"  name="description" length="500"><?php echo htmlentities($result->description_produit); ?></textarea>
                                                <label for="deptshortname">Description</label>
                                            </div>

                                            <div class="col s12">
                                            <input type="file" name="image[]" />
                                                <label for="image" style="font-size: 14px;">Image</label>
                                                <small id="fileHelpId" class="form-text text-muted">Format (png,jpeg,jpg).</small>
                                            </div>
                                        </div>
<?php }} ?>
<div class="input-field col s12">
<button type="submit" name="update" class="waves-effect waves-light btn indigo m-b-xs">Update</button>

</div>




                                        </div>
                                       
                                    </form>
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