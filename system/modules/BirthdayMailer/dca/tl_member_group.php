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
 * Table tl_member_group
 */
// Config
$GLOBALS['TL_DCA']['tl_member_group']['config']['ondelete_callback'][] = array('BirthdayMailer\Helper\Dca', 'deleteConfiguration');
