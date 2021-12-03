<?php

require_once "Model.class.php";
require_once "Livre.class.php";

class LivreManager extends Model
{
    private $livres; // TABLEAU DE LIVRE


    public function ajoutLivre($livre)
    {
        $this->livres[] = $livre;
    }


    public function getLivres()
    {
        return $this->livres;
    }


    public function chargementLivres()
    {
        $req = $this->getBdd()->prepare("SELECT*FROM livres");
        $req->execute();
        $meslivres = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($meslivres as $livre) {
            $liste = new Livre($livre['id'], $livre['title'], $livre['authors'], $livre['numbersOfPages'], $livre['price'], $livre['image']);
            $this->ajoutLivre($liste);
        }
    }

    public function getLivreById($id)
    {
        for ($i = 0; $i < count($this->livres); $i++) {
            if ($this->livres[$i]->getId() === $id) {
                return $this->livres[$i];
            }
        }
    }

    public function ajoutLivreBd($title, $authors, $numbersOfPages, $price, $image)
    {
        $req = "INSERT INTO livres (title,authors,numbersOfPages,price,image)
                values (:title, :author, :numbersOfPages, :price, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":author", $authors, PDO::PARAM_STR);
        $stmt->bindValue(":numbersOfPages", $numbersOfPages, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $livre = new Livre($this->getBdd()->lastInsertId(), $title, $authors, $numbersOfPages, $price, $image);
            $this->ajoutLivre($livre);
        }
    }

    public function  suppressionLivreBD($id)
    {

        $req = " Delete from livres where id = :idLivre ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idLivre", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if ($resultat > 0) {
            $livre = $this->getLivreById($id);
            unset($livre);
        }
    }

    public function modificationLivreBD($id,$title,$authors,$numbersOfPages,$price,$image)
    {
        $req = 'update livres 
    set title = :title, author = :author, numbersOfPages = :numbersOfPages, price = :price, image = :image 
    where id = :id';

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":author", $authors, PDO::PARAM_STR);
        $stmt->bindValue(":numbersOfPages", $numbersOfPages, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0) {
            $this->getLivreById($id)->setTitle($title);
            $this->getLivreById($id)->setAuthors($authors);
            $this->getLivreById($id)->setNumbersOfPages($numbersOfPages);
            $this->getLivreById($id)->setPrice($price);
            $this->getLivreById($id)->setImage($image);
           
        }
    }
}
