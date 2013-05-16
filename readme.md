# Network Blog Metadata
We need a new name.

## Purpose of the plugin
This plugin will collect and store metadata about blogs on a network install of Wordpress

#### Features for this version
* Network Admin Menu to list the questions that are active.
* Network Admin Menu has option to populate the table with null values for existing blogs
* ~~Admin Menu to answer questions~~
* Hook into WP Blog registration form

#### Todo
* ~~jQuery to hide fields dependent on selections~~
* ~~jQuery to clear fields dependent on selections~~
* ~~Minimal styling to place questions in two columns~~
* ~~Fix the use column to appear only after initial role selection~~
* Fix UI in the menu so that questions don't jump around in such an ugly way when changing selections
* Add in development comments

#### Table design and implementation
The current table is designed to include many questions that are in the draft document. Most of the columns are not used.

#### Limitations
The limitations here can be considered a roadmap for versions past the initial internal release. All of these issues must have at least some development done on them before releasing this plugin into the wild.

* Currently, the SQL table schema is hardcoded for B@B solely.
* There is no admin interface to customize questions
* There is no way to generate reports on the data collected