<?php

namespace App\Controller\Admin;

use App\Entity\Conseil;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ConseilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conseil::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fichier =  TextareaField::new('fichier' , 'Image')
        ->setFormType(FileType::class);

            $image =  ImageField::new('image' , 'Image  ')
                ->setBasePath('images/conseils/')
                ->setFormType(VichImageType::class);

            $field =   [
                TextField::new('titre','titre conseil'),
                TextField::new('slug','slug du conseil'),
                TextEditorField::new('description','description du conseil'),
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
