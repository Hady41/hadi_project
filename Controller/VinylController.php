<?php
namespace App\Controller;

use App\Entity\Classes;
use App\Entity\Students;
use App\Repository\StudentsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig\EntityListenersConfig;
use function Symfony\Component\String\u;
use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Request;



/**
 * @method getEntityManager()
 */
class VinylController extends AbstractController
{
    #[Route('/',name:'app_homepage')]
    public function homepage(): Response
    {
        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'PB & Jams',
        ]);
    }
    #[Route('findAllstudent',name:'findAllstudent', methods: ['GET'])]
    public function findAllstudent(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM students s
            ORDER BY s.$id ASC
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['price' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }


    #[Route('/student/{id}',name :'student')]



    public function showFname(ManagerRegistry $doctrine, int $id): Response
    {
        $student = $doctrine->getRepository(students::class)->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'No student found for id '.$id
            );
        }

        return new Response('Check out student: '.$student->getFname());




    }

    #[Route('/FindAlls', name:'FindAlls')]
    public function FindAlls(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM Students s
            
            ORDER BY s.id ASC";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }








    #[Route('/inserts', name: 'inserts')]

    public function createStudent(ManagerRegistry $doctrine): Response

    {
        $entityManager = $doctrine->getManager();

        $student = new Students();
        $student->setStudentID('1161');
        $student->setFname('Tony');
        $student->setLname('Jack');
        $date = new \DateTime('2004-05-04');
        $student->setDOT( $date);

        $entityManager->persist($student);


        $entityManager->flush();
        //return $this->render('inserts.html.twig');


       return new Response('Saved new student with id '.$student->getId());
    }
        #[Route('/search', name :'search')]


    public function search(Request $request, ManagerRegistry $doctrine)
        {
            $q = $request->query->get('search');
            // Get standard repository
            $entityManager = $doctrine->getManager();

            getRepository(students::class)
                ->findBy(['id' => $q]); // Or use the magic method ->findByEmail($q);

            // Present your results
            return $this->render('student_show.html.twig');
        }


     #[Route('/shows',name:'shows')]

    public function shows(Students $students): Response
     {
         return $this ->render('Students.php');
     }
     #[Route('/removes/{id}',name: 'removes')]

    public function remove(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $student = $entityManager->getRepository(students::class)->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'Student wasn\'t found holding the id :  '.$id
            );
        }


        $entityManager->remove($student);
        $entityManager->flush();

        return new Response('Student was deleted who holds id: '.$id);

    }
    #[Route('/removecourse/{id}',name: 'removecourse')]

    public function removecourse(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $course = $entityManager->getRepository(course::class)->find($id);

        if (!$course) {
            throw $this->createNotFoundException(
                'Course didn\'t found  ! Holding id '.$id
            );
        }


        $entityManager->remove($course);
        $entityManager->flush();

        return new Response('Course was Successfully deleted ! Holding id: '.$id);

    }

   /* #[Route('/findAll',name:'findAll')]


    public function findAll(Students $student)
    {
        $q = $student->query->get('findAll');
        // Get standard repository
         $this->getDoctrine()->getManager()
            ->getRepository(Students::class)
            ->findBy(['$id' => $q])
        ->findByid($q);

        // Present your results
        return $this->render('findAll');

    }*/
    #[Route('/findAll',name: 'findAll' )]
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Entity\Students 
           
            ORDER by id ASC'
        );

        // returns an array of Product objects
        return $query->getResult();
    }

    #[Route('/removeclasses/{id}',name: 'removeclasses')]

    public function removeclasses(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $classes = $entityManager->getRepository(classes::class)->find($id);

        if (!$classes) {
            throw $this->createNotFoundException(
                'Class didn\'t found  ! Holding id '.$id
            );
        }


        $entityManager->remove($classes);
        $entityManager->flush();

        return new Response('Class was Successfully deleted ! Holding id: '.$id);

    }



    #[Route('/show', name:'show')]
    public function showall(ManagerRegistry $doctrine,$id) : Response

    {
        $repository = $doctrine->getRepository(students::class);

        // look for a single student by its primary key (usually "id")
        $student = $repository->find($id);

        // look for a single student by name
        $student = $repository->findOneBy(['name' => 'Keyboard']);
        // or find by name
        $student = $repository->findOneBy([
            'name' => 'Tony',

        ]);

        // look for multiple Product objects matching the name, ordered by price
        $products = $repository->findBy(

            ['name' => 'ASC']
        );

        // look for *all* student objects
        $student = $repository->findAll();


        return new Response('Students ');





    }




    #[Route('/insertclasses', name: 'insertclasses')]

    public function createclass(ManagerRegistry $doctrine): Response

    {
        $entityManager = $doctrine->getManager();

        $class = new  classes ();
        $class->setsection('7a');
        $class->setcode('7a');

        $entityManager->persist($class);


        $entityManager->flush();
        //return $this->render('inserts.html.twig');


        return new Response('Saved new class with id ' . $class->getId());
    }


    #[Route('/insertc', name: 'insertc')]

    public function createcourse(ManagerRegistry $doctrine): Response

    {
        $entityManager = $doctrine->getManager();

        $course = new  course ();
        $course->setCourseID('1002');
        $course->setname('math');
        $course->setdescription('any course');

        $entityManager->persist($course);


        $entityManager->flush();
        //return $this->render('inserts.html.twig');


        return new Response('Saved new course with id ' . $course->getId());
    }

    #[Route('/ds',name:'ds')]
    public function ds () : Response
    {


        return $this->render('vinyl/ds.html.twig');
    }

}