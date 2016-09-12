<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2011-2015
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 * @license    LGPL
 */

/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['accounts']['BirthdayMailer'] = array
(
	'tables'           => array('tl_birthdaymailer'),
	'icon'             => 'system/modules/BirthdayMailer/assets/icon.png',
	'sendBirthdayMail' => array('BirthdayMailer\Helper\Backend', 'sendBirthdayMailsManually'),
);


/**
 * Models
 */
$GLOBALS['TL_MODELS'][BirthdayMailer\Model\BirthdayMailer::getTable()] = 'BirthdayMailer\Model\BirthdayMailer';


/**
 * Cron
 */
$GLOBALS['TL_CRON']['daily'][] = array('BirthdayMailer\Helper\Cron', 'sendBirthdayMails');


/**
 * Notification Center Notification Types
 */
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['recipients'] = array(
	'birthdaychild_email', // returns the email of the member
	'admin_email'
);
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_subject'] = array(
	'birthdaychild_*', // returns all the values of the current member (replace * with any attribute of the member, e.g. firstname or company, the attribute password is not allowed)
	'birthdaychild_name', // returns first and last name of the member
	'birthdaychild_age', // returns the age of the member
	'birthdaychild_salutation', // returns the salutation of the member (depending on gender)
	'birthdaychild_welcoming_personally', // returns the personally welcoming for the birthday child (depending on gender)
	'birthdaychild_welcoming_formally', // returns the formally welcoming for the birthday child (depending on gender)
	'birthdaymailer_groupname', // returns the name of the member group of the current configuration
);
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_text'] =
	$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_subject'];
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_html'] =
	$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_subject'];

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_recipient_cc'] = array(
	'admin_email'
);
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_recipient_bcc'] = array(
	'admin_email'
);
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['BirthdayMailer']['birthday_mail']['email_replyTo'] = array(
	'admin_email'
);

