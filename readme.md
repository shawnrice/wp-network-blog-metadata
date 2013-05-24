# Network Blog Metadata
We need a new name.

## Purpose of the plugin
This plugin will collect and store metadata about blogs on a network install of Wordpress

#### Todo
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
* Write SQL for a sharded database
* Network Admin Menu to list the questions that are active
* Add in development comments
* Hook into WP Blog registration form
* Convert admin menu form submission to an ajax callback function (_is this necessary?_)
* Standardize classes and values (use of hyphens and underscores, match to table column names)
* Test to make sure there are no conflicts with BuddyPress
* Test for cross-browser compatibility
* Finish writing roadmap

#### Table design and implementation
The current table is designed to include many questions that are in the draft document. Most of the columns are not used.

#### Limitations
The limitations here can be considered a roadmap for versions past the initial internal release. All of these issues must have at least some development done on them before releasing this plugin into the wild.

* Currently, the SQL table schema is hardcoded for B@B solely.
* There is no admin interface to customize questions

--

### Roadmap

The following features will be created for v2.0, which will be abstracted so that the 

* Allow for the dynamic creation of questions
* Create a way to make reports... (how? -- should these be add-ons?)
* Create config settings to display certain reports (how? -- again, add-ons?)
* Convert from procedural code to a class
* Integrate graphs reports with either...
	* Highcharts (http://www.highcharts.com/products/highcharts)
	* Google Charts (https://developers.google.com/chart/)
	* gRaphael (http://g.raphaeljs.com/)
	* Flotcharts (http://www.flotcharts.org/)

# Database

* Perhaps there should be an auto-detected option to see if the database is sharded and automatically use appropriate sql statements.
