# ProcessDateArchiver

## ProcessWire Date Archiver Process

Automatically archives pages based on a Datetime field (e.g. /news/2013/01/03/some-news-item/).

### Behavior

- When you add a page with a specified template, the module will automatically create year/month/day archives for it.
- When you change the date in a specified Datetime field, the page is automatically moved to the correct year/month/day archive.
- When moving or trashing a page, the module will automatically clean up empty year, month and day archives.

### How to create an archiving rule

1. Go to the _Setup_ -> _Date Archiver_ screen in the ProcessWire admin.
2. Click on _Add New Archiving Rule_.
3. Specify the template that should be archived (typically the news-item template).
4. Specify the Datetime field that should be used to determine the date to archive by.
5. Specify the template that should be used for creating year archives.
6. Optionally specify the template that should be used for creating month archives.
7. Optionally specify the template that should be used for creating day archives.
8. Click _Add Rule_.

### Tips and tricks

- Configure the archive templates that will contain other archives to sort its children by name.
- Configure the archive template that will contain the news items to sort its children by the specified Datetime field.
- You will improve usability if you dont allow the user to create date archives manually.

### How to Install

1. Install the module by placing `ProcessDateArchiver.module` in `/site/modules/`.
2. Check for new modules on the _Modules_ screen in the ProcessWire admin.
3. Click _Install_ for the Date Archiver Process.

---

Copyright 2013 by Niek Bosch