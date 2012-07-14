<?php

/*
 * This file is part of the CCDN AdminBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 
 * 
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNForum\AdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class CCDNForumAdminExtension extends Extension
{
	
	
	
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

		$container->setParameter('ccdn_forum_admin.template.engine', $config['template']['engine']);
		$container->setParameter('ccdn_forum_admin.user.profile_route', $config['user']['profile_route']);
		
		$this->getSEOSection($container, $config);
		$this->getCategorySection($container, $config);
		$this->getBoardSection($container, $config);
		$this->getTopicSection($container, $config);
		$this->getPostSection($container, $config);
		
    }
	
	
	
    /**
     * {@inheritDoc}
     */
	public function getAlias()
	{
		return 'ccdn_forum_admin';
	}
	
	
	
	/**
	 *
	 * @access protected
	 * @param $container, $config
	 */
	protected function getSEOSection($container, $config)
	{
	    $container->setParameter('ccdn_forum_admin.seo.title_length', $config['seo']['title_length']);
	}

	
	
	/**
	 *
	 * @access private
	 * @param $container, $config
	 */
	private function getCategorySection($container, $config)
	{
		$container->setParameter('ccdn_forum_admin.category.index.layout_template', $config['category']['index']['layout_template']);
		$container->setParameter('ccdn_forum_admin.category.index.last_post_datetime_format', $config['category']['index']['last_post_datetime_format']);
		
		$container->setParameter('ccdn_forum_admin.category.create.layout_template', $config['category']['create']['layout_template']);
		$container->setParameter('ccdn_forum_admin.category.create.form_theme', $config['category']['create']['form_theme']);
		
		$container->setParameter('ccdn_forum_admin.category.edit.layout_template', $config['category']['edit']['layout_template']);
		$container->setParameter('ccdn_forum_admin.category.edit.form_theme', $config['category']['edit']['form_theme']);
		
		$container->setParameter('ccdn_forum_admin.category.delete.layout_template', $config['category']['delete']['layout_template']);
	}



	/**
	 *
	 * @access private
	 * @param $container, $config
	 */	
	private function getBoardSection($container, $config)
	{
		$container->setParameter('ccdn_forum_admin.board.create.layout_template', $config['board']['create']['layout_template']);
		$container->setParameter('ccdn_forum_admin.board.create.form_theme', $config['board']['create']['form_theme']);
		
		$container->setParameter('ccdn_forum_admin.board.edit.layout_template', $config['board']['edit']['layout_template']);
		$container->setParameter('ccdn_forum_admin.board.edit.form_theme', $config['board']['edit']['form_theme']);
		
		$container->setParameter('ccdn_forum_admin.board.delete.layout_template', $config['board']['delete']['layout_template']);
	}
	
	

	/**
	 *
	 * @access private
	 * @param $container, $config
	 */	
	private function getTopicSection($container, $config)
	{
		$container->setParameter('ccdn_forum_admin.topic.show_deleted.layout_template', $config['topic']['show_deleted']['layout_template']);
		$container->setParameter('ccdn_forum_admin.topic.show_deleted.topics_per_page', $config['topic']['show_deleted']['topics_per_page']);
		$container->setParameter('ccdn_forum_admin.topic.show_deleted.topic_title_truncate', $config['topic']['show_deleted']['topic_title_truncate']);
		$container->setParameter('ccdn_forum_admin.topic.show_deleted.topic_created_datetime_format', $config['topic']['show_deleted']['topic_created_datetime_format']);
		$container->setParameter('ccdn_forum_admin.topic.show_deleted.topic_closed_datetime_format', $config['topic']['show_deleted']['topic_closed_datetime_format']);
		$container->setParameter('ccdn_forum_admin.topic.show_deleted.topic_deleted_datetime_format', $config['topic']['show_deleted']['topic_deleted_datetime_format']);
		
	}
	
	

	/**
	 *
	 * @access private
	 * @param $container, $config
	 */	
	private function getPostSection($container, $config)
	{
		$container->setParameter('ccdn_forum_admin.post.show_deleted.layout_template', $config['post']['show_deleted']['layout_template']);
		$container->setParameter('ccdn_forum_admin.post.show_deleted.posts_per_page', $config['post']['show_deleted']['posts_per_page']);
		$container->setParameter('ccdn_forum_admin.post.show_deleted.topic_title_truncate', $config['post']['show_deleted']['topic_title_truncate']);
		$container->setParameter('ccdn_forum_admin.post.show_deleted.post_created_datetime_format', $config['post']['show_deleted']['post_created_datetime_format']);
		$container->setParameter('ccdn_forum_admin.post.show_deleted.post_locked_datetime_format', $config['post']['show_deleted']['post_locked_datetime_format']);
		$container->setParameter('ccdn_forum_admin.post.show_deleted.post_deleted_datetime_format', $config['post']['show_deleted']['post_deleted_datetime_format']);
		
	}
	
}
