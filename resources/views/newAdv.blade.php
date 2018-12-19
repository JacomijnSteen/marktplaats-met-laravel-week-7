<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <title>nieuwe advertentie plaatsen </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet"  href = "{{asset(css,newAdv.css)}}">
    </head>

    <body>
        <?php
           
        ?> 

        <div class = "bovenregel">
        <p><h2>Plaats hier een nieuwe advertentie</h2></p>
            <br/>
        </div>
        <div>
            <form action = "newAdv.php" method = "POST" class = "newAdv" enctype = "multipart/form-data">
                           Selecteer een foto:
                <input type = "file" name = "foto1" id = "foto1">
            <!--    <input type = "file" name = "foto2" id = "foto2">
                <input type = "file" name = "foto3" id = "foto3">-->
                <br/>
                <input type = "text" name = "titel" placeholder = "titel">
                omschrijving
                <textarea type = "text" cols = "100" rows = "10" name = "omschrijving"></textarea>
                <p class="categorieNewAdv"><h3>selecteer een categorie waaronder dit artikel valt</h3></p>
            <!--categorien selecteren waaruit gekozen kan worden-->
                    <?php
                    include "openConn.php";
                    try {
                        $sql4 = "SELECT * FROM categorie ORDER BY id ASC";
                        $result = $connection->query($sql4);    
                            ?>
                
                            <?php
                            foreach ($result as $row) {
                            ?>
                            <input type="checkbox"  name="catkeuze"  value="<?php echo $row['name'] ?>">
                                <?php echo $row['name'] ?><br/>
                            <?php   
                            }  
                           // $connection = NULL;  
                            ?>
                     
                        <?php
                    }
                    catch(PDOException $e) {
                    echo $sql . "<br>" . $e->getMessage();
                    }
                    ?>
                    <br/>
                <input type="text" name="name" placeholder="aangeboden door">
                    <br/><br/>
                <input type="text" name="prijs" placeholder="vraagprijs">
                     <br/><br/>   
                <input type = "submit" name = "submit" value = "plaats de advertentie">
            </form>
        </div>    
        
         <?php
        include 'openConn.php';
        //checken of velden ingevuld zijn.
        if(isset($_POST["submit"])){

            $naamVerkoper = $_POST['name'];
            $titel = $_POST['titel'];
            $omschrijving = $_POST['omschrijving']; 
            $users_id = $_SESSION['userId'];
            $vraagprijs=$_POST['prijs'];     
            $categorie = $_POST['catkeuze'];

            if(empty($naamVerkoper) || empty($vraagprijs) || empty($omschrijving)){     
                echo "naam, vraagprijs of omschrijving is niet ingevuld.";
            }elseif(empty($_POST['catkeuze'])) {
                    echo "selecteer een categorie waar je artikel onder valt";
            }else{

                function schoonmaken($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

            //de velden naam email en bericht bewapenen tegen hackers inputs
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $naamVerkoper = schoonmaken($_POST['name']);
                    $titel = schoonmaken($_POST['titel']);
                    $omschrijving = schoonmaken($_POST['omschrijving']);    
                }            
            }
            //nieuwe advertentie opslaan in db   
                $sql1 = "INSERT INTO advertenties (titel , omschrijving, naamVerkoper, vraagprijs, plaatsingsdatum, users_id, categorie) 
                        VALUES ('$titel' , '$omschrijving' , '$naamVerkoper' , '$vraagprijs' ,   NOW() , '$users_id' , '$categorie')";      
                $result = $connection->exec($sql1);

                if($result === 0){
                    $err = $connection->errorInfo();
                    print_r($err);
                } 
                // if(isset($_POST['submit'])) {
                    header('Location:marktplaats.php');
                    
        } 
        
        //    $resultId = $connection->lastInsertId();
            
                    
        
        //     //foto's naar file sturen
        //     $target_dir = "C:\Users\Makro\Pictures\CodeGorillaMarktplaats\Marktplaats";
        //     $target_file = $target_dir . basename($_FILES["foto1"]["name"]);
        //     $uploadOk = 1;
        //     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //     // Check if image file is a actual image or fake image
        //     if(isset($_POST["submit"])) {
        //         $check = getimagesize($_FILES["foto1"]["tmp_name"]);
        //         if($check !== false) {
        //             echo "File is an image - " . $check["mime"] . ".";
        //             $uploadOk = 1;
        //         } else {
        //             echo "File is not an image.";
        //             $uploadOk = 0;
        //         }
        //     } 
        // // Check if file already exists
        //     if (file_exists($target_file)) {
        //         echo "Sorry, file already exists.";
        //         $uploadOk = 0;
        //     }
            
        // //Check file size
        //     if ($_FILES["foto1"]["size"] > 500000) {
        //         echo "Sorry, je foto is te groot.";
        //         $uploadOk = 0;
        //     }

        // // Allow certain file formats
        //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        //     && $imageFileType != "gif" ) {
        //         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //         $uploadOk = 0;
        //     }
        // // Check if $uploadOk is set to 0 by an error
        //     if ($uploadOk == 0) {
        //         echo "Sorry, your file was not uploaded.";
        // // if everything is ok, try to upload file
        //     } else {
        //         if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_file)) {
        //             echo "De foto is opgeslagen";
        //         } else {
        //             echo "Sorry, de foto kon niet worden opgeslagen.";
        //         }
        //     }
        
        
        // Close connection
            $connection = null; 
            ?>
        
    </body>
</html>
