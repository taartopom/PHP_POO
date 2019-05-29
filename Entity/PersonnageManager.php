<?php
    class PersonnageManager {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function insert($personnage) {
            $statement = $this->db->prepare("INSERT INTO 
              personnage (created_at, nom, _force, experience, sante)
              VALUES (:createdAt, :nom, :force, :experience, :sante)");

            $result = $statement->execute([
                ":createdAt" => date('Y-m-d H:i:s'),
                ":nom" => $personnage->getNom(),
                ":force" => $personnage->getForce(),
                ":experience" => $personnage->getExperience(),
                ":sante" => $personnage->getSante()
            ]);

            return $result;
        }

        public function select($id) {
            $statement = $this->db->prepare("SELECT * FROM personnage WHERE id=:idUser");
            $statement->execute([
                ":idUser" => $id
            ]);
            $persoArray = $statement->fetch(PDO::FETCH_ASSOC);

            $personnage = new Personnage($persoArray['nom'],
                $persoArray['_force'],
                $persoArray['experience'],
                $persoArray['sante'],
                $persoArray['id'],
                $persoArray['created_at']
            );

            return $personnage;
        }

        public function selectAll() {
            // on récupère tous les enregistrements en bdd dans la table personnage
            $statement = $this->db->prepare("SELECT * FROM personnage");
            $statement->execute();
            $persosArray = $statement->fetchAll(PDO::FETCH_ASSOC);

            $personnages = [];
            // pour chaque enregistrement en bdd, on instancie un personnage
            foreach ($persosArray as $persoArray) {
                $personnage = new Personnage($persoArray['nom'],
                    $persoArray['_force'],
                    $persoArray['experience'],
                    $persoArray['sante'],
                    $persoArray['id'],
                    $persoArray['created_at']
                );
                // on met ce personnage dans le tableau de personnages
                $personnages[] = $personnage;
            }

            return $personnages;
        }
    }

?>