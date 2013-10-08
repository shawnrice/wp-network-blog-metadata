# Network Blog Metadata
Still a placeholder name for the plugin.

## Purpose of the plugin
This plugin will collect and store metadata about blogs on a network install of Wordpress, specifically a Buddypress installation.

## Status of the code
This code could now be considered legacy code in that it exists on [Blogs at Baruch](https://blsciblogs.baruch.cuny.edu), but it is slated to be re-written from the ground up in order to make it available for others to use. Development has already begun.

Consider this code to be the first stab at a project.

### Todo

* Doublecheck Install and uninstall hooks
* Convert code to be read by doxygen


### Done
(Well, I think these are done. Removed from the todo list).

* ~~Structure SQL table~~
* ~~Create out Admin Menu Form (with initial agreed upon questions)~~
* ~~jQuery to hide fields dependent on selections~~
* ~~jQuery to clear fields dependent on selections~~
* ~~Minimal styling to place questions in two columns~~
* ~~Fix the use column to appear only after initial role selection~~
* ~~Save form to table~~
* ~~Retrieve form values from table if already submitted~~
* ~~Network Admin Menu has option to populate the table with null values for existing blogs~~
* ~~Fix UI in the menu so that questions don't jump around in such an ugly way when changing selections~~
* ~~Add in development comments~~
* ~~Hook into WP Blog registration form~~
* ~~Standardize classes and values (use of hyphens and underscores, match to table column names)~~
* ~~Test to make sure there are no conflicts with BuddyPress~~
* ~~Create Network Admin Tableview~~
* ~~Validate user signup fields* Return errors on fields~~ (not necessary for B@B)
* ~~Re-populate after errors~~
* ~~Get actual data (list of departments, majors, etc...)~~
* ~~Separate Staff and Faculty "department"~~



#### Table design and implementation
The current table is designed to include many questions that are in the draft document. Most of the columns are not used.

#### Limitations
The limitations here can be considered a roadmap for versions past the initial internal release. All of these issues must have at least some development done on them before releasing this plugin into the wild.

* Currently, the SQL table schema is hardcoded for B@B solely.
* There is no admin interface to customize questions

--

### Roadmap

The following features will be created for v2.0, which will be abstracted. The code will be developed either in another branch or in another repository. 

* Allow for the dynamic creation of questions
* Network Admin Menu to list the questions that are active
* Create a way to make reports... (how? -- should these be add-ons?)
* Create config settings to display certain reports (how? -- again, add-ons?)
* Refactor procedural to OOP
* Integrate graphs reports with either...
	* Highcharts (http://www.highcharts.com/products/highcharts)
	* Google Charts (https://developers.google.com/chart/)
	* gRaphael (http://g.raphaeljs.com/)
	* Flotcharts (http://www.flotcharts.org/)
