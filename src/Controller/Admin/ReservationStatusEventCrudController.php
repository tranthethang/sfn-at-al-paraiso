<?php

namespace App\Controller\Admin;

use App\Entity\ReservationStatusEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ReservationStatusEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationStatusEvent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new(ReservationStatusEvent::RESERVATION);
        yield AssociationField::new(ReservationStatusEvent::RESERVATION_STATUS_CATALOG);
        yield TextEditorField::new(ReservationStatusEvent::DESCRIPTION);
    }
}
