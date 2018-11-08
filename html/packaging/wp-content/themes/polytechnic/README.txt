This theme is built using the MDNW/CORE method. 

MDNW/CORE has been developed by Brandon Jones, with the sole purpose of creating an efficient method of publishing themes with a streamlined development process. It has been created with a profound respect for WordPress as a platform and a community. MDNW/CORE strives to adhere to best practices, while simultaneously extending theme functionality beyond what vanilla WordPress offers... MDNW/CORE acknowledges that this is inherintly oxymoronic, but that it will do it's best to marry the two edges of "standards" and "new features" responsibly. MDNW/CORE has been built to be rebuilt - with the ultimate goal that the continual rebuilding process will be natural and free-flowing.

MDNW/CORE is not a framework. It is a set of WordPress theme files that are organized with the following goals:
	A: Maintain the highest possible WP Standards.
	B: Expedite the theme-production process.
	C: Build in "extended theme functionality" through custom functions and plugins.
	D: Make long-term code-maintenance as simple as possible.

MDNW/CORE GOALS:
	We strive for a simplified workflow using a "less is more" approach to theme options and customization features. 
	A successful theme is:
		1. Easy to install and setup.
		2. Easy to publish content.
		3. Easy to customize it's appearance.
		4. Has the least amount of "theme options" possible to accomplish 1, 2, and 3.
		5. Doesn't break when WP releases updates.
		6. Doesn't require frequent updates for critical bug-fixes.
		7. Doesn't require advanced code knowledge for reasonable use.
		8. Doesn't require "memorizing" the theme documentation.
		9. Doesn't require a full-time support staff to answer customer questions.
		10. Loads fast on the front and backend.
		11. Scores reasonably high scores on "site speed" tests.
	
MDNW/CORE FEATURES & GUIDELINES:
	* Supports all native WP features.
	* Theme design that is centered around native WP content, not eccentric or overly custom plugin-driven content.
	* A Theme Options panel that allows users to make theme-specific decisions without complication or redundancy.
		* Post & Page Options that allow users to override "Theme Options" when applicable on individual posts.
	* A Theme Customizer that allows for "live" theme skin edits (color, fonts, etc.) using the WP Theme Customizer API.
	* A Drag and Drop editor that allows for quickly building layouts with rich web content into pages & posts.
	* The ability to take any theme-included-plugins (and content) with you after you switch to another theme.
	* The ability to switch to another theme without destroying/losing any of your site content.
	* The ability to quickly replicate the theme marketing demo by auto-importing the theme-options and content.
	* Fully Optional Plugins. The theme can be used without ANY plugins, even if we recommend them and even if the theme-demo uses them extensively.

	ON CUSTOM FUNCTIONALITY AND PLUGINS:
		Custom functions are only used when they are tied into to the theme's template files.
			* IE: Custom post navigation, custom search features, breadcrumbs, etc.
			* In short, they extend the ability that WP inherintly has to pull existing content from the database and into the frontend.
		Custom plugins are used when it adds custom content.
			* IE: Sliders, ShortCode Content Builders, "Flavor of the Day" features, etc.
			* In short, they bring in new features that are not specific to any one theme.

MDNW/CORE STRUCTURE:
	A MDNW/CORE theme consists of two sections:
		Section 1: The "Core" set of files (found in the /functions/mdnw-core/ folder). 
			* This includes functions, scripts, and styles that can be reasonably expected to be required in all themes.
			* When the "MDNW/CORE" version is updated, the entire folder can be updated without comprimising past theme versions.
			* All filenames (other than images) are prefixed with "mdnw" or "mdnw-core".
		Section 2: The "theme" files (everything that's not inside /functions/mdnw-core/)
			* This includes functions, scripts, stylesheets, and templates that are likely to change from one theme to the next.
			* "Theme" files are unique to each theme, but they contain similar markup, syntax, and organization.

	We highly recommend using a "minification" plugin with this theme for the purpose of condensing/combining the various CSS/JS files.
	BWP Minify and W3 Total Cache are excellent plugins that will accomplish this.

THIRD PARTY PLUGINS:
	This theme provides baseline support for the most popular third party WP plugins by adhering to strict WP-recommended theme standards.
	Using most plugins will not break a MDNW/CORE theme.

	If a plugin does break the theme's layout, please report it using the support link below so we can check it out. This doesn't mean we can fix it, of course, but we'll take a look whether or not we respond to the bug report.

	This theme does NOT provide full skins or other extended/native theme support for all plugins (unless explicitly stated in the theme features).

SUPPORT & DISCLAIMERS
	This theme is sold and/or distributed AS-IS. We do not provide any support for this theme, including theme-setup, theme-customizations, help with plugins, or anything else related to theme-implementation. 

	We do encourage users to report bugs though! Please report bugs to: http://makedesign.ticksy.com

	Our focus is on providing theme-updates over time that (a) elimate bugs, (b) improve speed and stability and, (c) extend theme functionality.