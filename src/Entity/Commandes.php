<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Users $user = null;
    
    #[ORM\Column]
    private ?float $prix_total = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;


    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Users $users = null;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: Plats::class)]
    private Collection $Plats;



    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->Plats = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prix_total;
    }

    public function setPrixTotal(float $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }


    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
    
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Plats>
     */
    public function getNbrPlats(): Collection
    {
        return $this->nbr_Plats;
    }

    public function addNbrArticle(Plats $nbrArticle): self
    {
        if (!$this->nbr_Plats->contains($nbrArticle)) {
            $this->nbr_Plats->add($nbrArticle);
        }

        return $this;
    }

    public function removeNbrArticle(Plats $nbrArticle): self
    {
        $this->nbr_Plats->removeElement($nbrArticle);

        return $this;
    }

    /**
     * @return Collection<int, Dessert>
     */
    public function getDesserts(): Collection
    {
        return $this->Desserts;
    }

    public function addDessert(Dessert $Dessert): self
    {
        if (!$this->Desserts->contains($Dessert)) {
            $this->Desserts->add($Dessert);
            $Dessert->setCommandes($this);
        }

        return $this;
    }

    public function removeDessert(Dessert $Dessert): self
    {
        if ($this->Desserts->removeElement($Dessert)) {
            // set the owning side to null (unless already changed)
            if ($Dessert->getCommandes() === $this) {
                $Dessert->setCommandes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Entree>
     */
    public function getEntrees(): Collection
    {
        return $this->Entrees;
    }

    public function addEntree(Entree $Entree): self
    {
        if (!$this->Entrees->contains($Entree)) {
            $this->Entrees->add($Entree);
            $Entree->setCommandes($this);
        }

        return $this;
    }

    public function removeEntree(Entree $Entree): self
    {
        if ($this->Entrees->removeElement($Entree)) {
            // set the owning side to null (unless already changed)
            if ($Entree->getCommandes() === $this) {
                $Entree->setCommandes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Plats>
     */
    public function getPlats(): Collection
    {
        return $this->Plats;
    }

    public function addArticle(Plats $article): self
    {
        if (!$this->Plats->contains($article)) {
            $this->Plats->add($article);
            $article->setCommandes($this);
        }

        return $this;
    }

    public function removeArticle(Plats $article): self
    {
        if ($this->Plats->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCommandes() === $this) {
                $article->setCommandes(null);
            }
        }

        return $this;
    }

}
