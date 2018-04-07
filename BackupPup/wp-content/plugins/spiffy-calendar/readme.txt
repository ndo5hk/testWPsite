=== Spiffy Calendar ===
Contributors: sunnythemes
Donate Link:  http://spiffycalendar.sunnythemes.com/bonus-add-ons/
Requires at least: 3.5
Tested up to: 4.8
Stable tag: trunk
License: GPLv2
Tags:  calendar,widget,image,event,events,upcoming,time,schedule,appointment,tickets,customizer

A full featured, simple to use Spiffy Calendar plugin for WordPress that allows you to manage and display your events and appointments.

== Description ==

A full featured, simple to use Spiffy Calendar plugin for WordPress that allows you to manage and display your events and appointments.

>[Demo and Documentation](http://spiffycalendar.sunnythemes.com)
>
>[Click here](http://spiffycalendar.sunnythemes.com/css-snippets/) for helpful CSS snippets.
>
>[Click here](http://spiffycalendar.sunnythemes.com/bonus-add-ons/) to learn about Bonus Add-Ons.

= Features =

*	Post/page displays include:
	* Standard monthly calendar grid 
	* Mini-calendar view for compact displays
	* Today's events list
	* Upcoming events list
*	Widgets include:
	* Featured event
	* Today's events list
	* Upcoming events list
	* Mini Calendar
*	Other features:
	* Displays may be filtered by category list
	* Mouse-over details for each event
	* Normal popup or expanded display of lists
	* Events can display their author (optional)
	* Add custom CSS styles or just use the defaults
	* Display upcoming events in your MailPoet newsletters
* 	Enter and display for each event:
	* title, 
	* description, 
	* event category, 
	* link, 
	* event start/end date
	* event start/end time
	* event recurrence details
	* event image
*	Schedule a wide variety of recurring events.
	* Events can repeat on a daily (set numbers of days), weekly, monthly (set numerical day), monthly (set textual day) or yearly basis
	* Repeats can occur indefinitely or a limited number of times
	* Events can span more than one day
*	Hide all events for specific days:
	* Hide repeating event for a single day such as a holiday
	* Hide full days of events that span more than one day
	* Substitute new title to replace hidden events
	* Select override based on category
*	Easy to use events manager in admin dashboard
	* Comprehensive options panel for admin
	* Optional drop down boxes to quickly change month and year
	* User groups other than admin can be permitted to manage events
	* Authors can be restricted to editing their own events only
	* Categories system can be switched on or off
	* Pop up JavaScript calendars help the choosing of dates
	* Events can be links pointing to a location of your choice
	
**BONUS FEATURES AVAILABLE WITH DONATION**

* Premium themes
* Live theme customizer
* ICS export
* CampTix integration

[Learn more about bonus add-ons](http://www.spiffycalendar.sunnythemes.com/bonus-add-ons/)
	
= Languages =

* Dutch (Courtesy Joek Brongers)
* French (Courtesy Mathieu Gaunet, www.mathieugaunet.com, contact@mathieugaunet.com)
* German (Courtesy Ingrid Maie)
* Polish (Courtesy of Krzysztof Kacprzyk)
* Spanish (Courtesy of Andrew Kurtis, WebHostingHub)
* Swedish (Courtesy of Kenneth Andersson)
* Turkish (Courtesy Dr Abdullah Manaz, www.manaz.net)

== Installation ==

1. Install the plugin from the Wordpress repository in the usual way.

2. Activate the plugin on your WordPress plugins page

3. Configure Calendar using the following pages in the admin panel:

   Spiffy Calendar -> Events

   Spiffy Calendar -> Categories

   Spiffy Calendar -> Options

4. Edit or create a page on your blog which includes one of the shortcodes:

[spiffy-calendar] for the monthly calendar

[spiffy-minical] for the mini version of the monthly calendar

[spiffy-upcoming-list] for the upcoming events list

[spiffy-todays-list] for the list of today's events

Add one of the spiffy widgets to your theme widget areas.

All of the shortcodes and widgets accept a comma separated list of category IDs, such as *cat_list='1,4'*. The category list must be a numeric list of the category number, not the category name.

The list shortcodes and widgets also accept an optional *limit* and *style* selection (Popup or Expanded). Popup is the default, classic style.

You can use the spiffy-upcoming-list expanded style shortcode in your MailPoet newsletter, with the following format (including arguments if needed):

[custom:spiffy-upcoming-list style="Expanded" ...]

>If you are upgrading from Version 2 you will need to re-add your widgets after upgrading to Version 3.
>
>It is recommended that you reset your calendar styles to the default. However, if you performed customization on your styles and don't wish to lose your customization, you should check that the calendar is still displaying as expected. Default styles are now always loaded; custom CSS will be appended to the default styles. This change will allow for proper future style updates.

== Frequently Asked Questions ==

= I just updated the plugin and get this error: "Error: The event could not be added to the database. This may indicate a problem with your database or the way in which it is configured." =

If you see this error, deactivate then re-activate the Spiffy Calendar plugin to attempt to correct the database.

== Screenshots ==

1. Full calendar with detailed display 

2. Calendar options

3. Widgets

4. Add an event

== Changelog ==

= Version 3.3.0 (June 2, 2017) =

* Fix: remove Reflected Cross Site Scripting vulnerability. Many thanks to Dimitrios Tsagkarakis for responsible disclosure.

= Version 3.2.0 (March 2, 2017) = 

* New: add option to allow description and image display in the mini-calendar popup window

= Version 3.1.5 (January 13, 2017) =

* New: add filter hook to description output
* Fix: reference to undefined variable when adding new event
* Additional output sanitizing

= Version 3.1.4 (December 1, 2016) =

* Update default styles to account for new Twenty Seventeen theme 
* Add version number to default.css to force reload
* Fix widget default titles when using the WP customizer

= Version 3.1.3 (September 20, 2016) =

* Improvement: default the event author on new events to the logged in user instead of first in list

= Version 3.1.2 (August 26, 2016) =

*  Allow admin to set author when creating a new event

= Version 3.1.1 (August 25, 2016) =

* Fix: author display name fix for WP versions lower than 4.5
* Clean up a couple of minor php notices
* Update .pot file

= Version 3.1.0 (August 23, 2016) =

* New: option to limit non-admin event managers to handling their own events only
* New: event managers with full admin privileges can modify the author of an event
* Improvement: Honour the user post reassignment selection (if available) on spiffy events when a user is deleted

= Version 3.0.8 (August 4, 2016) =

* Fix potential conflict of shortcode buttons with other plugins

= Version 3.0.7 (July 25, 2016) =

* Modify MailPoet support to insert inline styles
* Force expanded style in MailPoet newsletter

= Version 3.0.6 (June 29, 2016) =

* New: Support spiffy-upcoming-list in Mail Poet newsletters
* Fix: Avoid error message when DB table is empty
* Move plugin documentation to new domain

= Version 3.0.5 (January 27, 2016) =

* Improvement: Allow new lines in event description

= Version 3.0.4 (January 3, 2016) = 

* Fix: Default styles for detailed event display

= Version 3.0.3 (December 30, 2015) =

* Improvement: Replace local time function with WordPress standard function current_time
* Improvement: Simplify the year switcher build code
* Improvement: Add CSS rule to the defaults to help avoid conflicts with other plugins' CSS
* Improvement: Don't add admin bar shortcuts if the user has no permission to access the area

= Version 3.0.2 (November 20, 2015) =

* New: Apply category colour to expanded list event titles
* New: Test and tweak styles for WordPress 4.4 and Twenty Sixteen theme
* Improvement: add "weekend" class to calendar grid boxes
* Improvement: remove form padding in default CSS
* Improvement: remove 200px limitation of mini-calendar widget
* Improvement: use even faster query to check DB table 
* Fix: Fix problem with slashes being added to custom CSS quotes
* Fix: Add event after errors noted is now fixed

= Version 3.0.1 (November 13, 2015) =

* New: Screen option to set number of events displayed in the event manager list

= Version 3.0.0 (November 12, 2015) =

NOTE: **You will need to re-add your widgets after upgrading!**

NOTE: *It is recommended that you reset your calendar styles to the default.* However, if you performed customization on your styles and don't wish to lose your customization, you should check that the calendar is still displaying as expected. Default styles are now always loaded; custom CSS will be appended to the default styles. This change will allow for proper future style updates. [Click here](http://spiffycalendar.sunnythemes.com/css-snippets/) for helpful CSS snippets.

* New: Event admin list updated to WP format -- Now supports bulk event deletion, copying events, sorting the event list by category
* New: Widgets updated to use Widget API - you can now add multiple widgets
* New: "Limit" argument added to upcoming list and today's events lists (both shortcode and widgets)
* New: "Style" argument added to upcoming list and today's events lists (both shortcode and widgets)
* New: Featured event widget
* New: Updated styles and display classes (backwards compatible as much as possible)
* New: Category class added to main calendar display to allow CSS to target by category
* Fix: Provide a way to unlink an image from an event
* CHANGE: Default styles are now always loaded. Custom CSS will be added after the default styles, allowing for proper future style updates.
* Improvement: Removed options to enable/disable upcoming lists and today's events lists since they didn't really do anything
* Improvement: Rename "sept" link to "sep" for consistency
* Improvement: Use "prepare" instead of "esc_sql"
* Improvement: Fix image thumbnail display to use thumbnail size of image
* Improvement: When filtering by category, the category key will now only display the filtered categories

= Version 2.1.3 (October 10, 2015) =

* Better solution over version 2.1.2, uses table query to check DB structure and fixes automatically without using information schema query

= Version 2.1.2 (October 9, 2015) =

* Move database format check back to the activate function since DB information schema query causes some hosts to hang (in particular HostGator). 

= Version 2.1.1 (October 8, 2015) =

* Fix yearly recurring event display in upcoming lists, one more time. Thanks to tony_phillips for his help finding and diagnosing this issue.

= Version 2.1.0 =
* Fix: Fix monthly and yearly recurring events' display in upcoming lists
* New FEATURE: shortcode generator button in edit windows
* New FEATURE: update admin pages to match current WP dashboard style with tabs, add shortcuts to admin toolbar
* LANGUAGE SUPPORT: Updated .POT file
* LANGUAGE SUPPORT: German, courtesy Ingrid Maie

= Version 2.0.1 =

* Fix: Fix weekly recurring events with a specified number of repeats to display properly in their last month

= Version 2.0.0 =

* New FEATURE: Support custom days recurrence
* SECURITY: Run all input/output through WordPress sanitation functions
* SECURITY: Ensure category list is specified as numeric ids
* Improvement: Use WordPress Media uploader for event image specification
* Improvement: Deleting an event will no longer delete the associated image, it will remain in the Media Library
* Improvement: Use WordPress color picker for category color configuration
* Improvement: Add colgroup to display category key in smaller size in html5
* Improvement: Update default CSS to better fit long titles
* Improvement: Rewrite event query functions to reduce repetitive queries
* Fix: Fix problem when an event edit was rejected, the subsequent edit would create a new event

= Version 1.3.1 Stable =

* Replace occurrences of mysql_real_escape_string (deprecated on some servers) with esc_sql
* Remove the test for 30 characters when saving an event in the DB
* Polish translation courtesy of Krzysztof Kacprzyk 
* Swedish translation courtesy of Kenneth Andersson

= Version 1.3.0 =

* Rename "popup" div to "spiffy-popup" to avoid conflicts with other themes/plugins

**Warning: Version 1.3.0 renames the hover popup DIV used to show the event details. Please check your hovering after upgrading. If it is misbehaving and you have no CSS customizations, tick the box to restore the default CSS. If you have customized CSS, please add the following:**

	.calnk a:hover div.spiffy-popup { position:absolute; }
	
* Turkish translation (Courtesy Dr Abdullah Manaz, www.manaz.net)
* Dutch translation (Courtesy Joek Brongers)

= Version 1.2.1 =

* Encode more visible strings for translation
* French translation (Courtesy Mathieu Gaunet, www.mathieugaunet.com, contact@mathieugaunet.com)

= Version 1.2.0 =

* Override selected parts of recurring event without changing original event definition, courtesy of Douglas Forester. MAKE SURE YOU DEACTIVATE AND REACTIVATE THE PLUGIN. This will happen automatically if you use the WP updater, but if you just copy the files via FTP you must do this manually to ensure the database is updated.

= Version 1.1.8 =

* CSS improvements. The default CSS has been updated to work better with most themes.
* Additional language strings

= Version 1.1.7 =

* Add language support
* Spanish translation (Courtesy of Andrew Kurtis, WebHostingHub)

= Version 1.1.6 July 18, 2013 =

* Fix typo in event end time test

= Version 1.1.5 March 21, 2013 =

* Fix title and category selection on mini calendar widget

= Version 1.1.4 March 20, 2013 = 

* Fix change made in version 1.1.3 

= Version 1.1.3 March 18, 2013 =

* Add popup window closure for better functionality on touch devices

= Version 1.1.2 February 17, 2013 =

* Allow 3 digits for upcoming days configuration
* Fix minicalendar widget (has been missing since day 1)

= Version 1.1.1 February 7, 2013 =

* Fix default CSS to confine table styles to Spiffy Calendar tables

= Version 1.1.0 January 22, 2013 =

* New FEATURE: Provide option to open event links in new window
* Fix typo in minical html

= Version 1.0.3 January 15, 2013 =

* Fix end time on mini-calendar hover

= Version 1.0.2a December 17, 2012 =

* Make sure CSS file is recreated after plugin upgrade

= Version 1.0.1 November 2012 =

* Corrected missed removal of some options when plugin is deleted, and renamed to avoid conflicts

= Version 1.0.0 November 19, 2012 =

* Initial version

= Notes =

This plugin was derived from Calendar plugin version 1.3.1 by Kieran O'Shea

Reasons for creating a new version:

* Support images and event end times (customer request)
* Update to modern WP methods
* Wrap functions in class to avoid conflicts
* Use shortcodes
* Reduce database queries
* Clean up tables and options on uninstall

== Upgrade Notice ==

= 1.0.0 =

* Initial release