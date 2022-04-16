<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $studentID;

    #[ORM\Column(type: 'string', length: 20)]
    private $Fname;

    #[ORM\Column(type: 'string', length: 20)]
    private $Lname;

    #[ORM\Column(type: 'date')]
    private $DOT;

    #[ORM\ManyToOne(targetEntity: Classes::class, inversedBy: 'section1')]
    private $relation;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentID(): ?int
    {
        return $this->studentID;
    }

    public function setStudentID(int $studentID): self
    {
        $this->studentID = $studentID;

        return $this;
    }

    public function getFname(): ?string
    {
        return $this->Fname;
    }

    public function setFname(string $Fname): self
    {
        $this->Fname = $Fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->Lname;
    }

    public function setLname(string $Lname): self
    {
        $this->Lname = $Lname;

        return $this;
    }

    public function getDOT(): ?\DateTimeInterface
    {
        return $this->DOT;
    }

    public function setDOT(\DateTimeInterface $DOT): self
    {
        $this->DOT = $DOT;

        return $this;
    }

    public function getRelation(): ?classes
    {
        return $this->relation;
    }

    public function setRelation(?classes $relation): self
    {
        $this->relation = $relation;

        return $this;
    }
}
