Contao Extension: BirthdayMailer
================================

Sends a birthday e-mail to all the members having their birtday on the current day.


Installation
------------

The extension can be installed using the Contao extension manager in the Contao
back end. If you prefer to install it manually, download the files here:

http://www.contao.org/en/extension-list/view/BirthdayMailer.html


Tracker
-------

https://github.com/cliffparnitzky/BirthdayMailer/issues


Compatibility
-------------

- min. version: Contao 2.9.5
- max. version: Contao 3.1.x


Dependency
----------

- This extension is dependent on the following extensions: [[associategroups]](http://contao.org/de/extension-list/view/associategroups.de.html), [[ExtendedEmailRegex]](http://contao.org/de/extension-list/view/ExtendedEmailRegex.de.html)


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