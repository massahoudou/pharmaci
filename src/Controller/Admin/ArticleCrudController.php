<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Repository\PaysRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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
        // if ( $pageName === 'edit'  ) {
        
        //     $this->get(AdminContextProvider::class)->getContext()->getEntity()->getInstance();
        //     $lespays = $this->getDoctrine()->getRepository(Pays::class)->findAll();
        //     array_unshift( $lespays, $this->get(AdminContextProvider::class)->getContext()->getEntity()->getInstance()->getPays() );
        // }
            
                        return [
            TextField::new('titre', 'titre de l\'article'),
            TextEditorField::new('description', 'Description de l\'article'),
            ChoiceField::new('position', 'Section ')->setChoices(fn () => [
                'section 1' => 1,
                'section 2' => 2,
                'section 3' => 3,
                'section 4' => 4,
            ]),
            AssociationField::new('pays')
                ->setFormTypeOptions([
                   
                ])
               

        ];


    }
}
