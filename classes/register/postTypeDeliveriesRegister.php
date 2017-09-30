<?php

class postTypeDeliveriesRegister
{
	public static function register()
	{
		$labels = array(
			'name'               => 'Entrega',
			'singular_name'      => 'Enrega',
			'menu_name'          => 'Lista de entregas',
			'name_admin_bar'     => 'Entregas',
			'add_new'            => 'Nova entrega',
			'add_new_item'       => 'Nova entrega',
			'new_item'           => 'Nova entrega',
			'edit_item'          => 'Editar entrega',
			'view_item'          => 'Ver entrega',
			'all_items'          => 'Todas entregas',
			'not_found'          => 'Sem entregas',
			'not_found_in_trash' => 'Sem entregas excluidas'
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => '',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'delivery' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' )
		);

		register_post_type( 'delivery', $args );
	}
}
