<?php
    function loadClass($class) {
        require "Entity/".$class.".php";
    }
    spl_autoload_register("loadClass");

    $personnage = new Personnage("Perso1", 10, 0);
    $magicien = new Magicien(30, "Magicien1", 10, 0);
    $magicienneBlanche = new MagicienneBlanche(100, "Magicienne blanche1", 15, 0);

    echo "<pre>";
    var_dump($personnage);
    var_dump($magicien);
    var_dump($magicienneBlanche);
    echo "</pre>";

    $combatantes = [$personnage, $magicien, $magicienneBlanche];

do {
    // à chaque tour, chaque perso à la possibilité d'attaquer
    foreach ($combatantes as $combatante) {
        if ($combatante->getSante() > 0) {
            $i = rand(0,2);
            $persoAttaque = $combatantes[$i];

            // suivant la classe, on peut lancer différentes attaques
            if ($combatante instanceof MagicienneBlanche) {
                $choixAttaque = rand(1,3);
                switch ($choixAttaque) {
                    case 1:
                        $combatante->attaquer($persoAttaque);
                        break;
                    case 2:
                        $combatante->lancerBouleDeFeu($persoAttaque);
                        break;
                    case 3:
                        $combatante->soinTotal();
                        break;
                }
            }
            elseif ($combatante instanceof Magicien) {
                $choixAttaque = rand(1,2);
                switch ($choixAttaque) {
                    case 1:
                        $combatante->attaquer($persoAttaque);
                        break;
                    case 2:
                        $combatante->lancerBouleDeFeu($persoAttaque);
                        break;
                }
            }
            else {
                $combatante->attaquer($persoAttaque);
            }
        }

    }

    // à chaque tour les persos tentent de se soigner
    foreach ($combatantes as $combatante) {
        if ($combatante->getSante() > 0) {
            if ($combatante->soigner(Personnage::POINTS_SOIN)) {
                echo "Soin pour ".$combatante->getNom()."<br>";
            }
        }
    }

    // à chaque tour, on affiche la vie restante
    foreach ($combatantes as $combatante) {
        echo "Vie restante ".$combatante->getNom()." : ".$combatante->getSante()."<br>";
    }

    // vérifier si au moins deux des combatantes sont encore en vie
    $nbCombatantEnVie = 0;
    foreach ($combatantes as $combatante) {
        if ($combatante->getSante() > 0) {
            $nbCombatantEnVie++;
        }
    }
} while (Personnage::$nbCoupsRestants > 0 && $nbCombatantEnVie >= 2);
?>


