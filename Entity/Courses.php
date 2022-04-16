<?php

namespace App\Entity;

use App\Repository\CoursesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursesRepository::class)]
class Courses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $courseid;

    #[ORM\Column(type: 'text')]
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseid(): ?int
    {
        return $this->courseid;
    }

    public function setCourseid(int $courseid): self
    {
        $this->courseid = $courseid;

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
}
