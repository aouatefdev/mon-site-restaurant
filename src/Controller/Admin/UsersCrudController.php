<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Controller\Admin\CommandesCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersCrudController extends AbstractCrudController
{   

    public static function getEntityFqcn(): string
    {
        return Users::class;
    }
    
    public function configueCrud(Crud  $crud): Crud
    {
        return $crud
            ->setPageTitle('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')    
        ;

    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            TextField::new('firstname'),

            TextField::new('lastname'),

            EmailField::new('email'),
            
            ArrayField::new('roles'),
             
            TextField::new('password')
            ->setFormType(PasswordType::class),
        
            TextField::new('repeatPassword')->hideOnIndex()
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->setFormType(PasswordType::class)
            ->setFormTypeOptions(['mapped' => false]),

            AssociationField::new('commandes')->hideOnForm(), /*il faut ajouter public function __toString(): string
            {return $this->name;} dans l'entity Commandes*/

            BooleanField::new('isVerified')->renderAsSwitch(false),
                
             
        ];
    }   
}
