<?php

Configure::write('debug', 0);

Configure::write('App.encoding', 'UTF-8');

Configure::write('Cache.check', true);

define('LOG_ERROR', 2);

Configure::write('Session.save', 'php');
Configure::write('Session.cookie', 'CAKEPHP');
Configure::write('Session.timeout', 8*60*60);
Configure::write('Session.start', true);
Configure::write('Session.checkAgent', true);

Configure::write('Security.level', 'medium');
Configure::write('Security.salt', 'POSTLFY');

Configure::write('Acl.classname', 'DbAcl');
Configure::write('Acl.database', 'default');

date_default_timezone_set('Europe/Brussels');

Cache::config('default',
	array(
		'engine' => 'File'
	)
);

setlocale(LC_ALL, 'nl_NL');
