<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'BirthdayMailer',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'BirthdayMailer\BirthdayMailSender'   => 'system/modules/BirthdayMailer/classes/BirthdayMailSender.php',

	// Library
	'BirthdayMailer\Helper\Backend'       => 'system/modules/BirthdayMailer/library/BirthdayMailer/Helper/Backend.php',
	'BirthdayMailer\Helper\Cron'          => 'system/modules/BirthdayMailer/library/BirthdayMailer/Helper/Cron.php',
	'BirthdayMailer\Helper\Dca'           => 'system/modules/BirthdayMailer/library/BirthdayMailer/Helper/Dca.php',
	'BirthdayMailer\Model\BirthdayMailer' => 'system/modules/BirthdayMailer/library/BirthdayMailer/Model/BirthdayMailer.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_birthday-mailer' => 'system/modules/BirthdayMailer/templates/backend',
));
