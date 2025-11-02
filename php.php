<?php
$nom = $email = $tel = $motif = $datetime = $firstTime = $message = "";
$nomErr = $emailErr = $telErr = $firstTimeErr = $messageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nom"])) {
        $nomErr = "Le nom est obligatoire";
    } else {
        $nom = htmlspecialchars($_POST["nom"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "L'adresse email est obligatoire";
    } else {
        $email = htmlspecialchars($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email invalide";
        }
    }

    if (!empty($_POST["tel"])) {
        $tel = htmlspecialchars($_POST["tel"]);
        if (!preg_match("/^\+?[0-9\s\-]{7,15}$/", $tel)) {
            $telErr = "Numéro de téléphone invalide";
        }
    }

    if (!empty($_POST["motif"])) {
        $motif = htmlspecialchars($_POST["motif"]);
    }

    if (!empty($_POST["datetime"])) {
        $datetime = $_POST["datetime"];
    }

    if (empty($_POST["firstTime"])) {
        $firstTimeErr = "Veuillez préciser si c'est votre première demande";
    } else {
        $firstTime = htmlspecialchars($_POST["firstTime"]);
    }

    if (empty($_POST["message"])) {
        $messageErr = "Le message est obligatoire";
    } else {
        $message = htmlspecialchars($_POST["message"]);
    }

    $formValid = !$nomErr && !$emailErr && !$telErr && !$firstTimeErr && !$messageErr;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="css/css.css">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 500px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input, select, textarea, button { width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; }
        .error { color: red; font-size: 0.9em; }
        .result { background: #e0ffe0; padding: 15px; border-radius: 5px; margin-top: 20px; }
        .boton { margin-top: 10px; }
    </style>
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="page_1.html">Accueil</a></li>
            <li><a href="Ma_page2.html">A propos de moi</a></li>
            <li><a href="Ma_page3.html">Mes activités</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $formValid): ?>
    <div class="result">
        <h2>Demande reçue</h2>
        <p>Nom : <?php echo $nom; ?></p>
        <p>Email : <?php echo $email; ?></p>
        <p>Téléphone : <?php echo $tel; ?></p>
        <p>Motif : <?php echo $motif; ?></p>
        <p>Créneau : <?php echo $datetime; ?></p>
        <p>Première demande : <?php echo $firstTime; ?></p>
        <p>Message : <?php echo $message; ?></p>
        <p>Merci, votre demande a été prise en compte et sera étudiée.</p>
    </div>
<?php else: ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom">Nom *</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required>
        <span class="error"><?php echo $nomErr; ?></span>

        <label for="email">Email *</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
        <span class="error"><?php echo $emailErr; ?></span>

        <label for="tel">Téléphone</label>
        <input type="tel" id="tel" name="tel" value="<?php echo $tel; ?>">
        <span class="error"><?php echo $telErr; ?></span>

        <label for="motif">Motif</label>
        <select id="motif" name="motif">
            <option value="">-- Sélectionnez --</option>
            <option value="Information" <?php if($motif=="Information") echo "selected"; ?>>Information</option>
            <option value="Assistance" <?php if($motif=="Assistance") echo "selected"; ?>>Assistance</option>
            <option value="Autre" <?php if($motif=="Autre") echo "selected"; ?>>Autre</option>
        </select>

        <label for="datetime">Créneau (jour + horaire)</label>
        <input type="datetime-local" id="datetime" name="datetime" value="<?php echo $datetime; ?>">

        <label>Première demande ? *</label>
        <input type="radio" id="oui" name="firstTime" value="Oui" <?php if($firstTime=="Oui") echo "checked"; ?>> <label for="oui">Oui</label>
        <input type="radio" id="non" name="firstTime" value="Non" <?php if($firstTime=="Non") echo "checked"; ?>> <label for="non">Non</label>
        <span class="error"><?php echo $firstTimeErr; ?></span>

        <label for="message">Message *</label>
        <textarea id="message" name="message" required><?php echo $message; ?></textarea>
        <span class="error"><?php echo $messageErr; ?></span>

        <button type="submit" class="boton">Envoyer</button>
        <button type="reset" class="boton">Réinitialiser</button>
    </form>
<?php endif; ?>

<footer>
    <center><p>Elías – BUT Informatique – <a href="mailto:elias.el_mkademi_el_baoudi@etu.uca.fr">Me contacter</a></p></center>
</footer>
</body>
</html>
