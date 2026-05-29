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
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="">
<header>
    <div class="logo">
        <img src="./img/creation-de-logo.png" alt="logo">
    </div>
    <div class="title">
        <h1>Livre d'or</h1>
        <p>Laissez une trace de votre passage !</p>
    </div>
    <div class="admin">
        <button class="dark-mode" id="dark-mode"></button>
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
            <p class="sended"><b>Votre Mesagge c'est envoyer &#128077 </b></p>

            <div class="line"></div>

            <div class="forms">
                <form action="" method="post" id="form">

                    <div class="form">
                        <label for="lastname">Nom </label>

                        <div class="error-container">
                            <input type="text" name="lastname" id="lastname" value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>" placeholder="Nom" required>
                            <span class="errors">Nom invalide</span>
                        </div>
                        
                    </div>
                    

                    <div class="form">
                        <label for="firstname">Prénom </label>

                        <div class="error-container">
                            <input type="text" name="firstname" id="firstname" value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>" placeholder="Prénom" required>
                            <span class="errors">Prénom invalide</span>
                        </div>

                        
                    </div>
                    

                    <div class="form">
                        <label for="usermail">E-mail </label>

                        <div class="error-container">
                            <input type="email" name="usermail" id="usermail" value="<?= htmlspecialchars($_POST['usermail'] ?? '') ?>" placeholder="youre_email@gmail.com" required>
                            <span class="errors">E-mail invalide</span>
                        </div>

                        
                    </div>
                    

                    <div class="form">
                        <label for="postcode">Code postal </label>

                        <div class="error-container">
                            <input type="text" name="postcode" id="postcode" value="<?= htmlspecialchars($_POST['postcode'] ?? '') ?>" placeholder="Exp: 1000" required>
                            <span class="errors">Code postal invalide</span>
                        </div>

                        
                    </div>
                    

                    <div class="form">
                        <label for="phone">Tel. </label>

                        <div class="error-container">
                            <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" placeholder="00000000" required>
                            <span class="errors">Tel. invalide</span>
                        </div>

                    </div>
                    
                    
                    
                    <div class="msg">
                        <label for="message">Message </label>

                        <div class="error-container">
                            <textarea name="message" id="message" placeholder="Votre message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            <span class="errors">Message invalide</span>
                        </div>

                        
                    </div>
                    
                    <p class=nbr><span id="count">0</span> / 300 Caractères</p>

                    <div class="checked">
                        <input type="checkbox">
                        <p>le stockage de mes données personnelles.</p>
                    </div>
                    
                    <div class="btn">
                        <button class="btnSub" id="btnSub" type="submit">Envoyer le message</button>
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
                    <p><strong><?= htmlspecialchars($m['firstname'])." " .htmlspecialchars($m['lastname']) ?></strong></p>
                    <p><em><?= htmlspecialchars($m['datemessage']) ?></em></p>
                    <p><?= nl2br(htmlspecialchars($m['message'])) ?></p>
                </li>
            <?php endforeach; ?>

            <!-- Autres messages -->
            <!-- <li>
                <p><strong>firstname lastname</strong></p>
                <p><em>datemessage</em></p>
                <p>message</p>
            </li> -->
        </ul>
    </section>
    
</main>

<!--
<?php 
// À commenter quand on a fini de tester
// echo "<h3>Nos var_dump() pour le débugage</h3>";
// echo '<p>$_POST</p>';
// var_dump($_POST);
// echo '<p>$_GET</p>';
// var_dump($_GET);
?>-->

<script src="js/validation.js"></script>
<!-- <script src="js/jquery-3.7.1.min.js"></script> -->
</body>
</html>

