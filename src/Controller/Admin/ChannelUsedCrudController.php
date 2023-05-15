<?php

namespace App\Controller\Admin;

use App\Entity\ChannelUsed;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChannelUsedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ChannelUsed::class;
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
