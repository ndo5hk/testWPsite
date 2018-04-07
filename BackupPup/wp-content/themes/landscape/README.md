# Landscape WordPress Theme. 
Developed and designed by [Diverse Themes](https://diversethemes.com). [Release page](https://diversethemes.com/premium-themes/landscape/).

![Landscape Screenshot](https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Adams_The_Tetons_and_the_Snake_River.jpg/959px-Adams_The_Tetons_and_the_Snake_River.jpg)

# License and Credit

Landscape is a responsive, single column, WordPress theme for personal blogs and business sites.

Landscape,  like WordPress, is licensed under the GPL.

Font icons by [Automattic](http://automattic.com) are GPL licensed and can be found at [Genericons.com](http://genericons.com).

Social Logos by [Automattic](http://automattic.com) are GPL licensed and can be found at [Social Logos](https://github.com/Automattic/social-logos).

Header image by Ansel Adams and is licensed under the Public Domain:
https://en.wikipedia.org/wiki/File:Adams_The_Tetons_and_the_Snake_River.jpg

# Changelog
## 2.0.1
* Theme cleanup. 
* Make it easier for users to edit if you don't know Sass. 
* Simplify Grunt and Sass
* Remove Bower
* Better Infinite Scroll support via Jetpack

## 2.0
* Theme cleanup
* Move to using Sass
* Add social navigation
* Improve responsiveness. 

## 1.0 - 1.5
* Initial release


# Theme Installation

 - Log in to your WordPress Dashboard.
 - Select the Appearance panel, then Themes.
 - Select Add New.
 - Click the Upload Theme button.
 - Find the .zip file you downloaded
 - Install, then activate.

# Homepage Setup

Create a page called ```'Home'```. Choose ```'Homepage Template'``` as the page template. For your content, we recommend a single paragraph describing your site. Publish your new page that you created.

Create a page called ```'Blog'```. No content or page templates needed. Just the title and publish the page.

In your WordPress dashboard go to your ```Settings > Reading > Select 'Static Page'``` and choose your ```'Home'``` page as the Front page and choose your ```'Blog'``` page as your Posts page.

Then go to ```Appearance > Customize > Landscape Options```. From here you can choose your featured pages that display on the homepage. Be sure to save and publish your changes. The pages you choose to be featured supports featured images.


# Social Media Setup

To setup your social links menu. Log in to your WordPress Dashboard. Go to Appearance Menus Create a new menu Name it social Check 'Social' under theme location. Finally, add custom links to your menu. Be sure to click the 'Save Menu' button to save your menu.


# Need premium support?

Become a member today at [Diverse Themes](https://diversethemes.com/pricing).


# Editing Landscape

If you prefer not to use Grunt and Sass, you can ignore the instructions below and edit the style.css file directly. It is good practice to get into using Child themes to avoid any loss of customizations due to a theme update. To learn more about Child themes, visit the Codex:

https://codex.wordpress.org/Child_Themes

If you are planning on only making minor CSS changes, we recommend using the Jetpack plugin by WordPress.com and activate the Custom CSS Module. https://jetpack.com/support/custom-css/ You can download the Jetpack plugin here:

https://wordpress.org/plugins/jetpack/

# Pre-Installation Using Grunt and Sass

Basic knowledge of the command line and the following dependencies are recommended to edit Landscape:

- Node ([http://nodejs.org/](http://nodejs.org/))
- Ruby ([http://rubyinstaller.org/](http://rubyinstaller.org/))
- Grunt CLI ([http://gruntjs.com/](http://gruntjs.com/)) - `npm install -g grunt-cli`
- Sass ([http://sass-lang.com/](http://sass-lang.com/install)) - `gem install sass`

# Installation

## Manual Installation

##### 1) Navigate to the /themes folder of your project
`cd /your-project/wordpress/wp-content/themes`

##### 2) Install Grunt and Dependencies
- Run `npm install && bower install` from the command line to install Grunt.

Now you can begin using Grunt.

# Usage
After you've installed Landscape, and run `npm install` from the command line you can start using grunt.

## Grunt

##### 1) Navigate to your new theme
`cd /your-project/wordpress/wp-content/themes/your-new-theme`

##### 2) Grunt tasks available:

`grunt watch` - Automatically handle changes to stylesheet

`grunt styles` - Comb, compile, prefix, combine media queries

`grunt i18n` - Generate a translation file

`grunt` - Do it all once!
