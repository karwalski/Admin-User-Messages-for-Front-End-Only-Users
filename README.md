# Admin-User-Messages-for-Front-End-Only-Users
=== Admin User Messages ===
Contributors: Zaunkoenig, Karwalski
Tags: admin, communication, email, inbox, mail, messenging, private messages, user
Requires at least: 3.4.1.
Tested up to: 4.1
License: GPL3
License URI: http://gplv3.fsf.org/
Depends: EWD_FEUP

Admin User Messages is a simple plugin that allows communication just between Admin and single users, but not a communication between user and user.

== Description ==
This was written with Front-End Users Plugin as a dependency, and tested with version 1.26 (http://www.etoilewebdesign.com/front-end-users-plugin/)

Instead of using the wordpress Blog Users, this modified version uses the Front-End User Plugin users, and a Level 10 user as admin.

With this plugin admins are able to communicate with their users. That is useful if you have a website where you don\'t want your users to talk with each other. Every term of the plugin is customizable, so you can translate it in your own language.

You will need to create some pages, to put following shortcodes in:

Inbox-Page: [admin_user_messages_inbox]

Sent-Messages-Page [admin_user_messages_sent_messages]

Write-Message-Page: [admin_user_messages_write_message]

Read-Message-Page [admin_user_read_message]

Answer-Message-Page [admin_user_answer_message]

Search-Page [admin_user_messages_search]

== Installation ==
1. Upload admin_user_messages to the /wp-content/plugins/ directory
2. Activate the plugin through the \'Plugins\' menu in WordPress.
3. Create Pages, like described in Description
3. Find the settings page \"Admin User Messages\" within the main settings section
4. Customize your plugin
5. Have fun!


== Frequently Asked Questions ==
Comming soon, when first FAQ are asked.

== Screenshots ==
1. Translate the plugin into your language
2. Write E-Mails to your users.
3. Receive E-Mails from your users

== Changelog ==
0.1.2 Now it is possible to edit the javascript alerts when missing receiver, subject and message

== Update Notice ==
0.1.3

== Update Notice ==
0.1.4 Secured function if another plugin uses same function, so it don't has to be redeclared

== Update Notice ==
0.1.5
- bugfix mysql error when someone calls sent messages and still no message is sent. See support forum read_message.php Error
- bugfix set dynamic term page on sent messages page. See support forum read_message.php Error

== Update Notice ==
0.1.6
Big update! Now it is possible to search within the messages. That is usefull if you have many messages. It is a full text search in the messages and their subjects.

== Update Notice ==
0.2.0
Modified to work only with Front End User plugin.
