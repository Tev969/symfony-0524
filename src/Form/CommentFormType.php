<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Conference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                
                    ->add('author', null, [
                        'label' => 'Your name',
                    ])
                     ->add('text')
                
                    ->add('email', EmailType::class)
                    ->add('photo', FileType::class, [
                        'required' => false,
                        'mapped' => false,
                    ])
                    ->add('submit', SubmitType::class)
                 ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
