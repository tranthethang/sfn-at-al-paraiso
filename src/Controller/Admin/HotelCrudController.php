<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Owp\Sfn\Controller\Admin\AbstractCrudController;

class HotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new(Hotel::CATEGORY);
        yield TextField::new(Hotel::HOTEL_NAME);
        yield TextEditorField::new(Hotel::DESCRIPTION);
        yield BooleanField::new(Hotel::IS_ACTIVE);
    }
}
