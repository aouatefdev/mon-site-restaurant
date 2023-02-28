<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlatsRepository;
use Doctrine\Common\Collections\Collection;
use Vich\UploaderBundle\Handler\UploadHandler;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity(repositoryClass: PlatsRepository::class)]
class Plats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private $image = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'id_Plats')]
    private ?Stockages $Stockages = null;

    #[ORM\ManyToOne(inversedBy: 'Plats')]
    private ?Commandes $commandes = null;

       
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStockages(): ?Stockages
    {
        return $this->Stockages;
    }

    public function setStockages(?Stockages $Stockages): self
    {
        $this->Stockages = $Stockages;

        return $this;
    }


    public function getCommandes(): ?Commandes
    {
        return $this->commandes;
    }

    public function setCommandes(?Commandes $commandes): self
    {
        $this->commandes = $commandes;

        return $this;
    }

}
