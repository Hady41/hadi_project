<?php


namespace App\Controller;


use App\Controller\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Students;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ControllerS extends AbstractController
{


    #[Route("/show_student", name: 'show_student')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $student = $doctrine->getRepository(students::class)->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'No student found for id '.$id
            );
        }

        return new Response('Check out our students : '.$student->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}