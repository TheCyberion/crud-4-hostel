<?php


namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
 use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
 use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
 use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
 use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
 use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

 class CommandeCrudController extends AbstractCrudController
 {
     public static function getEntityFqcn(): string
     {
         return Commande::class;
     }

     

     public function configureFields(string $pageName): iterable
     {
          return [
             IdField::new('id')->hideOnForm(),
             TextField::new('prenom'),
             TextField::new('nom'),
            //  MoneyField::new('montant')->setCurrency('EUR')->hideOnForm(),
             TextField::new('email'),
             MoneyField::new('prix_total')->setCurrency('EUR'),
             TextField::new('telephone'),
             DateTimeField::new('date_enregistrement')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
             AssociationField::new('chambre')->renderAsNativeWidget(),
             DateField::new('date_arivee')->setFormat('d/M/Y'),
             DateField::new('date_depart')->setFormat('d/M/Y'),
         ];
     }
 }
