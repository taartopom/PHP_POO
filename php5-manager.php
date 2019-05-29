<?php
    /* opérateur de résolution de portée */
    function loadClass($class) {
        require "Entity/".$class.".php";
    }
    spl_autoload_register("loadClass");

$pdo = new PDO("mysql:host=localhost;dbname=php_formation;charset=UTF8",
    'root', '');
$personnageManager = new PersonnageManager($pdo);
$personnages = $personnageManager->selectAll();

if (isset($_GET['btn_choice'])) {
    $id = filter_input(INPUT_GET, "perso");
    $id2 = filter_input(INPUT_GET, "perso2");
    $persoChoisi = $personnageManager->select($id);
    $persoChoisi2 = $personnageManager->select($id2);

}
?>

<form method="get">
    <select name="perso">
        <?php
            foreach ($personnages as $personnage) {
                echo "<option value='".$personnage->getId()."'>
                            ".$personnage->getNom()."
                        </option>";
            }
        ?>
    </select>

    <select name="perso2">
        <?php
        foreach ($personnages as $personnage) {
            echo "<option value='".$personnage->getId()."'>
                            ".$personnage->getNom()."
                        </option>";
        }
        ?>
    </select>

    <input type="submit" name="btn_choice"/>
</form>

<?php
     if (isset($persoChoisi)) {
?>
         <h1>Personnage choisi 1</h1>
         Nom : <?php echo $persoChoisi->getNom(); ?><br>
         Force : <?php echo $persoChoisi->getForce(); ?><br>
         Experience : <?php echo $persoChoisi->getExperience(); ?><br>
         Santé : <?php echo $persoChoisi->getSante(); ?><br>

         <h1>Personnage choisi 2</h1>
         Nom : <?php echo $persoChoisi2->getNom(); ?><br>
         Force : <?php echo $persoChoisi2->getForce(); ?><br>
         Experience : <?php echo $persoChoisi2->getExperience(); ?><br>
         Santé : <?php echo $persoChoisi2->getSante(); ?><br>
<?php
    }
 ?>


