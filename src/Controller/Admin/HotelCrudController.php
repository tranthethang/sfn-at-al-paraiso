<?php

namespace App\Controller\Admin;

use App\Entity\Hotel;
use Owp\Sfn\Controller\Admin\AbstractCrudController;

class HotelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hotel::class;
    }
}
