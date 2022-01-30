# PHP Mortality Index UK
20th Century UK mortality index. Displays number of deaths by age and gender from selected cause and year in an easy to read and find format

**A work in progress**

A server with access to one directory above the public folder is required to install and use this script. Upload the contents of httpd.www to your public folder, upload httpd.private to one directory above your public directory. Your public directory may be named something other than **httpd.www**. It may, for instance, be called **public** or your username. If this is the case you must open httpd.private/system/bootstrap.php and change the two instances of **httpd.www** on line 12 to the name of your public directory. Do the same for **httpd.private** on line 15 to whatever your private directory is called.

The app runs on SQLite so there's no need for any database installation.

There currently isn't a CMS associated with the app so all modifications need to be done manually.

**Features**

- auto update of content from select to display
- complete list of all documented causes of death in the 20th century
- easy to read format separating genders and ages

**Known issues**
Even though 21st century years show in the select, the databases are incomplete and needs to be updated with icd10 classifications

**Languages used**

PHP, HTML, Javascript, CSS

**Framework**

ozboware PHP MVCF 1.4.0

**Screenshots**
![home screen](https://user-images.githubusercontent.com/95859352/151687875-55fe379d-fbf6-475d-aef5-3a4c3942b911.png)
![demo](https://user-images.githubusercontent.com/95859352/151687876-73ded058-3ff0-406d-87d8-912d5c3eb4b1.png)
![demo 2](https://user-images.githubusercontent.com/95859352/151687907-ce515f49-55dd-42e4-887b-300e386eec92.png)

