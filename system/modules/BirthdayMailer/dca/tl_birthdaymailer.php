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
 * Table tl_birthdaymailer
 */
$GLOBALS['TL_DCA']['tl_birthdaymailer'] = array
(

	// Config
	'config'   => array
	(
		'dataContainer'    => 'Table',
		'enableVersioning' => true,
		'label'            => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['root_label'],
		'sql'              => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		),
	),

	// List
	'list'     => array
	(
		'sorting'           => array(
			'mode'                  => 5,
			'fields'                => array('sorting'),
			'flag'                  => 11,
			'panelLayout'           => 'filter,limit',
			'paste_button_callback' => array('BirthdayMailer\Helper\Dca', 'pasteConfig'),
			'icon'                  => 'system/modules/BirthdayMailer/assets/icon_root.png',
		),
		'label'             => array
		(
			'fields'         => array('memberGroup:tl_member_group.name'),
			'format'         => '%s',
			'label_callback' => array('BirthdayMailer\Helper\Dca', 'addIcon')
		),
		'global_operations' => array
		(
			'sendBirthdayMail' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail'],
				'href'       => 'key=sendBirthdayMail',
				'attributes' => 'onclick="Backend.getScrollOffset();" style="background: url(\'system/modules/BirthdayMailer/assets/icon_execute.png\') no-repeat scroll left center transparent; margin-left: 15px; padding: 2px 0 3px 20px;"'
			),
			'all'              => array
			(
				'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'       => 'act=select',
				'class'      => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations'        => array
		(
			'edit'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit'],
				'href'  => 'act=edit',
				'icon'  => 'edit.gif'
			),
			'copy'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy'],
				'href'  => 'act=copy',
				'icon'  => 'copy.gif'
			),
			'cut'    => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['cut'],
				'href'       => 'act=paste&amp;mode=cut',
				'icon'       => 'cut.gif',
				'attributes' => 'onclick="Backend.getScrollOffset()"',
			),
			'delete' => array
			(
				'label'      => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete'],
				'href'       => 'act=delete',
				'icon'       => 'delete.gif',
				'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'                => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['toggle'],
				'attributes'           => 'onclick="Backend.getScrollOffset();"',
				'haste_ajax_operation' => array(
					'field'   => 'disable',
					'options' => array(
						array(
							'value' => '1',
							'icon'  => 'invisible.gif'
						),
						array(
							'value' => '',
							'icon'  => 'visible.gif'
						)
					)
				)
			),
			'show'   => array
			(
				'label' => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['show'],
				'href'  => 'act=show',
				'icon'  => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default' => '{config_legend},memberGroup,nc_notification;{disable_legend},disable'
	),

	// Fields
	'fields'   => array
	(
		'id'              => array
		(
			'sql' => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid'             => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),
		'sorting'         => array
		(
			'label'   => &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting' => true,
			'flag'    => 11,
			'sql'     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp'          => array
		(
			'sql' => "int(10) unsigned NOT NULL default '0'"
		),
		'memberGroup'     => array
		(
			'label'      => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup'],
			'exclude'    => true,
			'inputType'  => 'select',
			'foreignKey' => 'tl_member_group.name',
			'filter'     => true,
			'eval'       => array
			(
				'mandatory'          => true,
				'unique'             => true,
				'includeBlankOption' => true,
				'tl_class'           => 'w50',
				'chosen'             => true
			),
			'sql'        => "int(10) unsigned NOT NULL default '0'",
			'relation'   => array
			(
				'type' => 'hasOne',
				'load' => 'eager'
			)
		),
		'nc_notification' => array
		(
			'label'            => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['nc_notification'],
			'exclude'          => true,
			'inputType'        => 'select',
			'foreignKey'       => 'tl_nc_notification.title',
			'filter'           => true,
			'options_callback' => array('BirthdayMailer\Helper\Dca', 'getNotificationChoices'),
			'eval'             => array
			(
				'mandatory'          => true,
				'unique'             => true,
				'includeBlankOption' => true,
				'tl_class'           => 'w50',
				'chosen'             => true,
				'submitOnChange'     => true
			),
			'wizard'           => array(array('BirthdayMailer\Helper\Dca', 'editNotification')),
			'sql'              => "int(10) unsigned NOT NULL default '0'",
			'relation'         => array('type' => 'hasOne', 'load' => 'eager')
		),
		'disable'         => array
		(
			'label'     => &$GLOBALS['TL_LANG']['tl_birthdaymailer']['disable'],
			'exclude'   => true,
			'filter'    => true,
			'inputType' => 'checkbox',
			'sql'       => "char(1) NOT NULL default ''"
		)
	)
);
