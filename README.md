[![Latest Version on Packagist](http://img.shields.io/packagist/v/cliffparnitzky/birthday-mailer.svg?style=flat)](https://packagist.org/packages/cliffparnitzky/birthday-mailer)
[![Installations via composer per month](http://img.shields.io/packagist/dm/cliffparnitzky/birthday-mailer.svg?style=flat)](https://packagist.org/packages/cliffparnitzky/birthday-mailer)
[![Installations via composer total](http://img.shields.io/packagist/dt/cliffparnitzky/birthday-mailer.svg?style=flat)](https://packagist.org/packages/cliffparnitzky/birthday-mailer)

Contao Extension: BirthdayMailer
================================

Sends a birthday email to all the members having their birthday on the current day.


Installation
------------

Install the extension via composer: [cliffparnitzky/birthday-mailer](https://packagist.org/packages/cliffparnitzky/birthday-mailer).

If you prefer to install it manually, download the latest release here: https://github.com/cliffparnitzky/BirthdayMailer/releases


Tracker
-------

https://github.com/cliffparnitzky/BirthdayMailer/issues


Compatibility
-------------

- min. Contao version: >= 3.2.0
- max. Contao version: <  3.6.0


Dependency
----------

- This extension is dependent on the following extensions: [[contao-legacy/associategroups]](https://legacy-packages-via.contao-community-alliance.org/packages/contao-legacy/associategroups)


Inserttags
----------

    {{birthdaychild::*}} ... This tag returns all the values of the current member (replace * with any attribute of the member, e.g. firstname or company, the attribute password is not allowed).
    {{birthdaychild::salutation}} ... This tag returns the salutation of the member (depending on gender).
    {{birthdaychild::name}} ... This tag returns first and last name of the member.
    {{birthdaychild::groupname}} ... This tag returns the name of the member group of the current configuration.
    {{birthdaychild::age}} ... This tag returns the age of the member.
    {{birthdaymailer::email}} ... This tag returns the e-mail the configured sender.
    {{birthdaymailer::name}} ... This tag returns the name of the configured sender.

Hooks
-----

### birthdayMailerAbortSendMail

The "birthdayMailerAbortSendMail" hook is triggered for for checking if a birthday mail should be send. So custom checking for each birthday child is possible.
It passes `$birthdayChildConfig` (the config of the current birthday child) and `$blnAbortSendMail` (the current value, if sending should be aborted).
It expects a boolean return value.

```
// config.php

$GLOBALS['TL_HOOKS']['birthdayMailerAbortSendMail'][]   = array('MyClass', 'myAbortSendMail');

// MyClass.php

class MyClass
{
	public function myAbortSendMail($birthdayChildConfig, $blnAbortSendMail)
	{
		if ($blnAbortSendMail !== TRUE && $birthdayChildConfig->id == 1)
		{
			$blnAbortSendMail = true;
			$this->log('SEnding birthday mail to member with id "1" was aborted.', 'MyClass myAbortSendMail()', TL_INFO);
		}
		return $blnAbortSendMail;
	}
}
```