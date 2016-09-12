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


namespace BirthdayMailer\Helper;

use BirthdayMailer\Model\BirthdayMailer;


/**
 * Class Backend
 * @package BirthdayMailer\Helper
 */
class Backend extends \Backend
{
	
	/**
	 * Execute the sender manually from backend and get a result page.
	 *
	 * @return string
	 */
	public function sendBirthdayMailsManually()
	{
		if (TL_MODE != 'BE')
		{
			return '';
		}

		$result = BirthdayMailer::sendBirthdayMails();

		// Create template object
		$objTemplate = new \BackendTemplate('be_birthday-mailer');

		$objTemplate->backLink = '<a href="' . ampersand(str_replace('&key=sendBirthdayMail', '', \Environment::get('request'))) . '" class="header_back" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['backBT']) . '" accesskey="b">' . $GLOBALS['TL_LANG']['MSC']['backBT'] . '</a>';
		$objTemplate->headline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline'];
		$objTemplate->sendingHeadline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline'];
		$objTemplate->success = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['successMessage'], sizeof($result['success']));

		$objTemplate->failed = sizeof($result['failed']) > 0;
		$objTemplate->failureMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureMessage'], sizeof($result['failed']));
		$objTemplate->failureTableHead = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureTableHead'];
		$objTemplate->failures = $result['failed'];
		$objTemplate->failureInfo = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureInfo'];

		$objTemplate->aborted = sizeof($result['aborted']) > 0;
		$objTemplate->abortionMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionMessage'], sizeof($result['aborted']));
		$objTemplate->abortionTableHead = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionTableHead'];
		$objTemplate->abortions = $result['aborted'];
		$objTemplate->abortionInfo = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionInfo'];

		if (\Config::get('birthdayMailerDeveloperMode'))
		{
			$objTemplate->developerMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage'], \Config::get('birthdayMailerDeveloperModeEmail'));
		}

		return $objTemplate->parse();
	}
}
