# cookienotice-ojs-plugin

A minimal, vanilla JS (ES6+) cookie notification plugin for [OJS](https://github.com/pkp/ojs)
for use on [Publicera](https://publicera.kb.se), an OJS portal hosted by the National Library of Sweden.

Installation
------------
* Download and extract the latest release from the [releases section](https://github.com/Kungbib/cookienotice-ojs-plugin/releases).

* Place the `cookieNotice` directory in your OJS installation's `plugins/generic` directory, or use "Upload A New Plugin" from within the OJS admin interface, if you don't have direct access to the server.

* Make sure the plugin is enabled under Administration -> Site Settings -> Plugins (under "Generic Plugins").

Note that this is a site-wide plugin. It can only be activated/deactivated on site level.

It simply loads a tiny bit of JS that checks whether the cookie `cookieNotice` has been set. If not,
it injects some HTML with cookie information and a button. If the button is clicked, the cookie is set
and the cookie information disappears.

If you find that the cookie notice is only shown on the main site and not on individual journals, `cd`
to the OJS root directory and run:

  php lib/pkp/tools/installPluginVersion.php plugins/generic/cookieNotice/version.xm

Creating a new release
----------------------
Bump the plugin version in `cookieNotice/version.xml`.

Merge develop into master.

In the root directory (cookienotice-ojs-plugin), create a tar file with the latest code:
```
tar czf cookieNotice.tar.gz --directory=$(pwd) cookieNotice/
```
Create a new GitHub release, tag the new version (`v.<M>.<m>.<p>`) and attach `cookieNotice.tar.gz`. 
