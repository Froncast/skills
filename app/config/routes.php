<?php

return [

	'skills' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'skills/{page:\d+$}' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'skills/ajax' => [
		'controller' => 'ajax',
		'action' => 'ajax',
	],

	'skills/admin/verification_skills' => [
		'controller' => 'admin',
		'action' => 'verification_skills',
	],
	'skills/admin/verification_skills/{page:\d+$}' => [
		'controller' => 'admin',
		'action' => 'verification_skills',
	],

	'skills/admin' => [
		'controller' => 'admin',
		'action' => 'index',
	],

	'skills/admin/admin_auth' => [
		'controller' => 'admin',
		'action' => 'admin_auth',
	],

	'skills/admin/add_admin' => [
		'controller' => 'admin',
		'action' => 'add_admin',
	],

	'skills/admin/logout' =>[
		'controller' => 'admin',
		'action' => 'logout',
	],

	'skills/admin/operators' => [
		'controller' => 'admin',
		'action' => 'operators',
	],

	'skills/admin/operators/{page:\d+$}' => [
		'controller' => 'admin',
		'action' => 'operators',
	],

	'skills/admin/add_operator' => [
		'controller' => 'admin',
		'action' => 'add_operator',
	],

	'skills/admin/operators/edit/{id:\d+$}' => [
		'controller' => 'admin',
		'action' => 'editOperator',
	],

	'skills/admin/operators/delete/{id:\d+$}' => [
		'controller' => 'admin',
		'action' => 'delete_operator',
	],

	'skills/admin/add_skill_to_operator' => [
		'controller' => 'admin',
		'action' => 'add_skill_to_operator',
	],

	'skills/admin/skills' => [
		'controller' => 'admin',
		'action' => 'skills',
	],

	'skills/admin/add_skill' => [
		'controller' => 'admin',
		'action' => 'add_skill',
	],

	'skills/admin/verification_methods' => [
		'controller' => 'admin',
		'action' => 'verification_methods',
	],

	'skills/admin/admin_management' => [
		'controller' => 'admin',
		'action' => 'admin_management',
	],

	/**
	 * test page
	 */
	
	'skills/test' => [
		'controller' => 'test',
		'action' => 'test',
	],

	'skills/login' => [
		'controller' => 'login',
		'action' => 'login',
	],

];