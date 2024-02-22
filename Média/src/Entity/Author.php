<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: book::class, mappedBy: 'autor', orphanRemoval: true)]
    private Collection $autor_id;

    public function __construct()
    {
        $this->autor_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, book>
     */
    public function getAutorId(): Collection
    {
        return $this->autor_id;
    }

    public function addAutorId(book $autorId): static
    {
        if (!$this->autor_id->contains($autorId)) {
            $this->autor_id->add($autorId);
            $autorId->setAutor($this);
        }

        return $this;
    }

    public function removeAutorId(book $autorId): static
    {
        if ($this->autor_id->removeElement($autorId)) {
            // set the owning side to null (unless already changed)
            if ($autorId->getAutor() === $this) {
                $autorId->setAutor(null);
            }
        }

        return $this;
    }
}
