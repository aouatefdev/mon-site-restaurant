<?php

namespace App\Controller\Admin;

use App\Entity\Plats;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class PlatsCrudController extends AbstractCrudController
{  

    public static function getEntityFqcn(): string
    {
        return Plats::class;
    }

 
    public function configureFields(string $pageName): iterable
    {   
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
            TextEditorField::new('description'),
            ImageField::new('image')
            ->setBasePath('assets/photos/')
            ->setUploadDir('public/assets/photos/'),
            MoneyField::new('prix')->setCurrency("EUR"),
        ];
    }
    
}
