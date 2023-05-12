<?php

namespace App\Controller\Admin;

use App\Entity\RoomType;
use Owp\Sfn\Controller\Admin\AbstractCrudController;

class RoomTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomType::class;
    }
}
