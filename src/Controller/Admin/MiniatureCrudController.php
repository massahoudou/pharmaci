<?php

namespace App\Controller\Admin;

use App\Entity\Miniature;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class MiniatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Miniature::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fichier =  TextareaField::new('fichier' , 'Image de la miniature')
        ->setFormType(FileType::class);

            $image =  ImageField::new('image' , 'Image de la miniature ')
                ->setBasePath('/images/miniatures/')
                ->setFormType(VichImageType::class);

            $field =   [
                TextField::new('flip','flip de la miniature '),
                AssociationField::new('pays')
                    ->setFormTypeOptions([
                       
                    ])
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
