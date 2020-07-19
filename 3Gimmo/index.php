<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>3G Immo</title>
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("form").submit(function(event){
                    event.preventDefault();
                    var nom = $("#nom").val();
                    var prenom = $("#prenom").val();
                    var email = $("#email").val();
                    var telephone = $("#telephone").val();
                    var submit =$("#submit").val();
                    $(".form-message").load("php/register.php", {
                        nom : nom,
                        prenom: prenom,
                        email: email,
                        telephone: telephone,
                        submit: submit
                    })
                })
            })
        </script>
    </head>
    <body>
        <h1 class="center">3G immo Google Form</h1>
        <div class="row">
            <form action="php/register.php" method="POST" class="col s6 offset-s3">
            <div class="row">
                <div class="input-field col s6">
                    <input id="nom" type="text" class="validate"name="nom" >
                    <label for="nom">Nom</label>
                </div>
                <div class="input-field col s6">
                    <input id="prenom" type="text" class="validate" name="prenom">
                    <label for="prenom">Prénom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate" name="email">
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="Erreur de saisie"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="telephone" type="text" class="validate" >
                    <label for="telephone">Téléphone</label>
                </div>

                <button id="submit" type="submit" name="submit" class="waves-effect waves-light btn" >S'inscrire </button> 
                <p class="form-message center"></p>
            </form>
        </div>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>​