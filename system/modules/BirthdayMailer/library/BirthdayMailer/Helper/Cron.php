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
 * Class Cron
 * @package BirthdayMailer\Helper
 */
class Cron
{

	/**
	 * Sends the birthday emails.
	 *
	 * @return array
	 */
	public function sendBirthdayMails()
	{
		$arrResult = BirthdayMailer::sendBirthdayMails();
		
		\System::log('BirthdayMailer: Daily sending of birthday mail finished. Send ' . sizeof($arrResult['success']) . ' emails. '
			. sizeof($arrResult['failed']) . ' emails could not be send due to errors. '
			. sizeof($arrResult['aborted']) . ' emails were aborted due to custom hooks. See birthdaymails.log for details.', __METHOD__, TL_CRON);
	}

}
