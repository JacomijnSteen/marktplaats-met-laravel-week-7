<!DOCTYPE html> 
<?php
session_start();
?>
    <head>
        <title>Marktplaats Home</title>
        <html lang = "en">
        <link rel = "stylesheet" type = "text/CSS" href = "marktplaats.css">
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale = 1, shrink-to-fit = no">

        <!-- Bootstrap CSS -->
        <link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity = "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin = "anonymous">
    </head>
    
    <body >
        <div class="container-fluid">
        <div class = "row titelblok">              
                <h1> KRINGLOOP </h1>
        </div>

        <div class = "row verwijzen">    
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary >
                <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultUnchecked" action="marktplaats.php" method = "GET">
                            <h3> selecteer een categorie </h3>
                            <?php
                            include "openConn.php";
                            try {                    
                                $sql4 = "SELECT * FROM categorie ORDER BY id ASC";
                                $result = $connection->query($sql4);    
                                foreach ($result as $row) {
                                ?>
                            <label class = "custom-control-label" for = "defaultUnchecked" input type = "submit" value = "<?php echo $row['id'] ?>"><?php echo $row['name'] ?></label><br/>
                            <?php   
                                }  
                                $connection = NULL;                  
                            }
                            catch(PDOException $e) {
                                echo $sql . "<br>" . $e->getMessage();
                            }
                            ?>
                        </div>              
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        <a class="nav-item nav-link" href = "registreren.php"><span class="navbar-text"><h4>registreer hier</h4></span></a>   
                        <a class="nav-item nav-link" href = "inloggen.php"><span class="navbar-text"><h4>log in</h4></span></a>   
                        <a class="nav-item nav-link" href = "newAdv.php"><span class="navbar-text"><h4>nieuwe advertentie plaatsen</h4></span></a>   
                        <a class="nav-item nav-link disabled" href = "userPage.php"><span class="navbar-text"><h4>naar je eigen overzichtspagina</h4></span></a>   
        
                    </div>
                </div>
            </nav>
        </div>

   

<!-- geen tabel meer maar cards-->
<?php
    codes voor zoekterm en categoriekeuze
        include "openConn.php";
        $userId = $_SESSION['userId'];        
        $sql1 = "SELECT * FROM advertenties ";

            if(isset($_GET['catkeuze'])) {
                $catkeuze =  $_GET['catkeuze'];
                $sql1 .= " WHERE categorie =  '$catkeuze' ";
            }                      

            if(isset($_GET['zoekterm'])){
                $zoek = $_GET['zoekterm'];
                var_dump($zoek);
                                    
                    $sql1 .= "WHERE omschrijving LIKE '%$zoek%'";
            }

            $sql1 .=  "ORDER BY id DESC "; 
            
        $result1 = $connection->query($sql1); 
        ?>
    <div class="row">
        <div class="col-sm-6">
            <?php
            if (!empty($result1)) {                
                foreach ($result1 as $row){                       
            ?>            
            <div class="card">                   
                <div class= "card text-center border-info mb-3 " style = "width: 18rem;">
                    <!--<img class="card-img-top" src=".../100px180/" alt="Card image cap">-->
                        <div class = "card-body">
                            <h5 class = "card-title"><?php echo $row['titel']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['categorie'];?></h6>
                            <p class = "card-text"><?php echo $row['omschrijving']; ?><br/>
                            aangeboden door: <?php echo $row['naamVerkoper']; ?><br/>
                            vraagprijs: <?php  echo $row['vraagprijs']; ?><br/>
                            geplaatst op: <?php echo $row['plaatsingsdatum']; ?><br/>
                            </p>
                            <p> doe een bod: &#8364;<form method = "POST"  action = "marktplaats.php">
                                                        <input type = "text"  name = "bod">
                                                        <input type = "submit">
                                                    </form>  
                        </div> 
                </div>
            </div>
        </div>  
    </div>  

   
   
                <?php
                //alle biedingen laten zien bij elke advertentie
                //$biedingenSql = "SELECT * FROM biedingen WHERE advertentie_id = " . $row['id'];
                //SELECT * FROM biedingen  WHERE advertentie_id = 1
                //$biedingen = $connection ->query($biedingenSql);
                //if (!empty($biedingen)) {                
                   // foreach($biedingen as $row){       
                        //  hoogste bod: &#8364; <?php //echo $boden ; 
                       // echo $biedingen;
                ?>      
            
<?php
               
                // //biedingen
                //         if (isset ($_POST['bod'])){
                //             $bod = $_POST['bod'];
                        

                //             $sql5 = "INSERT INTO biedingen (advertentie_id, bieder_id, bod, plaatsingsdatum)
                //                     VALUES ('$row[id]', '$userId' , '$bod' , NOW())";
                                    
                //             $biedingen = $connection->exec($sql5);                
                //         }
                        
                        //$sqlMaxBod = "SELECT (bod) AS hoogsteBod FROM biedingen WHERE advertentie_id = '$row[id]' ";
                        //$hoogsteBod = $connection->query($sqlMaxBod);      
                  //      $sqlMaxBod = "SELECT bod FROM biedingen WHERE bod=(SELCT MAX(bod) FROM biedingen";
                       // $sqlMaxBod = "SELECT bod FROM biedingen WHERE advertentie_id = '$row[id]' ";
                   //     $hoogsteBod = $connection->query($sqlMaxBod); 
                        //$boden = $hoogsteBod->fetch(PDO::FETCH_ASSOC);
                        // SELECT article, dealer, price
                        // FROM   shop
                        // WHERE  price=(SELECT MAX(price) FROM shop);
               
                    }
                }   
                ?>    
                        
    
    <?php               
     // Close connection
    $connection = null; 
    ?> 

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    </div>
    </body>
</html>