<?php

/*
 * This file is part of the CCDNForum AdminBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNForum\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class BoardType extends AbstractType
{

    /**
     *
     * @access protected
     */
    protected $doctrine;

    /**
     *
     * @access protected
     */
    protected $defaults = array();

    /**
     *
     * @access public
     * @param $doctrine
     */
    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     *
     * @access public
     * @param FormBuilderInterface $builder, array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category', 'entity', array(
            'property' => 'name',
            'class' => 'CCDNForum\ForumBundle\Entity\Category',
            'query_builder' => function($repository) { return $repository->createQueryBuilder('c')->orderBy('c.id', 'ASC'); },
            //'preferred_choices' => $this->getPreferredCategory(),
			'label' => 'ccdn_forum_admin.form.label.board.category',
			'translation_domain' =>  'CCDNForumAdminBundle',
        ));
        $builder->add('name', null, array(
        	'label' => 'ccdn_forum_admin.form.label.board.name',
			'translation_domain' =>  'CCDNForumAdminBundle',
        ));
        $builder->add('description', 'bb_editor', array(
        	'label' => 'ccdn_forum_admin.form.label.board.description',
			'translation_domain' =>  'CCDNForumAdminBundle',
        ));
        $builder->add('readAuthorisedRoles', 'choice', array(
            'required' => false,
            'expanded' => true,
            'multiple' => true,
            'choices' => $options['available_roles'],
            'label' => 'View Board Roles:',
			'translation_domain' =>  'CCDNForumAdminBundle',
        ));
        $builder->add('topicCreateAuthorisedRoles', 'choice', array(
            'required' => false,
            'expanded' => true,
            'multiple' => true,
            'choices' => $options['available_roles'],
            'label' => 'Topic Create Roles:',
			'translation_domain' =>  'CCDNForumAdminBundle',
        ));
        $builder->add('topicReplyAuthorisedRoles', 'choice', array(
            'required' => false,
            'expanded' => true,
            'multiple' => true,
            'choices' => $options['available_roles'],
            'label' => 'Topic Reply Roles:',
			'translation_domain' =>  'CCDNForumAdminBundle',
        ));
    }

	/**
	 *
	 * @access private
	 */
	private function getPreferredCategory()
	{
		if ($this->defaults['category']) {
			return array($this->defaults['category']);
		} else {
			return null;
		}
	}

    /**
     *
     * @access public
     * @param array $defaults
     */
    public function setDefaultValues(array $defaults = null)
    {
        $this->defaults = array_merge($this->defaults, $defaults);

        return $this;
    }

    /**
     *
     * @access public
     * @param array $options
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'empty_data' => new \CCDNForum\ForumBundle\Entity\Board(),
            'data_class' => 'CCDNForum\ForumBundle\Entity\Board',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'board_item',
            'validation_groups' => 'admin_board',
            'available_roles' => array(),
        );
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'Board';
    }

}
