<?php

return [

	'directory_list' => [
		'.',
		__DIR__ . '/../../../phpunit/php-code-coverage'
	],

	'exclude_analysis_directory_list' => [
		__DIR__ . '/../../../phpunit/php-code-coverage',
	],

	'processes' => 1,

	'analyze_signature_compatibility' => true,

	'simplify_ast' => true,

	'generic_types_enabled' => true,

];


