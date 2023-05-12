<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = parent::configureFields($pageName);

        /** @var Field $field */
        foreach ($fields as $field) {
            if (in_array($field->getAsDto()->getProperty(), ['createdAt', 'updatedAt'])) {
                $field->hideOnForm()->hideOnIndex();
            }
        }

        return $fields;
    }
}
