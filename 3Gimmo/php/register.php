<?php

//---------Connection DB -----------

$dsn = 'mysql:dbname=3gimmo;host=localhost';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

if (isset($_POST["submit"])){
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom =htmlspecialchars($_POST["prenom"]);
    $email =htmlspecialchars($_POST["email"]);
    $telephone =htmlspecialchars($_POST["telephone"]);

    $errorEmpty = false;
    $errorEmail = false;
//-------------------Verification des champs---------- 
    if(empty($nom)){
        echo"<span class='red-text'>Votre nom n'est pas valide.</span></br>";
        $errorEmpty = true ; 
    }
    if(empty($prenom)){
        echo"<span class='red-text'>Votre prénom n'est pas valide. </s pan></br>";
        $errorEmpty = true ; 
    }
    if(empty($telephone)){
        echo"<span class='red-text'>Votre téléphone n'est pas valide. </span></br>";
        $errorEmpty = true ; 
    }elseif(!preg_match('`[0-9]{10}`',$telephone)){
        echo"<span class='red-text'>Votre téléphone n'est pas correct </span></br>";
        $errorEmpty = true ; 
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<span class='red-text'>Votre email n'est pas valide. </span></br>";
        $errorEmail = true;
    }
}else{
    echo"<span class='red-text'>Erreur. </span>";
}

//--------------------Insertion Data Base ---------

if(($errorEmail || $errorEmpty) != 1)
{
    $email_request = $dbh->prepare('SELECT * FROM user WHERE user_email= ?');    
    $email_request->execute(array($email));

    $telephone_request = $dbh->prepare('SELECT * FROM user WHERE user_telephone= ?');    
    $telephone_request->execute(array($telephone));

    if (!$email_request->rowCount() == 0)
    {   
        echo"<span class='red-text'>Cette adresse email a déjà été utilisé.</span> ";
        
    }elseif(!$telephone_request->rowCount() == 0)
    {
        echo"<span class='red-text'>Ce numero de téléphone a déjà été utilisé.</span> ";
    }
    else{
        $insert_request = $dbh->prepare("INSERT INTO user (user_name,user_surname,user_email,user_telephone) VALUES (?,?,?,?)");
        if (!$insert_request->execute(array($nom,$prenom,$email,$telephone)))
        {
            echo "Erreur";
        }else {
            echo"<span class='green-text'>Vous avez bien été inscrit.</span></br>";
        }
    }
}
?>

<script>
    $("#mail,#nom,#prenom,#telephone").removeClass("error");

    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorEmail = "<?php echo $errorEmail; ?>";

    if(errorEmail == true ){
        $("#email").addClass("");
    }
    if (errorEmail == false && errorEmpty == false){
        $("#email,#nom,#prenom,#telephone").val("");
    }
</script>