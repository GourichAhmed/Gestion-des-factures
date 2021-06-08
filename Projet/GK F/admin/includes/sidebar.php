 <?php
 session_start();
error_reporting(0);
include('../includes/config2.php');

if(strlen($_SESSION['alogin'])==0)
    {   
header('location:../index.php');
} else{


?>
     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="../assets/images/profile-image.png" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">
                        <?php
                            $aid=$_SESSION['alogin'];
                            $sql = "SELECT Nom_admin,Prenom_admin FROM `admin` WHERE UserName=:aid";
                            $query = $con -> prepare($sql);
                            $query->bindParam(':aid',$aid,PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {               ?>
                                                            <p><?php echo htmlentities($result->Prenom_admin." ".$result->Nom_admin);?></p>
                                                           
                                                    <?php }} ?>
                       
                              

                         
                        </div>
                    </div>
                    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                    <li class="no-padding"><a class="waves-effect waves-grey" href="dashboard.php"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
                    <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php"><i class="material-icons">account_circle</i>My Profiles</a></li>

                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">receipt_long</i>Facture<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="AjouterFacture.php">Ajouter Facture</a></li>
                                <li><a href="GestionFactures.php">Gestionn des Factures</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">store</i>Produits<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="AjouterProduit.php">Ajouter Produit</a></li>
                                <li><a href="GestionProduits.php">Gestionn des Produits</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">account_box</i>Cients<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="AjouterClient.php">Ajouter Cient</a></li>
                                <li><a href="GestionClient.php">Gestionn des Cients</a></li>
                            </ul>
                        </div>
                    </li>
                    
                        <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Se déconnecter</a>
                            </li>  
                 

                 
              
                </ul>
                   <div class="footer">
                   <p class="copyright"><a href="#">BY AHMED</a>©</p>
                
                </div>
                </div>
            </aside>
            <?php } ?>