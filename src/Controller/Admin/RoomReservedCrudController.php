<?php

namespace App\Controller\Admin;

use App\Entity\RoomReserved;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RoomReservedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomReserved::class;
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
