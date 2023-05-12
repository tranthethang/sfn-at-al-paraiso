<?php

namespace Owp\Sfn\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController as EasyCorpAbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

abstract class AbstractCrudController extends EasyCorpAbstractCrudController
{
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