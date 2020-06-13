<?php

return [

	'soap' => [
		'url' => 'https://www1.gsis.gr/wsaade/RgWsPublic2/RgWsPublic2?WSDL',
		'username' => 'your-username',
		'password' => 'your-password',
	],

	'data_mapping' => [
		// soap node => response attribute
		'afm' => 'afm',
		'doy_descr' => 'doy',
		'onomasia' => 'title',
		'postal_address' => 'address',
		'postal_address_no' => 'address_no',
		'postal_zip_code' => 'zip_code',
		'postal_area_description' => 'city',
		'regist_date' => 'date_of_registration',
		'firm_flag_descr' => 'type',
		'deactivation_flag_descr' => 'status',
	],

];
