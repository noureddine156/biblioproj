<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter book title'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a title',
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Title should be at least {{ limit }} characters',
                        'maxMessage' => 'Title cannot be longer than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('author', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter author name'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an author',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '5',
                    'placeholder' => 'Enter book description'
                ],
                'required' => false,
            ])
            ->add('year', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter publication year'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a publication year',
                    ]),
                ],
            ])
            ->add('isbn', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter ISBN (e.g. 978-3-16-148410-0)'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an ISBN',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/',
                        'message' => 'The ISBN format is not valid',
                    ]),
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a category',
                'attr' => [
                    'class' => 'form-select'
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
