<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Repository\PaysRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ArticleCrudController extends AbstractCrudController
{
    private $repospays ;
    public function __construct(PaysRepository $repospays)
    {
        $this->repospays = $repospays;
    }
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fichier =  TextareaField::new('fichier' , 'Image de l\'article')
        ->setFormType(FileType::class);

            $image =  ImageField::new('image' , 'Image de l\'article')
                ->setBasePath('/images/articles/')
                ->setFormType(VichImageType::class);

            $field =   [
                TextField::new('titre', 'titre de l\'article'),
                TextField::new('slug', 'slug de larticle de l\'article'),
                TextEditorField::new('description', 'Description de l\'article'),
                AssociationField::new('pays')
                    ->setFormTypeOptions([
                       
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
