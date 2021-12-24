<?php

namespace App\Controller\Admin;

use App\Entity\Maladienutrition;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class MaladienutritionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Maladienutrition::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fichier =  TextareaField::new('fichier' , 'Image de l\'article')
        ->setFormType(FileType::class);

            $image =  ImageField::new('image' , 'Image de l\'article')
                ->setBasePath('/images/articles/')
                ->setFormType(VichImageType::class);

            $field =   [
                TextField::new('titre', 'titre de l\'articles '),
               
                TextEditorField::new('description', 'Description de l\'article'),
                ChoiceField::new('type', 'Type  ')->setChoices(fn () => [
                    'maladie' => 0,
                    'nutrition' => 1,
                ]),

            ];

            if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {

                $field[] = $image;

            }
            else
            {
                $field[] =  $fichier;
            }

            return $field ;

    }
    
}
