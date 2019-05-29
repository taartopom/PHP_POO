<?php
    class Personnage {
        private $id;
        private $createdAt;
        protected $nom;
        private $sante;
        private $force;
        private $experience;
        const POINTS_SOIN = 13;

        public static $nbCoupsRestants = 150;

        // constructeur
        public function __construct($nom, $force, $experience, $sante=100, $id="", $createdAt="")
        {
            //$this->nom = $nom;
            $this->setNom($nom);
            $this->setForce($force);
            $this->setExperience($experience);
            $this->setSante($sante);
            $this->setId($id);
            $this->setCreatedAt($createdAt);
        }

        // getter/setter
        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        /**
         * @param mixed $createdAt
         */
        public function setCreatedAt($createdAt)
        {
            $this->createdAt = $createdAt;
        }

        public function getNom()  {
            return $this->nom;
        }
        public function setNom($nom) {
            $this->nom = $nom;
        }
        public function getSante()  {
            return $this->sante;
        }
        public function setSante($sante) {
            $this->sante = $sante;
        }
        public function getForce()  {
            return $this->force;
        }
        public function setForce($force) {
            $this->force = $force;
        }
        public function getExperience()  {
            return $this->experience;
        }
        public function setExperience($experience) {
            $this->experience = $experience;
        }

        // gagner de l'experience
        public function gagnerExperience() {
            $this->experience = $this->experience + 5;
        }

        // attaquer un autre personnage :  la santé du personnage attaqué
        // doit baisser de la force du premier
        public function attaquer($persoAttaque) {
            // $persoAttaque->sante -= $this->force;
            $nouvelleSante = $persoAttaque->getSante() - $this->force;
            $persoAttaque->setSante($nouvelleSante);

            // gain d'experience après une attaque
            $this->gagnerExperience();

            // on diminue le nombre de coups restants avant fin de partie
            // Personnage::$nbCoupsRestants--;
            self::$nbCoupsRestants--;
        }

        public function soigner($soin) {
            if (rand(0,1) == 1) {
                $this->sante += $soin;
                return true;
            }

            return false;
        }

        public static function canWePlay() {
            $hour = date("G");
            if ($hour < 12 || $hour >= 14) {
                return true;
            }
            else {
                return false;
            }
        }
    }

?>