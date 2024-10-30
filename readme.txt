=== Micro Contact Form ===
Contributors: dalesandro
Tags: contact, form, email, lightweight, simple
Requires at least: 4.7
Tested up to: 6.6
Requires PHP: 5.1
Stable tag: 1.0.4
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Contact form plugin requiring only basic data entry (message subject, message content, from name, and return e-mail address) to send a brief message to the blog administrator's e-mail address.

== Description ==
There are many contact form plugins available for WordPress. These plugins tend to be highly configurable in order to produce complex forms. They typically require substantial effort to configure even for the simplest contact form. These plugins cater to a large user base with infinite data collection needs.

This is the opposite of those plugins.

The **Micro Contact Form** plugin for WordPress is a lightweight and simple contact form plugin that requires no configuration and produces a four-field form allowing a user to submit a message to the blog administrator directly through the website. The form only collects the most basic information needed for a message. When the form is submitted, the information is e-mailed through the website to the blog administrator's e-mail address.

Simply add the shortcode **[micro_contact_form]** to a new or existing page or post. The contact form is displayed on the page or post and any message submissions are sent to the blog administrator's e-mail address as specified in the WordPress site settings. The look and feel of the contact form can be adjusted by adding custom CSS styles to your theme.

The **Micro Contact Form** plugin works well as a way for your readers to connect with you without providing your own e-mail address directly on the site.

Features include:

* No configuration required.
* E-mails are sent using wp-mail (SMTP); compatible with other SMTP bypass plugins.
* No database tables are created by the plugin.
* Compatible with the **Analytical Spam Filter** plugin to block spam messages.

Micro Contact Form collects:

* Message subject
* Message content
* From Name
* Return e-mail address

Options include:
* Change the displayed labels for the name, e-mail, subject and message fields as well as the submit button.
* Change the required field indicator.
* Change the e-mail address receiving the form submissions.
* Add information to the form submission subject.

== Installation ==
1. Install Micro Contact Form through the WordPress.org plugin repository or by uploading the .zip file using the Admin -> Plugins -> Add New function.
2. Activate Micro Contact Form on the Admin -> Plugins screen.

Uninstall
1. Deactivate the plugin on the Admin -> Plugins screen. All plugin files will be retained.
2. Delete the plugin on the Admin -> Plugins screen. This deletes both the plugin files and all plugin settings stored in the database.

== Frequently Asked Questions ==
= Messages are not sent =

The plugin uses the WordPress wp_mail function. Please verify that all WordPress settings, SMTP plugin settings, and the server / host settings are correct and functioning as expected.

= Messages are sent but not received =

If you have verified that the message was actually sent, then verify that the WordPress administrator e-mail address is correct and able to receive other e-mails. Verify that the e-mail was not flagged as spam and routed to the spam or junk mail folders for that e-mail address.

= The contact form is not displaying =

Verify that the correct shortcode is used in a Shortcode block: **[micro_contact_form]**

== Screenshots ==
1. Micro Contact Form - Generated form.
2. Micro Contact Form - Shortcode block.
3. Micro Contact Form - General Settings.

== Changelog ==
= 1.0.4 =
* Minor Bug fixes: Corrects a compatibility issue with the Analytical Spam Filter plugin when the shortcode is used in a widget and simplifies the use of the default plugin stylesheet.

= 1.0.3 =
* Minor Bug fixes (corrects compatibility issue with the Analytical Spam Filter plugin)

= 1.0.2 =
* Minor Bug fixes (corrects function visibility)

= 1.0.1 =
* Bug fixes (resolves warning about null post_content)

= 1.0.0 =
* Initial Release