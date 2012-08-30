dzone
=====

The `index.php` looks through the issues folder for sub-folders (issues) and
orders the files by year and issue. The issue folder should be named according
to `Name_nr_XX_YYYY` where `Name` can be any string with words separated by
underscore, `XX` is a positive integer of any size, `YYYY` is the year of
publication. The latest issue will be viewed in the iframe of `index.php` by
default and can then be changed with a drop-down box listing all the available
issues.

Installation
------------

`index.php` can be placed anywhere but it has to have the following
filestructure:

    |- index.php
    |- issues/
    ||- Issue_nr_01_0001/
    |||- index.html
    |||- ...
    ||- Issue_nr_02_0001/
    |||- index.html
    |||- ...
    ||- ...
    |- (master.css)
    |- ...

`master.css` and all things related to styling should be changed in `index.php`.
