Given a PageArray of pages, this module will render an iCalendar feed from them. 
This is intended to be used directly from a template file. See usage below.

The module uses the excellent iCalcreator library from http://www.kigkonsult.se/iCalcreator/
for creating the ICS feed itself and as such mostly just acts as a simple wrapper.

Usage
-----

	$ics = $modules->get("MarkupiCalendar"); 
	$ics->title = "Upcoming Events";
	$ics->description = "Some upcoming events";
	$ics->itemStartDateField = 'date';
	$today = time();
	$items = $pages->find("template=event, limit=30, sort=date, date>$today");
	$ics->render($items); 

Runtime options
---------------

	'title' => 'Untitled iCal Feed',
	'url' => '', 
	'description' => '', 
	'itemSummaryField' => 'title',
	'itemDescriptionField' => 'summary',
	'itemLocationField' => false,
	'itemStartDateField' => 'created',
	'itemEndDateField' => false,
	'feedPages' => array(),
	'timezone' => false

Copyright (C) 2011 by Stephen Tomlinson  
This module is licensed under Apache License v2.0, see LICENSE.TXT within the module folder.  
The iCalcreator library is copyright (c) 2007-2011 Kjell-Inge Gustafsson and licensed under the LPGL.

http://twitter.com/ffub  
http://www.processwire.com  
