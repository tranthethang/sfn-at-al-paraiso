<?php

namespace App\Controller\Admin;

use App\Entity\RoomType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Owp\Sfn\Controller\Admin\AbstractCrudController;

class RoomTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new(RoomType::TYPE_NAME);
    }
}
