<?php

const JOURS = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

function getMenusByCookies()
{
    $menus = [];
    $meals = $_COOKIE;
    for ($i = 0; $i < 14; $i++) {
        $menus[$i] = '';
    }
    foreach ($meals as $key => $meal) {
        $menus[$key] = $meal;
    }
    return $menus;
}

function setMenusWithCookies(int $meal, string $value)
{
    setcookie((string)$meal, $value, [
        'expires' => strtotime("+1 year"),
        'httponly' => true
    ]);
}

for ($i = 0; $i < 14; $i++) {
    if ((isset($_POST[(string)$i]))) {
        setMenusWithCookies($i, $_POST[(string)$i]);
        header('Location: index.php');
    }
}
$menus = getMenusByCookies();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style_meals.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/meal.png" type="image/x-icon">
    <title>Menus</title>
</head>
<body>
<div class="title">
    <h1>Menus de la semaine</h1>
</div>

<form action="" method="post">
    <button type="submit" class="save" id="saveAll" hidden><span>Tout enregistrer</span></button>

    <div class="icons">
        <a href="index.php"><img src="images/homemenu.png" alt="Fold" id="home"></a>
        <img src="images/check.png" alt="check" class="img-save" id="save">
        <img src="images/delete.png" alt="Delete" id="delAll">
        <img src="images/help.png" alt="Help" id="showHelp">
    </div>

    <div class="help" id="help">
        <div class="help-title">
            <h2>Aide</h2>
            <p>Les menus sont uniquement enregistrés sur votre appareil.</p>
        </div>

        <div class="help-use">
            <p><strong><u>Utilisation</u></strong></p>
            <div class="help-icons">
                <div class="help-icons-container">
                    <div><img src="images/homemenu.png" alt="Fold">
                        ou <span class="shortkey">CTRL+R</span> : Recharger la page
                    </div>
                    <div><img src="images/check.png" alt="check">
                        ou <span class="shortkey">CTRL+S</span> : Tout sauvegarder
                    </div>
                    <div><img src="images/delete.png" alt="Delete">
                        ou <span class="shortkey">CTRL+D</span> : Tout supprimer
                    </div>
                </div>
            </div>
            <div class="help-click">
                <div><strong>Simple Click/Tap</strong> : Modifier un menu</div>
                <div><strong>Double Click/Tap</strong> : Supprimer un menu</div>
            </div>
        </div>

        <div class="help-legend">
            <p><strong><u>Légende</u></strong></p>
            <div class="help-today">
                <img src="images/right.png" alt="star" id="star">
                Aujourd'hui
                <img src="images/left.png" alt="star" id="star">
            </div>
            <div class="colors">
                <div class="color-green">Menu sauvé</div>
                <div class="color-orange">Menu non sauvé</div>
                <div class="color-red">Menu vide</div>
            </div>
        </div>
    </div>
    <?php
    for ($i = 0;
         $i < 7;
         $i++) { ?>
        <div class="day">
            <div class="day-form">
                <?= "
                <textarea name=\"" . ($i * 2) . '" class="text-area">' . $menus[$i * 2] . "</textarea>
                <textarea name=\"" . ($i * 2 + 1) . '" class="text-area">' . $menus[$i * 2 + 1] . "</textarea>"; ?>
                <div class="day-name">
                    <div>
                        <img src="images/right.png" alt="today" class="img-today">
                        <div><?= ucfirst(JOURS[$i]) ?></div>
                        <img src="images/left.png" alt="today" class="img-today">
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</form>

<script src="script/meals.js"></script>
</body>
</html>
