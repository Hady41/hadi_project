<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GradeRepository::class)]
class Grade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: course::class, inversedBy: 'CourseID')]
    private $grade;

    public function __construct()
    {
        $this->grade = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, course>
     */
    public function getGrade(): Collection
    {
        return $this->grade;
    }

    public function addGrade(course $grade): self
    {
        if (!$this->grade->contains($grade)) {
            $this->grade[] = $grade;
        }

        return $this;
    }

    public function removeGrade(course $grade): self
    {
        $this->grade->removeElement($grade);

        return $this;
    }
}
