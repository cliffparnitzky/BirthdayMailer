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
 * Class Dca
 * @package BirthdayMailer\Helper
 */
class Dca extends \Backend
{
	
	/**
	 * Add an image to each record
	 *
	 * @param array
	 * @param string
	 * @param \DataContainer
	 * @param array
	 *
	 * @return string
	 */
	public function addIcon($row, $label, \DataContainer $dc, $args)
	{

		$image = 'icon';

		if ($row['disable'])
		{
			$image .= '_1';
		}

		// get group from database
		$objMemberGroup = \MemberGroupModel::findByPk($row['memberGroup']);

		$memberGroupImage = 'mgroup';
		$memberGroupTitle = $GLOBALS['TL_LANG']['tl_birthdaymailer']['group_enabled'];

		if ($objMemberGroup->disable || strlen($objMemberGroup->start) && $objMemberGroup->start > time() || strlen($objMemberGroup->stop) && $objMemberGroup->stop < time())
		{
			$memberGroupImage .= '_';
			$memberGroupTitle = $GLOBALS['TL_LANG']['tl_birthdaymailer']['group_disabled'];
		}

		return sprintf('<img width="16" height="16" style="margin-left: 0px;" alt="Status icon" src="system/modules/BirthdayMailer/assets/%s.png"/> %s <img src="system/themes/%s/images/%s.gif" alt="%s" title="%s" />', $image, $label, $this->getTheme(), $memberGroupImage, $memberGroupTitle, $memberGroupTitle);
	}


	/**
	 * Return the paste button
	 *
	 * @param \DataContainer $dc
	 * @param                $row
	 * @param                $table
	 * @param                $cr
	 * @param bool           $arrClipboard
	 *
	 * @return string
	 */
	public function pasteConfig(\DataContainer $dc, $row, $table, $cr, $arrClipboard = false)
	{
		$this->import('BackendUser', 'User');
		$imagePasteAfter = $this->generateImage('pasteafter.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id']));
		$imagePasteInto = $this->generateImage('pasteinto.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id']));
		if ($row['id'] == 0)
		{
			return $cr ? $this->generateImage('pasteinto_.gif') . ' ' : '<a href="' . $this->addToUrl('act=' . $arrClipboard['mode'] . '&mode=2&pid=' . $row['id'] . '&id=' . $arrClipboard['id']) . '" title="' . specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id'])) . '" onclick="Backend.getScrollOffset();">' . $imagePasteInto . '</a> ';
		}

		return (($arrClipboard['mode'] == 'cut' && $arrClipboard['id'] == $row['id']) || $cr) ? $this->generateImage('pasteafter_.gif') . ' ' : '<a href="' . $this->addToUrl('act=' . $arrClipboard['mode'] . '&mode=1&pid=' . $row['id'] . '&id=' . $arrClipboard['id']) . '" title="' . specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id'])) . '" onclick="Backend.getScrollOffset();">' . $imagePasteAfter . '</a> ';
	}


	/**
	 * Get notification choices
	 *
	 * @return array
	 */
	public function getNotificationChoices()
	{
		$arrChoices = array();
		$objNotifications = \Database::getInstance()->execute("SELECT id,title FROM tl_nc_notification WHERE type='birthday_mail' ORDER BY title");

		while ($objNotifications->next())
		{
			$arrChoices[$objNotifications->id] = $objNotifications->title;
		}

		return $arrChoices;
	}


	/**
	 * Return the edit notification wizard
	 *
	 * @param \DataContainer
	 *
	 * @return string
	 */
	public function editNotification(\DataContainer $dc)
	{
		return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=nc_notifications&table=tl_nc_message&amp;id=' . $dc->value . '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="' . sprintf(specialchars($GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'][1]), $dc->value) . '" style="padding-left:3px" onclick="Backend.openModalIframe({\'width\':768,\'title\':\'' . specialchars(str_replace("'", "\\'", sprintf($GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'][1], $dc->value))) . '\',\'url\':this.href});return false">' . \Image::getHtml('alias.gif', $GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'][0], 'style="vertical-align:top"') . '</a>';
	}
	
	
	/**
	 * Delete an according BirthdayMailer configuration if the member group is deleted.
	 *
	 * @param \DataContainer $dc
	 */
	public function deleteConfiguration(\DataContainer $dc)
	{
		/** @var BirthdayMailer|\Contao\Model $objBirthdayMailer */
		/** @noinspection PhpUndefinedMethodInspection */
		$objBirthdayMailer = BirthdayMailer::findBy('memberGroup', $dc->id);
		$objBirthdayMailer->delete();
	}
}