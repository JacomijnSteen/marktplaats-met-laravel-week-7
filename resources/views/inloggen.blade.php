<!DOCTYPEhtml>
<?php
session_start();
?>
<html>
    <head>    
        <title>inlogpagina</title>
        <link rel="stylesheet" type="text/CSS" href="inloggen.css"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet"  href = "{{asset(css,inloggen.css)}}">

    </head>
    <body>
    <!-- <?php
        // include 'openConn.php';
        // if(isset($_POST['logIn'])){

        //     if(empty ($_POST['inlogEmail']) || empty ($_POST['inlogPassword'])){
        //         header('Location:inloggen.php?error=emptyfield');
            
        //     }else{
        //         $inlogEmail = $_POST['inlogEmail'];
        //         $inlogPassword = $_POST['inlogPassword'];
            
        //         $passwordLogin = md5($inlogPassword);
                    
        //         // check alleen op email en password
        //         $emailPasswordCheck = "SELECT * FROM users WHERE email = '$inlogEmail' AND password = '$passwordLogin' ";
                
        //         $check = $connection->query($emailPasswordCheck);
          
        //         if($check->rowCount() != 1){
        //             echo "naam en password combinatie onjuist";
                    
        //         } else {

        //         $getUserId = "SELECT id FROM users WHERE email = '$inlogEmail' AND password = '$passwordLogin'";

        //         $user = $connection->query($getUserId);
                    
        //         foreach ($user as $row) {
        //             // $row = $user->fetch(PDO::FETCH_ASSOC)
        //             $userId = $row['id'];
        //             $_SESSION['userId'] = $userId;  
                

        //         header('Location:userPage.php');
        //         }    
        //         }
        //     }
        // }
    ?>
           -->
        <section class="inloggen">
            <p><h3>Log in</h3></p>
                <br/><br/><br/>
            <form action = "inloggen.php" method = "POST">
                <?php echo isset($_GET["error"]) && $_GET["error"] == 'emptyfield' ? 'Een veld is niet ingevuld<br>': ''; ?>
                <input type = "email" required name = "inlogEmail" placeholder = "email">
                    <br/><br/><br/>
                <input type = "password" required name = "inlogPassword" placeholder = "password">
                    <br/><br/><br/>
                <input type="submit" name="logIn" value="Log in">
                    <br/><br/><br/>
            </form>
        </section>
    <?php
    // close connection
   // $connection = NULL;
    ?>
    
    </body>
</html>
