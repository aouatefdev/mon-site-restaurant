<?php

namespace App\Entity;

use App\Repository\StockagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockagesRepository::class)]
class Stockages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'Stockages', targetEntity: Plats::class)]
    private Collection $id_Plats;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Plats $article = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    public function __construct()
    {
        $this->id_Plats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Plats>
     */
    public function getIdPlats(): Collection
    {
        return $this->id_Plats;
    }

    public function addIdArticle(Plats $idArticle): self
    {
        if (!$this->id_Plats->contains($idArticle)) {
            $this->id_Plats->add($idArticle);
            $idArticle->setStockages($this);
        }

        return $this;
    }

    public function removeIdArticle(Plats $idArticle): self
    {
        if ($this->id_Plats->removeElement($idArticle)) {
            // set the owning side to null (unless already changed)
            if ($idArticle->getStockages() === $this) {
                $idArticle->setStockages(null);
            }
        }

        return $this;
    }

    public function getArticle(): ?Plats
    {
        return $this->article;
    }

    public function setArticle(?Plats $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
