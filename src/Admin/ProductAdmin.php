<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\ProductImage;
use App\Entity\SonataMediaMedia;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\MediaBundle\Form\Type\MediaType;
use Sonata\MediaBundle\Model\Media;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class ProductAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('description')
//            ->add('Media', MediaType::class,[
//                'provider'=>'sonata.media.provider.image',
//                'context'=>'product',
//                'required'=>false,
//                'label'=>'Изображение',
//            ])
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('name')
            ->add('description')
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
            ]);;

    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
//            ->add('id')
            ->add('name')
            ->add('Parent')
            ->add('description')
//            ->add('image', FileType::class, [
//                'required'=>false,
//                'mapped'=>false,
//            ])
            ->add('image', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context'  => 'product',
                'required' => false,
                'label'    => 'Изображение',
            ])
            ->add('gallery', AdminType::class);
        ;
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
//            ->add('productImages')
//            ->add('id')
            ->add('name')
            ->add('description')
        ;
    }


}
