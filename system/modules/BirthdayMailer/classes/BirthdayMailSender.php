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
 * Run in a custom namespace, so the class can be replaced
 */
namespace BirthdayMailer;

/**
 * Class BirthdayMailSender
 *
 * Provide methods to send the birthday emails
 * @copyright  Cliff Parnitzky 2011-2015
 * @author     Cliff Parnitzky
 * @package    BirthdayMailer
 */
class BirthdayMailSender extends \Backend
{
	// the default language will always be englisch
	const DEFAULT_LANGUAGE = 'en';

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Execute the sender manually from backend and get a result page.
	 */
	public function sendBirthdayMailManually()
	{
		if (TL_MODE == 'BE')
		{
			$result = $this->sendBirthdayMail();
			
			// Create template object
			$objTemplate = new \BackendTemplate('be_birthday-mailer');

			$objTemplate->backLink = '<a href="'.ampersand(str_replace('&key=sendBirthdayMail', '', $this->Environment->request)).'" class="header_back" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['backBT']).'" accesskey="b">'.$GLOBALS['TL_LANG']['MSC']['backBT'].'</a>';
			$objTemplate->headline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline'];
			$objTemplate->sendingHeadline = $GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline'];
			$objTemplate->success = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['successMessage'], $result['success']);
			
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
			
			if ($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'])
			{
				$objTemplate->developerMessage = sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage'], $GLOBALS['TL_CONFIG']['birthdayMailerDeveloperModeEmail']);
			}
			
			return $this->replaceInsertTags($objTemplate->parse());
		}
		return;
	}

	/**
	 * Sends the birthday emails.
	 */
	public function sendBirthdayMail()
	{
		// first check if required extension 'associategroups' is installed
		if (!in_array('associategroups', $this->Config->getActiveModules()))
		{
			$this->log('BirthdayMailSender: Extension "associategroups" is required!', 'BirthdayMailSender sendBirthdayMail()', TL_ERROR);
			return false;
		}
		
		$alreadySendTo = array();
		$notSendCauseOfError = array();
		$notSendCauseOfAbortion = array();
		
		$config = $this->Database->prepare("SELECT tl_member.*, "
												. "tl_member_group.name as memberGroupName, tl_member_group.disable as memberGroupDisable, tl_member_group.start as memberGroupStart, tl_member_group.stop as memberGroupStop, "
												. "tl_birthdaymailer.sender as mailSender, tl_birthdaymailer.senderName as mailSenderName, tl_birthdaymailer.mailCopy as mailCopy, tl_birthdaymailer.mailBlindCopy as mailBlindCopy, "
												. "tl_birthdaymailer.mailUseCustomText as mailUseCustomText, tl_birthdaymailer.mailTextKey as mailTextKey "
												. "FROM tl_member "
												. "JOIN tl_member_to_group ON tl_member_to_group.member_id = tl_member.id "
												. "JOIN tl_member_group ON tl_member_group.id = tl_member_to_group.group_id "
												. "JOIN tl_birthdaymailer ON tl_birthdaymailer.membergroup = tl_member_group.id "
												. "ORDER BY tl_member.id, tl_birthdaymailer.priority DESC")
											 ->execute();
											
		if($config->numRows < 1)
		{
			return;
		}
		
		while($config->next())
		{
			if(
					is_numeric($config->dateOfBirth)
					&&
					(
						(
							$GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode']
							&&
							$GLOBALS['TL_CONFIG']['birthdayMailerDeveloperModeIgnoreDate']
						)
						||
						(
							date("d.m") == date("d.m", $config->dateOfBirth)
						)
					)
					&&
					(
						$this->isMemberActive($config)
						&&
						$this->isMemberGroupActive($config)
						&&
						$this->allowSendingDuplicates($alreadySendTo, $config)
					)
				)
			{
				// now check via custom hook, if sending should be aborted
				$blnAbortSendMail = false;
				if (isset($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail']) && is_array($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail']))
				{
					foreach ($GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail'] as $callback)
					{
						$this->import($callback[0]);
						$blnAbortSendMail = $this->{$callback[0]}->{$callback[1]}($config, $blnAbortSendMail);
					}
				}
				
				if (!$blnAbortSendMail)
				{
					if ($this->sendMail($config))
					{
						$alreadySendTo[] =  $config->id;
					}
					else
					{
						$notSendCauseOfError[] =  array('id' => $config->id, 'firstname' => $config->firstname, 'lastname' => $config->lastname, 'email' => $config->email);
					}
				}
				else
				{
					$notSendCauseOfAbortion[] =  array('id' => $config->id, 'firstname' => $config->firstname, 'lastname' => $config->lastname, 'email' => $config->email);
				}
			}
		}
		
		$this->log('BirthdayMailer: Daily sending of birthday mail finished. Send ' . sizeof($alreadySendTo) . ' emails. '
							. sizeof($notSendCauseOfError) . ' emails could not be send due to errors. '
							. sizeof($notSendCauseOfAbortion) . ' emails were aborted due to custom hooks. See birthdaymails.log for details.', 'BirthdayMailSender sendBirthdayMail()', TL_CRON);
		
		return array('success' => sizeof($alreadySendTo), 'failed' => $notSendCauseOfError, 'aborted' => $notSendCauseOfAbortion);
	}
	
	/**
	 * Get the text for specific types for the email. Fallback ist to 'default' if no text is set.
	 * FALLBACK Chain:
	 * 		1. check, if there is a text for the specified textKey and language (search in system/config/langconfig.php)
	 *		2. if nothing found, check, if there is a text for the specified textKey and 'en' (search in system/config/langconfig.php)
	 *		3. if nothing found, get default text in specified language
	 *		4. if nothing found, get default text in language 'en'
	 */
	private function getEmailText ($textType, $config, $language)
	{
		$text = "";

		if ($config->mailUseCustomText)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$config->mailTextKey][$textType][$language];
			
			if (strlen($text) == 0 && $language != self::DEFAULT_LANGUAGE)
			{
				$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$config->mailTextKey][$textType][self::DEFAULT_LANGUAGE];
			}
		}

		if (strlen($text) == 0)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default'][$textType];
		}

		$textReplaced = $this->replaceBirthdayMailerInsertTags($text, $config, $language);
		
		if ($textReplaced)
		{
			return $textReplaced;
		}
		
		return $text;
	}
	
	/**
	 * Send an email.
	 * @return boolean
	 */
	private function sendMail($config)
	{
		$language = $config->language;
		if (strlen($language) == 0)
		{
			$language = self::DEFAULT_LANGUAGE;
		}
		
		$this->loadLanguageFile('BirthdayMailer', $language);
		
		$emailSubject = $this->getEmailText('subject', $config, $language);
		$emailText = $this->getEmailText('text', $config, $language);
		$emailHtml = $this->getEmailText('html', $config, $language);
	
		if ($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'] || $GLOBALS['TL_CONFIG']['birthdayMailerLogDebugInfo'])
		{
			$mailTextUsageOutput = $config->mailUseCustomText ? 'yes' : 'no';
			$this->log('BirthdayMailer: These are additional debugging information that will only be logged in developer mode or if debugging is enabled.'
									 . ' | Userlanguage = ' . $config->language
								   . ' | used language = ' . $language
								   . ' | mailTextUsage = ' . $mailTextUsageOutput
								   . ' | mailTextKey = ' . $config->mailTextKey
								   . ' | email = ' . $config->email
								   . ' | subject = ' . $emailSubject
								   . ' | text = ' . $emailText
								   . ' | html = ' . $emailHtml, 'BirthdayMailSender sendMail()', TL_CRON);
		}
		
		$objEmail = new \Email();

		$objEmail->logFile = 'birthdaymails.log';
		
		$objEmail->from = $config->mailSender;
		if (strlen($config->mailSenderName) > 0)
		{
			$objEmail->fromName = $config->mailSenderName;
		}
		$objEmail->subject = $emailSubject;
		$objEmail->text = $emailText;
		$objEmail->html = $emailHtml;
		
		try
		{
			$emailTo = $config->email;
			
			if ($GLOBALS['TL_CONFIG']['birthdayMailerDeveloperMode'])
			{
				$emailTo = $GLOBALS['TL_CONFIG']['birthdayMailerDeveloperModeEmail'];
			}
			else
			{
				if (strlen($config->mailCopy) > 0)
				{
					$emailCC = trimsplit(',', $config->mailCopy);
					$objEmail->sendCc($emailCC);
				}
				
				if (strlen($config->mailBlindCopy) > 0)
				{
					$emailBCC = trimsplit(',', $config->mailBlindCopy);
					$objEmail->sendBcc($emailBCC);
				}
				
				$emailTo = $config->email;
			}
			return $objEmail->sendTo($emailTo);
		}
		catch (Swift_RfcComplianceException $e)
		{
			return false;
		}
	}

	/**
	 * Checks if the member is active.
	 * @return boolean
	 */
	private function isMemberActive($config)
	{
		if ($config->disable ||
			(strlen($config->start) > 0 &&
			$config->start > time()) ||
			(strlen($config->stop) > 0 &&
			$config->stop < time()))
		{
			return false;
		}
		return true;
	}

	/**
	 * Checks if the associated group is active.
	 * @return boolean
	 */
	private function isMemberGroupActive($config)
	{
		if ($config->memberGroupDisable ||
			(strlen($config->memberGroupStart) > 0 &&
			$config->memberGroupStart > time()) ||
			(strlen($config->memberGroupStop) > 0 &&
			$config->memberGroupStop < time()))
		{
			return false;
		}
		return true;
	}
	
	/**
	 * Checks if sending duplicate emails is allowed.
	 * @return boolean
	 */
	private function allowSendingDuplicates($alreadySendTo, $config)
	{
		if (!$GLOBALS['TL_CONFIG']['birthdayMailerAllowDuplicates'] && in_array($config->id, $alreadySendTo))
		{
			return false;
		}
		return true;
	}
	
	/**
	 * Delete an according configuration, if the member group is deleted.
	 */
	public function deleteConfiguration(DataContainer $dc)
	{
		$this->Database->prepare("DELETE FROM tl_birthdaymailer WHERE memberGroup = ?")
						 ->execute($dc->id);
	}
	
	/**
	 * Replaces all insert tags for the email text.
	 */
	private function replaceBirthdayMailerInsertTags ($text, $config, $language)
	{
		$textArray = preg_split('/\{\{([^\}]+)\}\}/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
		
		for ($count = 0; $count < count($textArray); $count++)
		{
			$parts = explode("::", $textArray[$count]);
			switch ($parts[0])
			{
				case 'birthdaychild':
					switch ($parts[1])
					{
						case 'salutation':
							$salutation = $this->getSalutation($config, $language, 'salutation_' . $config->gender);
							if (strlen($salutation) == 0)
							{
								$salutation = $this->getSalutation($config, $language, 'salutation');
							}
							$textArray[$count] = $salutation;
							break;
							
						case 'name':
							$textArray[$count] = trim($config->firstname . ' ' . $config->lastname);
							break;
							
						case 'groupname':
							$textArray[$count] = trim($config->memberGroupName);
							break;
							
						case 'password':
							// do not allow extracting the password
							$textArray[$count] = "";
							break;
							
						case 'age':
							$textArray[$count] = (date("Y") - date("Y", $config->dateOfBirth));
							break;
							
						default:
							$textArray[$count] = $config->{$parts[1]};
							break;
					}
					break;
					
				case 'birthdaymailer':
					switch ($parts[1])
					{
						case 'email':
							$textArray[$count] = trim($config->mailSender);
							break;
							
						case 'name':
							$textArray[$count] = trim($config->mailSenderName);
							break;
					}
					break;
			}
		}
		
		return implode('', $textArray);
	}
	
	/**
	 * Get the text for specific types. Fallback ist to 'default' if no text is set.
	 * FALLBACK Chain:
	 * 		1. check, if there is a text for the specified textKey and language (search in system/config/langconfig.php)
	 *		2. if nothing found, check, if there is a text for the specified textKey and 'en' (search in system/config/langconfig.php)
	 *		3. if nothing found, get default text in specified language
	 *		4. if nothing found, get default text in language 'en'
	 */
	private function getSalutation($config, $language, $textType)
	{
		$text = "";

		if ($config->mailUseCustomText)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$config->mailTextKey][$textType][$language];
			
			if (strlen($text) == 0 && $language != self::DEFAULT_LANGUAGE)
			{
				$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail'][$config->mailTextKey][$textType][self::DEFAULT_LANGUAGE];
			}
		}

		if (strlen($text) == 0)
		{
			$text = $GLOBALS['TL_LANG']['BirthdayMailer']['mail']['default'][$textType];
		}

		return $text;
	}
}

?>