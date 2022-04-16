<?php

namespace App\Controller\Admin;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Course;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CourseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Course::class;
    }

   /* public function configureCrud(Crud $crud): Crud
    {
       return $crud

            ->setSearchFields(['id', 'name'])
           // ->setDefaultSort(['createdAt' => 'DESC'])
        ;
    }*/
   /* public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('name'))
        ;
   }*/


  /* public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
           ->setEntityLabelInPlural('Course')
            ->setSearchFields(['id', 'name'])

        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
            return $filters
                    ->add(EntityFilter::new('course'))
            ;
   }

     public function configureFields(string $pageName): iterable
{
            return [
                IdField::new('id'),
                TextField::new('name'),
                TextField::new('description'),
            ];



     }
}
