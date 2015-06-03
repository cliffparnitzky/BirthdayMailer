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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['memberGroup']       = array('Mitgliedergruppe', 'Bitte wählen Sie die Mitgliedergruppe aus, die automatische Geburtstagsemails erhalten soll.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sender']            = array('Absenderadresse', 'Bitte geben Sie die E-Mail-Adresse für den Absender ein.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['senderName']        = array('Absendername', 'Bitte geben Sie einen individuellen Namen für den Absender ein.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailCopy']          = array('Kopie an (CC)', 'Bitte geben Sie eine Liste kommagetrennter E-Mail-Adressen an, die eine Kopie der Geburtstagsemail erhalten sollen.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailBlindCopy']     = array('Blindkopie an (BCC)', 'Bitte geben Sie eine Liste kommagetrennter E-Mail-Adressen an, die eine Blindkopie der Geburtstagsemail erhalten sollen.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailUseCustomText'] = array('Eigene E-Mail Texte verwenden', 'Bitte geben Sie ob statt der Standardinhalte (<i>Anrede, Betreff, HTML, Text</i>) in der E-Mail eigene Texte verwendet werden sollen.');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['mailTextKey']       = array('Schlüssel für eigene E-Mail Texte', 'Bitte geben Sie den Schlüssel für die eigenen E-Mail Texte. Dieser wird benötigt um die eigenen Texte zu ermitteln.<br/><br/>Beispiel (Eintrag in <i>system/config/langconfig.php</i>):<br/><code>$GLOBALS[\'TL_LANG\'][\'BirthdayMailer\'][\'mail\'][\'<b>MEIN_SCHLUESSEL</b>\'][\'subject\'][\'en\'] = \'English Custom Subject\'; </code>');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['config_legend'] = 'Konfiguration';
$GLOBALS['TL_LANG']['tl_birthdaymailer']['email_legend']  = 'Emaileinstellungen';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['sendBirthdayMail'] = array('Manuelle Ausführung', 'Senden der Geburtstagsmails manuell ausführen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['new']              = array('Neue Konfiguration', 'Eine neue Konfiguration für Geburtstagsmails anlegen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['show']             = array('Konfigurationsdetails', 'Details der Konfiguration ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['edit']             = array('Konfiguration bearbeiten', 'Konfiguration ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['copy']             = array('Konfiguration duplizieren', 'Konfiguration ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['cut']              = array('Konfiguration verschieben', 'Konfiguration ID %s verschieben');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['delete']           = array('Konfiguration löschen', 'Konfiguration ID %s löschen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteafter']       = array('Danach einfügen', 'Nach der Konfiguration ID %s einfügen');
$GLOBALS['TL_LANG']['tl_birthdaymailer']['pasteinto']        = array('Am Anfang einfügen', 'Am Anfang einfügen');

/**
 * Misc texts
 */
$GLOBALS['TL_LANG']['tl_birthdaymailer']['root_label'] = 'Geburtstagsmailer Konfigurationen';

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

?>