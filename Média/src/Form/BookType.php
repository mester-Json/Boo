<?php

namespace App\Form;

use App\Entity\Book;
use Doctrine\DBAL\Types\Type;
use Faker\Provider\ar_EG\Text;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Author;
use App\Entity\Editor;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Component\Validator\Constraints\NotNull;


class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Tittle', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2, 'max' => 255]),
                ],
            ])

            ->add('Code', TextType::class, [

                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 8, 'max' => 8]),
                ],

            ])
            ->add(
                'price',
                TextType::class,
                [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 1, 'max' => 255]),
                    ],

                ]
            )
            ->add(
                'autor',
                EntityType::class,
                [
                    'class' => Author::class,
                    'choice_label' => 'name',
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
            ->add(
                'editor',
                EntityType::class,
                [
                    'class' => Editor::class,
                    'choice_label' => 'name',
                    'constraints' => [
                        new NotBlank(),
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
