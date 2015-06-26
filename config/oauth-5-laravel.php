<?php

return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session',

	/**
	 * Consumers
	 */
	'consumers' => [

		'Google' => [
		    'client_id'     => env('GP_APP_ID', '351362885531-27uappldrtf390sl6tb7isf6hh2q2moh.apps.googleusercontent.com'),
		    'client_secret' => env('GP_APP_SECRET', 'P61KVSsVyMA0v5-yau7IuBz-'),
		    'scope'         => ['profile'],
		],  

	]

];