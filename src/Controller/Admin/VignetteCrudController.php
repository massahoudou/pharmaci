<?php

namespace App\Controller\Admin;

use App\Entity\Vignette;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField; 
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class VignetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vignette::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $fichier =  TextareaField::new('fichier' , 'Image de la vignette')
        ->setFormType(FileType::class);

            $image =  ImageField::new('image' , 'Image de la vignette')
                ->setBasePath('/images/vignettes/')
                ->setFormType(VichImageType::class);

            $field =   [
                  
            TextField::new('titre','titre de la vignette'), 
            AssociationField::new('categorie','Catégories de la vignette')->setFormTypeOptions([]),
            TextField::new('flip', 'flip de la vignette'),
            TextEditorField::new('description','Description de la vignette'),
    
                AssociationField::new('pays')
                    ->setFormTypeOptions([])
                   

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
