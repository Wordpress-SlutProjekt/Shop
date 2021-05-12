<?php

add_filter('dbdbsmsn_networks', 'dbdbsmsn_add_phone_icon');

if (!function_exists('dbdbsmsn_add_phone_icon')) {
	function dbdbsmsn_add_phone_icon($networks) {
        $networks['dbdb-phone'] = array (
            'name' => 'Phone',
            'code' => '\\e090',
            'color' => '#58a9de',
            'font-family' => 'ETModules'
        );
		return $networks;
	}
}
