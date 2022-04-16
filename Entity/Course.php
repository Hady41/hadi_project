<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $courseID;

    #[ORM\Column(type: 'string', length: 20)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\ManyToMany(targetEntity: Classes::class, mappedBy: 'name')]
    private $section;

    #[ORM\ManyToMany(targetEntity: Grade::class, mappedBy: 'grade')]
    private $CourseID;

    public function __construct()
    {
        $this->section = new ArrayCollection();
        $this->CourseID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseID(): ?int
    {
        return $this->courseID;
    }

    public function setCourseID(int $courseID): self
    {
        $this->courseID = $courseID;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(Classes $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
            $section->addName($this);
        }

        return $this;
    }

    public function removeSection(Classes $section): self
    {
        if ($this->section->removeElement($section)) {
            $section->removeName($this);
        }

        return $this;
    }

    public function addCourseID(Grade $courseID): self
    {
        if (!$this->CourseID->contains($courseID)) {
            $this->CourseID[] = $courseID;
            $courseID->addGrade($this);
        }

        return $this;
    }

    public function removeCourseID(Grade $courseID): self
    {
        if ($this->CourseID->removeElement($courseID)) {
            $courseID->removeGrade($this);
        }

        return $this;
    }
}
