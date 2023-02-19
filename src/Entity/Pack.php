<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 13)]
    #[ORM\JoinColumn(nullable: false)]
    private ?string $EAN = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'pack', targetEntity: PackArticles::class)]
    private Collection $packArticles;

    public function __construct()
    {
        $this->packArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEAN(): ?string
    {
        return $this->EAN;
    }

    public function setEAN(string $EAN): self
    {
        $this->EAN = $EAN;

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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('EAN', new Assert\Length([
            'min' => 13,
            'max' => 13,
            'minMessage' => 'Your "EAN" must be at least 13 characters long',
            'maxMessage' => 'Your "EAN" must be at least 13 characters long',
        ]));
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, PackArticles>
     */
    public function getPackArticles(): Collection
    {
        return $this->packArticles;
    }

    public function addPackArticle(PackArticles $packArticle): self
    {
        if (!$this->packArticles->contains($packArticle)) {
            $this->packArticles->add($packArticle);
            $packArticle->setPack($this);
        }

        return $this;
    }

    public function removePackArticle(PackArticles $packArticle): self
    {
        if ($this->packArticles->removeElement($packArticle)) {
            // set the owning side to null (unless already changed)
            if ($packArticle->getPack() === $this) {
                $packArticle->setPack(null);
            }
        }

        return $this;
    }
}
