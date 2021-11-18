<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField; 

class PaysCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pays::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        $fichier =  TextareaField::new('fichier' , 'dreapeau du pays ')
        ->setFormType(FileType::class);

            $image =  ImageField::new('image' , 'drapeau du pays ')
                ->setBasePath('/images/pays/')
                ->setFormType(VichImageType::class);

            $field =   [
                TextField::new('nom','Le nom du pays')
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
