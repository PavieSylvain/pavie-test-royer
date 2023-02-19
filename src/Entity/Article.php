<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 13)]
    #[ORM\JoinColumn(nullable: false)]
    private ?string $EAN = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(referencedColumnName: 'code', nullable: false)]
    private ?Modele $modele = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(referencedColumnName: 'code' ,nullable: false)]
    private ?Coloris $coloris = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Taille $taille = null;


    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: PackArticles::class)]
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

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getColoris(): ?Coloris
    {
        return $this->coloris;
    }

    public function setColoris(?Coloris $coloris): self
    {
        $this->coloris = $coloris;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

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
            $packArticle->setArticle($this);
        }

        return $this;
    }

    public function removePackArticle(PackArticles $packArticle): self
    {
        if ($this->packArticles->removeElement($packArticle)) {
            // set the owning side to null (unless already changed)
            if ($packArticle->getArticle() === $this) {
                $packArticle->setArticle(null);
            }
        }

        return $this;
    }
}
