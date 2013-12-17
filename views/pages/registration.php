<?php
//$_GET['error'] == 0 --> l'utilisateur avc mm e-mail existe déjà
//$_GET['error'] == 1 --> format email incorrect
//
// on check $_GET['error'](1) et $_GET['confirm'](2) après qu'il ya l'existence de $_POST
//et ca c'est gère dans index.php --> case(registration)
// sans $_POST les (1) et (2) ne pourraient pas exister
//on check ça qd l'email n'est pas valide
if (isset($_GET['error'])) {
    ?>
    <div class="container">
        <br>
        <div class="row">
            <!--ENTETE-->
            <div class="page-header">
                <h3 class="text-info">Régistration</h3>
            </div>
        </div>
        <form method="post" action="index.php?view=registration">
            <?php if ($_GET['error'] == 0) { ?>
                <div class="alert alert-error">
                    <p>L'utilisateur avec le même e-mail existe déjà. Veuillez entrer un autre e-mail, s'il vous palait.</p>
                </div>
            <?php } elseif ($_GET['error'] == 1) { ?>
                <div class="alert alert-error">
                    <p>L'e-mail introduit n'est pas correct!!! Veuillez réessayer...</p>
                </div>
            <?php } ?>
            <table>
                <tr>
                    <td>Nom* : </td>
                    <td> </td>
                    <td><input type="text" name="surname" required placeholder="Nom"
                               value="<?= $_POST['surname'] ?>"></td>
                </tr>
                <tr>
                    <td>Prenom* : </td>
                    <td> </td>
                    <td> <input type="text" name="name" required placeholder="Prenom"
                                value="<?= $_POST['name'] ?>"></td>
                </tr>
                <tr>
                    <td>Adresse* : </td>
                    <td> </td>
                    <td><input type="text" name="address" required placeholder="Adresse"
                               value="<?= $_POST['address'] ?>"></td>
                </tr>
                <tr>
                    <td>Code postal* : </td>
                    <td> </td>
                    <td><input type="text" name="post_index" required placeholder="Code postal"
                               value="<?= $_POST['post_index'] ?>"></td>
                </tr>
                <tr>
                    <td>E-mail* : </td>
                    <td> </td>
                    <td><input type="text" name="email" required placeholder="E-mail"
                               value="<?= $_POST['email'] ?>"></td>
                </tr>
                <tr>
                    <td>Password* : </td>
                    <td> </td>
                    <td><input type="password" name="password" required placeholder="password"></td>
                </tr>
            </table>
            <br>
            <div class="row">
                <div class="span1">
                    <input type='submit' value="S'enregistrer" class="btn btn-success" id="cart_commander">
                </div>
            </div>
            <br>
            <div class="alert-info span4">
                <h6>(*) Champs obligatoires</h6>
            </div>

        </form>
    </div>
    <?php
//  ici on fait la confirmation par e-mail le design
} elseif (isset($_GET['confirm'])) {
    if ($_GET['confirm'] == 1) {
        //cas du simple enregistrement sans la confirmation
        ?>
        <br>
        <div class="alert alert-success">
            <h4>
                Votre compte a bien été enregistré. <br>
                Les données necéssaires pour l'activation ont étés  envoyés sur votre boite e-mail.
            </h4>
            <p>
                <a href="index.php">Retourner à la page d'acceil.</a>
            </p>
        </div>
        <?php
    } elseif ($_GET['confirm'] == 2) {
        //après avoir confirmé l'e-mail
        ?>
        <br>
        <div class="alert alert-success">
            <h4>
                Votre compte a été activé.
            </h4>
            <p>
                <a href="index.php">Retourner à la page d'acceil.</a>
            </p>
        </div>
        <?php
    }
} else {
    //on affiche le formulaire de depart, tt vide
    ?>
    <div class="container">
        <br>
        <div class="row">
            <!--ENTETE-->
            <div class="page-header">
                <h3 class="text-info">Régistration</h3>
            </div>
        </div>
        <form method="post" action="index.php?view=registration">
            <table>
                <tr>
                    <td>Nom* : </td>
                    <td> </td>
                    <td><input type="text" name="surname" required placeholder="Nom"></td>
                </tr>
                <tr>
                    <td>Prenom* : </td>
                    <td> </td>
                    <td> <input type="text" name="name" required placeholder="Prenom"></td>
                </tr>
                <tr>
                    <td>Adresse* : </td>
                    <td> </td>
                    <td><input type="text" name="address" required placeholder="Adresse"></td>
                </tr>
                <tr>
                    <td>Code postal* : </td>
                    <td> </td>
                    <td><input type="text" name="post_index" required placeholder="Code postal"></td>
                </tr>
                <tr>
                    <td>E-mail* : </td>
                    <td> </td>
                    <td><input type="text" name="email" required placeholder="E-mail"></td>
                </tr>
                <tr>
                    <td>Password* : </td>
                    <td> </td>
                    <td><input type="password" name="password" required placeholder="password"></td>
                </tr>
            </table>
            <br>
            <div class="row">
                <div class="span1">
                    <input type='submit' value="S'enregistrer" class="btn btn-success" id="cart_commander">
                </div>
            </div>
            <br>
            <div class="alert-info span4">
                <h6>(*) Champs obligatoires</h6>
            </div>
        </form>
    </div>
<?php } ?>