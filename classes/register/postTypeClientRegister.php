<?php

class postTypeClientRegister
{
	public static function register()
	{
		$labels = array(
			'name'               => 'Cliente',
			'singular_name'      => 'Cliente',
			'menu_name'          => 'Lista de clientes',
			'name_admin_bar'     => 'Clientes',
			'add_new'            => 'Novo cliente',
			'add_new_item'       => 'Novo cliente',
			'new_item'           => 'Novo cliente',
			'edit_item'          => 'Editar cliente',
			'view_item'          => 'Ver cliente',
			'all_items'          => 'Todos clientes',
			'not_found'          => 'Sem clientes',
			'not_found_in_trash' => 'Sem clientes excluidos'
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => '',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'client' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( 'client', $args );
	}	
}
