<!DOCTYPEhtml>
<?php
session_start();
?>
<html>
    <head>    
        <title>persoonlijjke pagina</title>
        <link rel="stylesheet"  href="{{asset(css,marktplaats.css)}}"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <div class="col-12" >
            <p><a href = "newAdv.php">Een nieuwe advertentie plaatsen</a></p>
                    <br/>
                <p><a href = "marktplaats.php">Naar homepage</a></p>
        </div>       
        <div>
            <?php
            include "openConn.php";
           
        // bericht verwijderen 
            // $sql = "SELECT titel FROM advertenties WHERE id = '$rowid'";
            // $titelOfText = $connection->query($sql);
            // $titelResult = $titelOfText->fetch(PDO::FETCH_ASSOC);
            
            if(isset($_POST['verwijder'])){                    
                $brweg = $_POST['verwijder'];
                $rijweg= "DELETE FROM advertenties WHERE id='$brweg'";
                $result=$connection->query($rijweg);
            }
      
            //Ik wil nu  alle berichten in een tabel laten zien 
            if(isset($_SESSION['userId'])) {
                $userId = $_SESSION['userId'];
                $sql3 = "SELECT * FROM advertenties WHERE users_id = '$userId'";
                $result3 = $connection->query($sql3);
    

            


                ?>
                <div >
                    <table class = "userTable"  > 
                        <tr>
                            <th class = "col-3" ><h4>foto</h4></th>
                            <th class = "col-1" ><h4>titel</h4></th>
                            <th class = "col-3" ><h4>omschrijving</h4></th>
                            <th class = "col-1" ><h4>categorie</h4></th>
                            <th class = "col-1" ><h4>vraagprijs</h4></th>
                            <th class = "col-1" ><h4>geboden</h4></th>
                            <th class = "col-1" ><h4>plaatsingsdatum</h4></th>
                            <th class = "col-1" ></th>    
                        </tr>

                        <?php 
                        if (!empty($result3)) {                
                            foreach ($result3 as $row){  
                                //alle biedingen laten zien bij elke advertentie
                                $biedingenSql = "SELECT bod FROM biedingen WHERE advertentie_id = 'row[id]'";
                                $biedingen = $connection ->query($biedingenSql);
                                if (!empty($biedingen)) {                
                                    foreach($biedingen as $row){  
                                //$alleBoden = $boden->fetch(PDO::FETCH_ASSOC);
                                //$biedingen = implode(",", $biedingen);

                                echo $biedingen;
                                var_dump($biedingen); die();
                        ?>
                        <tr> 
                            <td class = "col-3"></td>   
                            <td class = "col-1" ><?php echo $row['titel']; ?></td>
                            <td class = "col-3" ><?php echo $row['omschrijving']; ?></td>
                            <td class = "col-1" ><?php echo $row['categorie']; ?></td>
                            <td class = "col-1" >&#8364; <?php echo $row['vraagprijs']; ?></td>
                            <td class = "col-1" ><?php echo $row['bod']; ?></td> 
                            <td class = "col-1" ><?php echo $row['plaatsingsdatum']; ?></td>
                            <td  class = "col-1">
                                <form action="userPage.php" method="POST">
                                    <input type="hidden" name="verwijder" value="<?php echo $row['id'] ?>"/> 
                                    <input type="submit" value="verwijderen" name="submit"/>
                                </form>
                                <form action="userPage.php" method="POST">
                                    <input type="hidden" name="bodAccept" value="<?php echo $row['id'] ?>"/> 
                                    <input type="submit" value="bod accepteren" name="submit"/>
                                </form>
                            </td>    
                        </tr>
                                    
                        <?php
                                    }
                                }        
                            } 
                        }
                        ?>
                    </table>            
                </div>     
        <?php
            }
            // Close connection
            $connection = null; 
        ?>  
   </body>
</html>