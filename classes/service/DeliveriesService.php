<?php

class DeliveriesService
{
	public static function adminPage()
	{

    	add_menu_page(
        	'Adicionar entrega',     
        	'Adicionar entrega',     
        	'manage_options',   
        	'adicionar_entrega',     
        	'adminAddDeliveries' 
    	);

    	add_menu_page(
        	'Relatórios',     
        	'Relatórios ',     
        	'manage_options',   
        	'relatorio',     
        	'adminFilterDeliveries' 
    	);
	}

	public static function save_delivery()
	{
		if (!isset($_POST['action']) || $_POST['action'] != 'save_delivery' ) {
			return;
		}

		$users = get_users_list();
		$userName = $users[$_POST['user']];

		$data = [
			'post_title' => $_POST['title'] . ' - ' .$userName,
			'post_type' => 'delivery',
			'post_status' => 'publish',
		];

		$ID = wp_insert_post( $data );

		$postData = [
			'money' => $_POST['money'],
			'clientId' => $_POST['client'],
			'userId' => $_POST['user']
		];

		add_post_meta($ID, 'info', $postData);

		wp_redirect('edit.php?post_type=delivery');
	}

	public static function createResults()
	{	
		if (!isset($_POST['action']) || $_POST['action'] != 'results_delivery' ) {
			return;
		}

		$filter = self::setFilter($_POST);


		global $wpdb;

		$sql = 'select * from wp_posts where post_type = "delivery"';

		$results = $wpdb->get_results($sql);

		$deliveries = [];
		$value = 0;
		$usersMoney = [];
		$i = 0;

		$users = get_users_list();
		$clients = get_clients_list();

		foreach($users as $id => $user) {
			$usersMoney[$id] = 0;
		}

		foreach ($results as $item) {

			if (isset($filter['date_start']) && $item->post_date < $filter['date_start']) {
				continue;
			}

			if (isset($filter['date_end']) && $item->post_date >= $filter['date_end']) {
				continue;
			}

			$info = get_post_meta($item->ID, 'info', true);

			if (isset($filter['user']) && $filter['user'] != @$info['userId'] ) {
				continue;
			}

			if (isset($filter['client']) && $filter['client'] != $info['clientId'] ) {
				continue;
			}

			if (!isset($info['money'])) {
				$info['money'] = 0;
			}

			$money = converterCurrentMoneyServer($info['money']);

			$usersMoney[$info['userId']] += $money;

			$value += $money;

			$i++;
			$deliveries[] = [
				'ID' => $item->ID,
				'date' => $item->post_date,
				'moneyTotal' => converterCurrentMoneyServer($info['money']),
				'moneyCompany' => percentCompany(converterCurrentMoneyServer($info['money']))['company'],
				'moneyUser' => percentCompany(converterCurrentMoneyServer($info['money']))['user'],
				'client' => $clients[$info['clientId']],
				'user' => $users[$info['userId']],
				'date' => $item->post_date
 			];
		}

		$data = [
			'deliveries' => $deliveries,
			'money' => [
				'total' => number_format($value, 2, '.', ','),
				'company' => number_format(percentCompany($value)['company'] , 2, '.', ','),
				'user' => percentCompany($value)['user'],
				'users' => $usersMoney
			],
			'count' => $i
		];

		Timber::render('views/admin-charts.html.twig', $data);die;
	}	

	private static function setFilter($data)
	{

		$filter = [];

		if ($data['date_start']) {
			$filter['date_start'] = dateHumanToServer($data['date_start'], 'start');
		}


		if ($data['date_end']) {
			$filter['date_end'] = dateHumanToServer($data['date_end'], 'end');
		}


		if ($data['user'] != 'Selecione o usuário') {
			$filter['user'] = $data['user'];
		}

		if ($data['client'] != 'Selecione o cliente') {
			$filter['client'] = $data['client'];
		}

		return $filter;
	}
}

function adminAddDeliveries()
{	
	$data['clients'] = get_clients_list();
	$data['moneyjs'] = plugins_url() . '/PO-deliveries/classes/service/views/money.js';
	$data['users'] = get_users_list();
	return Timber::render('views/admin-add-deliveries.html.twig', $data);
}	

function adminFilterDeliveries()
{
	$data = [
		'users' => get_users_list(),
		'clients' => get_clients_list()
	];

	return Timber::render('views/admin-filter-deliveries.html.twig', $data);
}
