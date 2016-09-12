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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup']     = array('Member group', 'Please select the member group, that should receive the automatic birthday emails.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['nc_notification'] = array('Notification', 'Please select a notification.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['disable']         = array('Deactivate', 'Temporarily disable the configuration.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['config_legend']  = 'Configuration';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['disable_legend'] = 'Deactivation';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail']  = array('Manual execution', 'Execute manually sending birthday emails');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['new']               = array('New configuration', 'Create a new configuration for birthday emails');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['show']              = array('Configuration details', 'Show the details of configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit']              = array('Edit configuration', 'Edit configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy']              = array('Duplicate configuration', 'Duplicate configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['cut']               = array('Move configuration', 'Move configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete']            = array('Delete configuration', 'Delete configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['toggle']            = array('Konfiguration ver�ffentlichen/unver�ffentlichen', 'Konfiguration ID %s ver�ffentlichen/unver�ffentlichen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteafter']        = array('Paste after', 'Paste after configuration ID %s');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteinto']         = array('Paste on top', 'Paste on top');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'] = array('Edit notification', 'Edit the notification ID %s');

/**
 * Misc texts
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['root_label']     = 'Birthday mailer configurations';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['group_enabled']  = 'Active member group';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['group_disabled'] = 'Deactivated member group';

/**
 * Manual execution messages
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline']          = "Manual execution";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline']   = "System messages";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['successMessage']    = "%s emails were sent successfully.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureMessage']    = "%s emails could not be sent due to errors.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureTableHead']  = "Errors";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureInfo']       = "Please check the Contao <b>System log</b> or the log files (<i>birthdaymails.log</i>, <i>error.log</i>) to get additional information about the errors.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionMessage']   = "%s emails could not be sent due to abortions.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionTableHead'] = "Abortions";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionInfo']      = "Please check the Contao <b>System log</b> to get additional information about the abortions.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage']  = "You are in developermode. All emails will be send to the folowing developer email address: <i>%s</i>. Please make sure that this is a valid email address. Changes can be made in the <b>Settings</b>.";
