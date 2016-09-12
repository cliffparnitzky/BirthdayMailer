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


$GLOBALS['TL_LANG']['tl_settings']['birthdayMailer_legend']                 = "Geburtstagsmailer";
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerAllowDuplicates']         = array('Duplikate erlauben', 'Wenn diese Option gewählt ist, werden Geburtstagsmails an ein und dasselbe Mitglieder mit mehreren konfigurierten Mitgliedergruppen mehrfach gesendet (das Mitglieder bekommt dann mehrere Geburtstagsmails).');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerLogDebugInfo']            = array('Zusätzliche Debug Informationen loggen', 'Wenn diese Option gewählt ist, werden zusätzliche Debug Informationen im System-Log eingetragen (pro E-Mail die versendet werden soll ein Eintrag mit allen Inhalten).');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperMode']           = array('Entwicklermodus', 'Aktiviert den Entwicklermodus. Emails gehen nur an die Entwickler E-Mail-Adresse.');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeEmail']      = array('Entwickler E-Mail-Adresse', 'Im Entwicklermodus werden alle E-Mails an diese Adresse umgeleitet.');
$GLOBALS['TL_LANG']['tl_settings']['birthdayMailerDeveloperModeIgnoreDate'] = array('Geburtsdatum im Entwicklermodus ignorieren', 'Umgeht im Entwicklermodus die Prüfung ob ein Mitglied am aktuellen Tag Geburtstag hat. Es wird für jedes aktive Mitglied eine Email gesendet.');
