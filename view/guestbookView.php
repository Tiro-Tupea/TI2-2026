<?php
# view/guestbookView.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TI2 | Livre d'or</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="./img/creation-de-logo.png" alt="logo">
    </div>
    <div class="title">
        <h1>Livre d'or</h1>
        <p>Laissez une trace de votre passage !</p>
    </div>
    <div class="admin">
        <div class="btn-admin"><img src="./img/126472.png" alt="icon"><span>Administration</span></div>
    </div>


</header>

<!-- Formulaire d'ajout d'un message -->
<main>

    <section class="left">
        <div class="book-img">
            <img src="./img/livre-ouvert (2).png" alt="book">
        </div>
         <div class="left-form">
            <h2>Votre message</h2>

            <div class="line"></div>

            <div class="forms">
                <form action="" method="post" id="form">

                    <div class="form">
                        <label for="firsname">Nom</label>
                        <input type="text" name="firstname" id="firstname"
                        value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>" placeholder="Nom">

                        <?php if (!empty($errors['firstname'])): ?>
                            <p class="error"><?= $errors['firstname'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form">
                        <label for="lastname">Prénom</label>
                        <input type="text" name="lastname" id="lastname" value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>" placeholder="Prénom">

                        <?php if (!empty($errors['lastname'])): ?>
                            <p class="error"><?= $errors['lastname'] ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form">
                        <label for="usermail">E-mail</label>
                        <input type="email" name="useremail" id="usermail" value="<?= htmlspecialchars($_POST['usermail'] ?? '') ?>" placeholder="Blabla@gmail">

                        <?php if (!empty($errors['usermail'])): ?>
                            <p class="error"><?= $errors['usermail'] ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form">
                        <label for="postcode">Code postal</label>
                        <input type="text" name="postcode" id="postcode" value="<?= htmlspecialchars($_POST['postcode'] ?? '') ?>" placeholder="EXP 1000">

                        <?php if (!empty($errors['postcode'])): ?>
                            <p class="error"><?= $errors['postcode'] ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form">
                        <label for="phone">Tel.</label>
                        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" placeholder="00000000">

                        <?php if (!empty($errors['phone'])): ?>
                            <p class="error"><?= $errors['phone'] ?></p>
                        <?php endif; ?>
                    </div>
                    
                    
                    
                    <div class="msg">
                        <label for="message">Message</label>
                        <textarea name="message" id="text_comment" ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>

                        <?php if (!empty($errors['message'])): ?>
                            <p class="error"><?= $errors['message'] ?></p>
                        <?php endif; ?>
                    </div>
                    <p class=nbr>0 / 300 Caractères</p>

                    <div class="checked">
                        <input type="checkbox">
                        <p>le stockage de mes données personnelles.</p>
                    </div>
                    
                    <div class="btn">
                        <button class="btnSub" type="submit">Envoyer le message</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </section>
   

    <section class="right">
        <!-- Si pas de message -->
        <h3>Message</h3>

        <!-- Si 1 message -->
        <!-- <h3>Il y a 1 message</h3> -->
        <!-- Si plusieurs messages -->
        <!-- <h3>Il y a X messages</h3> -->
        <div class="line2"></div>
        <!-- Pagination (BONUS) -->

        <!-- Liste des messages -->
        
        <ul>
            <?php foreach ($message as $m): ?>
                <li>
                    <p><strong><?= htmlspecialchars($m['firstname'], $m['lastname']) ?></strong></p>
                    <p><em><?= htmlspecialchars($m['datemessage']) ?></em></p>
                    <p><?= nl2br(htmlspecialchars($m['message'])) ?></p>
                </li>
            <?php endforeach; ?>

            <!-- Autres messages -->
            <li>
                <p><strong>firstname lastname</strong></p>
                <p><em>datemessage</em></p>
                <p>message</p>
            </li>
        </ul>
    </section>
    
</main>
etc ...
<!-- Pagination (BONUS) -->
<?php
// À commenter quand on a fini de tester
echo "<h3>Nos var_dump() pour le débugage</h3>";
echo '<p>$_POST</p>';
var_dump($_POST);
echo '<p>$_GET</p>';
var_dump($_GET);
?>

<script src="js/validation.js"></script>
</body>
</html>

