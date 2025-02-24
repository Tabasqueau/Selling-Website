<?php
require_once("conf/Connexion.php");
Connexion::connect();
class Recette
{
    private $numRecette;
    private $nomRecette;
    private $difficulteRecette;
    private $descriptionRecette;
    private $numUtilisateur;

    public function getnumRecette()
    {
        return $this->numRecette;
    }
    public function getnomRecette()
    {
        return $this->nomRecette;
    }
    public function getdifficulteRecette()
    {
        return $this->difficulteRecette;
    }
    public function getdescriptionRecette()
    {
        return $this->descriptionRecette;
    }
    public function getnumUtilisateur()
    {
        return $this->numUtilisateur;
    }

    public function __construct($numR = NULL, $nomR = NULL, $difR = NULL, $desR = NULL, $numU = NULL)
    {
        if (!is_null($numR)) {
            $this->numRecette = $numU;
            $this->nomRecette = $nomR;
            $this->difficulteRecette = $difR;
            $this->descriptionRecette = $desR;
            $this->numUtilisateur = $numU;
        }
    }
    public static function getAllRecettes()
    {
        $requete = "SELECT * FROM Recette ORDER BY NumRecette;";
        $reponse = Connexion::pdo()->query($requete);
        //$reponse->setFetchMode(PDO::FETCH_CLASS,'Recette');
        $tab = $reponse->fetchAll();
        return $tab;
    }
    public static function getNumRecettebyNomRecette($nomRecette)
    {
        $requetePreparee = "SELECT numRecette FROM Recette where nomRecette = :tag_nomRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_nomRecette" => $nomRecette);
        try {
            $req_prep->execute($valeurs);
            //$req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function getNomRecettebyNumRecette($numRecette)
    {
        $requetePreparee = "SELECT nomRecette FROM Recette where numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            //$req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function getDifficultebyNumRecette($numRecette)
    {
        $requetePreparee = "SELECT difficulteRecette FROM Recette where numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            //$req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function getInstructionbyNumRecette($numRecette)
    {
        $requetePreparee = "SELECT descriptionRecette FROM Recette where numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            //$req_prep->setFetchMode(PDO::FETCH_CLASS,'Recette');
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function getRecettesbyNumRecette($numRecette)
    {
        $requetePreparee = "SELECT * FROM Recette where numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $t = $req_prep->fetch();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function getAllRecettesbyNumUtilisateur($numUtilisateur)
    {
        $requetePreparee = "SELECT * FROM Recette where numUtilisateur = :tag_numUtilisateur;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numUtilisateur" => $numUtilisateur);
        try {
            $req_prep->execute($valeurs);
            $tab = $req_prep->fetchall();
            if (!$tab)
                return false;
            return $tab;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }


    public static function addRecette($nomRecette, $difficulteRecette, $descriptionRecette, $numUtilisateur, $imageRecette)
    {
        $requetePreparee = "INSERT INTO Recette (nomRecette,difficulteRecette,descriptionRecette,numUtilisateur,imageRecette) VALUES(:tag_nomRecette,:tag_difficulteRecette,:tag_descriptionRecette,:tag_numUtilisateur, :tag_imageRecette);";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_nomRecette" => $nomRecette,
            "tag_difficulteRecette" => $difficulteRecette,
            "tag_descriptionRecette" => $descriptionRecette,
            "tag_numUtilisateur" => $numUtilisateur,
            "tag_imageRecette" => $imageRecette
        );
        try {
            $req_prep->execute($valeurs);
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
    }

    public static function addRecetteCompose($numRecette, $numIngredient, $quantite)
    {
        $requetePreparee = "INSERT INTO compose VALUES(:tag_numRecette,:tag_numIngredient,:tag_quantite);";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_numRecette" => $numRecette,
            "tag_numIngredient" => $numIngredient,
            "tag_quantite" => $quantite
        );
        try {
            $req_prep->execute($valeurs);
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
    }

    public static function addRecetteAppartient($numCategorie, $numRecette)
    {
        $requetePreparee = "INSERT INTO appartient VALUES (:tag_numCategorie,:tag_numRecette);";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_numCategorie" => $numCategorie,
            "tag_numRecette" => $numRecette
        );
        try {
            $req_prep->execute($valeurs);
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
    }

    public static function addRecetteUstensile($numRecette, $numUstensile)
    {
        $requetePreparee = "INSERT INTO utilise VALUES (:tag_numRecette, :tag_numUstensile);";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array(
            "tag_numRecette" => $numRecette,
            "tag_numUstensile" => $numUstensile
        );
        try {
            $req_prep->execute($valeurs);
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
    }

    public static function deleteRecette($numRecette)
    {
        $requetePreparee = "DELETE FROM Recette WHERE numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            return true;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    /*
     * méthode qui permet de rechercher une recette en ayant soit son nom, soit un mot qui correspond a quelque chose dans la description
     */
    public static function rechercherRecette($nomRecette)
    {
        $requetePreparee = "SELECT * FROM Recette where nomRecette LIKE '%' :tag_nomRecette '%';";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_nomRecette" => $nomRecette);
        try {
            $req_prep->execute($valeurs);
            $tab = $req_prep->fetchAll();
            if (!$tab)
                return false;
            return $tab;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }



    /*
     * A definir ou mettre ces methodes
     */


    public static function rechercherUstensile($numRecette)
    {
        $requetePreparee = "SELECT numUstensile FROM utilise where numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $t = $req_prep->fetchAll();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }

    public static function getQuantiteIngredients($numRecette)
    {
        $requetePreparee = "SELECT quantite FROM compose where numRecette = :tag_numRecette;";
        $req_prep = Connexion::pdo()->prepare($requetePreparee);
        $valeurs = array("tag_numRecette" => $numRecette);
        try {
            $req_prep->execute($valeurs);
            $t = $req_prep->fetchAll();
            if (!$t)
                return false;
            return $t;
        } catch (PDOException $e) {
            echo "erreur : " . $e->getMessage() . "<br>";
        }
        return false;
    }
}
