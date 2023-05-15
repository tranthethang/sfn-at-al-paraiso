<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Room::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new(Room::ROOM_NAME);
        yield TextEditorField::new(Room::DESCRIPTION);
        yield NumberField::new(Room::CURRENT_PRICE);
        yield AssociationField::new(Room::HOTEL);
        yield AssociationField::new(Room::ROOM_TYPE);
    }
}
