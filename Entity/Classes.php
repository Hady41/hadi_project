<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 2)]
    private $section;

    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: 'section')]
    private $name;

    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: Students::class)]
    private $section1;

    #[ORM\Column(type: 'string', length: 2)]
    private $code;

    public function __construct()
    {
        $this->name = new ArrayCollection();
        $this->section1 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return Collection<int, course>
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(course $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
        }

        return $this;
    }

    public function removeName(course $name): self
    {
        $this->name->removeElement($name);

        return $this;
    }

    /**
     * @return Collection<int, Students>
     */
    public function getSection1(): Collection
    {
        return $this->section1;
    }

    public function addSection1(Students $section1): self
    {
        if (!$this->section1->contains($section1)) {
            $this->section1[] = $section1;
            $section1->setRelation($this);
        }

        return $this;
    }

    public function removeSection1(Students $section1): self
    {
        if ($this->section1->removeElement($section1)) {
            // set the owning side to null (unless already changed)
            if ($section1->getRelation() === $this) {
                $section1->setRelation(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
