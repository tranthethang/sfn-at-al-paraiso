<?php

namespace App\Controller\Admin;

use App\Entity\ReservationStatusCatalog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationStatusCatalogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationStatusCatalog::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new(ReservationStatusCatalog::STATUS_NAME);
    }
}
