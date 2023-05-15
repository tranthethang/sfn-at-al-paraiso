<?php

namespace App\Controller\Admin;

use App\Entity\Synchronization;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SynchronizationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Synchronization::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
