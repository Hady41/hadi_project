<?php
namespace App\Controller;


use App\Entity\Students;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StudentsController extends AbstractController
{

    #[Route('/students', name: 'create_student')]

    public function createStudent(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $student = new Students();
        $student->setStudentID('');
        $student->setFname('');
        $student->setLname('');
        $student->setDOT( '');




// tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($student);

// actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new student with id '.$student->getId());
    }










}
