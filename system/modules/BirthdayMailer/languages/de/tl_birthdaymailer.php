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
$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup']     = array('Mitgliedergruppe', 'Bitte wählen Sie die Mitgliedergruppe aus, die automatische Geburtstagsemails erhalten soll.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['nc_notification'] = array('Benachrichtigung', 'Bitte wählen Sie eine Benachrichtigung aus.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['disable']         = array('Deaktivieren', 'Die Konfiguration vorübergehend deaktivieren.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['config_legend']  = 'Konfiguration';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['disable_legend'] = 'Deaktivierung';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail']  = array('Manuelle Ausführung', 'Senden der Geburtstagsmails manuell ausführen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['new']               = array('Neue Konfiguration', 'Eine neue Konfiguration für Geburtstagsmails anlegen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['show']              = array('Konfigurationsdetails', 'Details der Konfiguration ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit']              = array('Konfiguration bearbeiten', 'Konfiguration ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy']              = array('Konfiguration duplizieren', 'Konfiguration ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['cut']               = array('Konfiguration verschieben', 'Konfiguration ID %s verschieben');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete']            = array('Konfiguration löschen', 'Konfiguration ID %s löschen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['toggle']            = array('Konfiguration veröffentlichen/unveröffentlichen', 'Konfiguration ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteafter']        = array('Danach einfügen', 'Nach der Konfiguration ID %s einfügen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteinto']         = array('Am Anfang einfügen', 'Am Anfang einfügen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit_notification'] = array('Benachrichtigung bearbeiten', 'Die Benachrichtigung ID %s bearbeiten');

/**
 * Misc texts
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['root_label']     = 'Geburtstagsmailer Konfigurationen';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['group_enabled']  = 'Aktive Mitgliedergruppe';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['group_disabled'] = 'Deaktivierte Mitgliedergruppe';

/**
 * Manual execution messages
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['headline']          = "Manuelle Ausführung";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['sendingHeadline']   = "Systemnachrichten";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['successMessage']    = "%s E-Mails wurden erfolgreich versendet.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureMessage']    = "%s E-Mails konnten wegen Fehler nicht gesendet werden.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureTableHead']  = "Fehler";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['failureInfo']       = "Bitte prüfen Sie das Contao <b>System-Log</b> oder die Log-Dateien (<i>birthdaymails.log</i>, <i>error.log</i>) um weitere Informationen zu den Fehlern zu erhalten.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionMessage']   = "%s E-Mails konnten wegen Abbrüchen (durch Hooks) nicht gesendet werden.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionTableHead'] = "Abbrüche";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['abortionInfo']      = "Bitte prüfen Sie das Contao <b>System-Log</b> um weitere Informationen zu den Abbrüchen zu erhalten.";
$GLOBALS['TL_LANG']['tl_birthdaymailer']['manualExecution']['developerMessage']  = "Sie befinden sich im Entwicklermodus. Alle E-Mails werden an die folgende Entwickler E-Mail-Adresse gesendet: <i>%s</i>. Bitte stellen Sie sicher, dass dies eine gültige E-Mail-Adresse ist. Änderungen können in den <b>Einstellungen</b> vorgenommen werden.";
