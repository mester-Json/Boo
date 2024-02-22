<?php

namespace App\Entity;

use App\Repository\EditorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditorRepository::class)]
class Editor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\OneToMany(targetEntity: book::class, mappedBy: 'editor', orphanRemoval: true)]
    private Collection $editor_id;

    public function __construct()
    {
        $this->editor_id = new ArrayCollection();
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection<int, book>
     */
    public function getEditorId(): Collection
    {
        return $this->editor_id;
    }

    public function addEditorId(book $editorId): static
    {
        if (!$this->editor_id->contains($editorId)) {
            $this->editor_id->add($editorId);
            $editorId->setEditor($this);
        }

        return $this;
    }

    public function removeEditorId(book $editorId): static
    {
        if ($this->editor_id->removeElement($editorId)) {
            // set the owning side to null (unless already changed)
            if ($editorId->getEditor() === $this) {
                $editorId->setEditor(null);
            }
        }

        return $this;
    }
}
