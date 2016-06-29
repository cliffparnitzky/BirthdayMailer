<?php
/**
 * BirthdayMailer for Contao Open Source CMS
 *
 * Copyright (c) 2011-2016 Cliff Parnitzky
 *
 * @package BirthdayMailer
 * @author  Cliff Parnitzky
 * @author  Richard Henkenjohann <richardhenkenjohann@googlemail.com>
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'birthdayMailerDeveloperMode';
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{birthdayMailer_legend},birthdayMailerAllowDuplicates, birthdayMailerLogDebugInfo, birthdayMailerDeveloperMode;';
$GLOBALS['TL_DCA']['tl_settings']['subpalettes']['birthdayMailerDeveloperMode'] = 'birthdayMailerDeveloperModeEmail, birthdayMailerDeveloperModeIgnoreDate';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerAllowDuplicates'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerAllowDuplicates'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerLogDebugInfo'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerLogDebugInfo'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerDeveloperMode'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperMode'],
	'inputType' => 'checkbox',
	'eval'      => array('submitOnChange' => true, 'tl_class' => 'w50 clr')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerDeveloperModeEmail'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeEmail'],
	'inputType' => 'text',
	'eval'      => array('mandatory' => true, 'rgxp' => 'email', 'tl_class' => 'w50 clr')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['birthdayMailerDeveloperModeIgnoreDate'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeIgnoreDate'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class' => 'w50')
);
