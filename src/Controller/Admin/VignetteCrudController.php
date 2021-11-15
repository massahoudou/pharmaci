<?php

namespace App\Controller\Admin;

use App\Entity\Vignette;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField; 
class VignetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vignette::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
         
            
            TextField::new('titre','titre de la vignette'), 
            TextField::new('flip', 'flip de l\'article'),
            TextEditorField::new('description','Description de la vignette'),
            ChoiceField::new('position', 'Section ')->setChoices(fn () => [
                'section 1' => 1,
                'section 2' => 2,
                'section 3' => 3,
                'section 4' => 4,
            ]),
        ];
    }
    
}
