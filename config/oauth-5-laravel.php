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

		'Linkedin' => [
		    'client_id'     => env('LI_APP_ID', '75pegzqwj22ni0'),
		    'client_secret' => env('LI_APP_SECRET', 'X6N270CTJo8CwjvH'),
		],

	]

];