<?php

namespace App\Controller\Admin;

use App\Entity\Students;
use App\Repository\StudentsRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class StudentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Students::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('Fname'),
            TextField::new('Lname'),
        ];
    }

}
