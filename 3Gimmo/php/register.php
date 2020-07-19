<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "3gimmo";

$conn = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName);

if(!$conn){
    die("Connection faild".mysqli_error($conn));
}

if (isset($_POST["submit"])){
    $nom =$_POST["nom"];
    $prenom =$_POST["prenom"];
    $email =$_POST["email"];
    $telephone =$_POST["telephone"];

    $errorEmpty = false;
    $errorEmail = false;

    if(empty($nom)){
        echo"<span class='red-text'>Votre nom n'est pas valide.</span></br>";
        $errorEmpty = true ; 
    }
    if(empty($prenom)){
        echo"<span class='red-text'>Votre prénom n'est pas valide. </span></br>";
        $errorEmpty = true ; 
    }
    if(empty($telephone)){
        echo"<span class='red-text'>Votre téléphone n'est pas valide. </span></br>";
        $errorEmpty = true ; 
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<span class='red-text'>Votre email n'est pas valide. </span></br>";
        $errorEmail = true;
    }
}else{
    echo"<span class='red-text'>Erreur. </span>";
}
if(($errorEmail || $errorEmpty) != 1)
{
    $sql = "SELECT user_email FROM user WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0)
    {
        $sql = "INSERT INTO user (user_name,user_surname,user_email,user_telephone)VALUES ('$nom','$prenom','$email','$telephone')";
        if (!mysqli_query($conn, $sql))
        {
            echo "Error: " . $sql . "" . mysqli_error($conn);
        }else {
            echo"<span class='green-text'>Vous avez bien été inscrit.</span></br>";
        }
    }else{
        echo"<span class='red-text'>Cette adresse email a déjà été utilisé.</span> ";
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