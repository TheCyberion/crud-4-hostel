<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email'),
            TextEditorField::new('description'),
            IntegerField::new('note')->hideOnForm(),
            ChoiceField::new('categorie')->setChoices([
                'Hôtel'=>'Hôtel',
                'Chambres'=>'Chambres',
                'Restaurant'=>'Restaurant',
                'Spas'=>'Spas'
                
            ]),
            DateTimeField::new('date_enregistrement')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $commentaire =new $entityFqcn;
        $commentaire->setDateEnregistrement(new DateTime);
        return $commentaire;
    }
    
}
