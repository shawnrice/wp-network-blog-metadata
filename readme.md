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
* Standardize classes and values (use of hyphens and underscores, match to table column names)
* ~~Save form to table~~
* ~~Retrieve form values from table if already submitted~~
* Network Admin Menu to list the questions that are active
* Network Admin Menu has option to populate the table with null values for existing blogs
* Hook into WP Blog registration form
* Fix UI in the menu so that questions don't jump around in such an ugly way when changing selections
* Add in development comments
* Convert admin menu form submission to an ajax callback function

#### Table design and implementation
The current table is designed to include many questions that are in the draft document. Most of the columns are not used.

#### Limitations
The limitations here can be considered a roadmap for versions past the initial internal release. All of these issues must have at least some development done on them before releasing this plugin into the wild.

* Currently, the SQL table schema is hardcoded for B@B solely.
* There is no admin interface to customize questions
* There is no way to generate reports on the data collected