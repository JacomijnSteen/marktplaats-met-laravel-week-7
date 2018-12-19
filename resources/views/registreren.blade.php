<!DOCTYPEhtml>
<?php
// Start the session
session_start();
?>

<html>
    <head>    
        <title>registratie pagina</title>
        <link rel="stylesheet"  href="{{asset(css,registreren.css)}}"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
   
    <section class="registreren">
            <p><h3>Hier kunt u registreren</h3></p>
            <br/><br/><br/>
        <form action = "registreren.php" method = "POST">
            <input type = "text" required name = "name" placeholder = "naam" >
                    <br/><br/><br/>
            <input type = "email" required name = "email" placeholder = "email">
                    <br/><br/><br/>
            <input type = "password" required name = "password1" placeholder = "password">
                    <br/><br/><br/>
            <input type = "password" required name = "password2" placeholder = "herhaal uw password">
                    <br/><br/><br/>   
                <input type="submit" name= "registreer" value="Verzenden">
                    <br/><br/><br/>
        </form>
    </section>
    <?php
    // de geregistreerde gegevens opslaan in db marktplaats table users
            include 'openConn.php';

            if(isset($_POST['registreer'])){
                $name = $_POST['name']; 
                $email = $_POST['email'];
                $_SESSION = $_POST['email'];
                                
                $password1 = $_POST['password1'];
                $password2 = $_POST['password2'];
            
                if(empty($name) || empty($password1) ||empty($email) || empty($password2)){
                    echo "<strong>een van de velden is niet ingevuld</strong>"; 
                    
                } elseif ($password1!==$password2){
                    echo "de wachtwoorden zijn niet gelijk";  
                } 
                
                $passwordReg = md5($password1);
                $checkdubbel = "SELECT * FROM  users  WHERE email = '$email'";
                $result = $connection->query($checkdubbel);
                
                if ($result == $_POST['email']){
                    echo "dit emailadres bestaat al ";
                }

                $newPersonSql = "INSERT INTO users (name, email, password)
                                    VALUES ('$name' , '$email' , '$passwordReg')";
                $result = $connection->exec($newPersonSql);
             
                

                if($result === 0) {
                    $err = $connection->errorInfo();
                    print_r($err);
                }
                    echo "<strong> Registratie is gelukt. U kunt nu inloggen </strong>"; 
            }        
            ?> 
            <p><a href = "inloggen.php"><h3> log hier in </h3></a></p>
            <?php     
        // close connection
            $connection = NULL;
            ?>
    </body>
</html>
