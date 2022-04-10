<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\MediaBundle\Form\Type\MediaType;

final class CategoryAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
            ->add('image', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context'  => 'product',
                'required' => false,
                'label'    => 'Изображение',
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
//            ->add('id')
            ->add('name')
            ->add('active')
            ->add('Parent')
            ->add('image', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context'  => 'product',
                'required' => false,
                'label'    => 'Изображение',
            ])
            ->add('gallery', AdminType::class);

    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('Parent')


            ;
    }
}
