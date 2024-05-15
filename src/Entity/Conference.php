<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ConferenceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: ConferenceRepository::class)]

#[UniqueEntity('slug')]
 class Conference implements \Stringable


{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
  
    private ?int $id = null;

    #[ORM\Column(length: 255 , unique:true)]
    private ?string $city = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\Column]
    private ?bool $isInternational = null;

    public function __toString(): string
    {
        return (string) $this->city.' '.$this->year;
    }

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'conference', orphanRemoval: true)]
    private Collection $comments;

    #[ORM\Column(length: 255)]
    private ?string $Slug = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function isInternational(): ?bool
    {
        return $this->isInternational;
    }

    public function setIsInternational(bool $isInternational): static
    {
        $this->isInternational = $isInternational;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setConference($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getConference() === $this) {
                $comment->setConference(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): static
    {
        $this->Slug = $Slug;

        return $this;
    }

    public function computeSlug(SluggerInterface $slugger)
        {
            if (!$this->Slug || '-' === $this->Slug) {
                $this->Slug = (string) $slugger->slug((string) $this)->lower();
            }
        }
   
}

