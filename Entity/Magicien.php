<?php
    class Magicien extends Personnage {
        private $magie;

        /**
         * Magicien constructor.
         * @param $magie
         */
        public function __construct($magie, $nom, $force,
                                    $experience, $sante=100,
                                    $id="", $createdAt="")
        {
            // appeler le constructeur parent, donc de la classe Personnage
            parent::__construct($nom, $force, $experience, $sante, $id, $createdAt);
            // possible car propriété nom est protected dans la classe parent
            //$this->nom = $nom;

            // $this->magie = $magie;
            $this->setMagie($magie);
        }

        public function getMagie()
        {
            return $this->magie;
        }

        public function setMagie($magie)
        {
            $this->magie = $magie;
        }

        public function lancerBouleDeFeu($personnageAttaque) {
            // si assez de magie on peut lancer boule de feu
            if ($this->getMagie() >= 10) {
                // boule de feu double les dégats de l'attaque normale
                $nouvelleSante = $personnageAttaque->getSante() - ($this->getForce() * 2);
                $personnageAttaque->setSante($nouvelleSante);
                // on diminue la magie restante
                $this->setMagie($this->getMagie() - 10);

                $this->gagnerExperience();
                self::$nbCoupsRestants--;
            }
            // si pas assez de magie, on fait une attaque normale
            else {
                $this->attaquer($personnageAttaque);
            }
        }

    }
?>