## Html5mediator ##

**Html5mediator** is a simple extension for MediaWiki that defines a new tag (&lt;html5media&gt;) which can be used to embed HTML5 video and/or audio.  It is stable enough for production use, but has minimal extra features (*e.g.* defining video height and/or width) at this point in time.

### Obtaining ###
The latest version of Html5mediator (0.1 at the time of this writing) is always available at [github.com/lightbinder/Html5mediator](https://github.com/lightbinder/Html5mediator).

### Usage ###
1. Unzip `Html5mediator-0.1.zip` in your MediaWiki extensions directory.  A new subdirectory (`Html5mediator`) will be created, which contains a single file named `Html5mediator.php`.
2. Add the following code to the bottom of your `LocalSettings.php`:

	> require_once "$IP/extensions/Html5mediatorHtml5mediator.php";
3. Register the audio/video file formats that you want MediaWiki to play.  For instance, if you wanted to play MP4 files, you would add the following to `LocalSettings.php`:

	> $wgFileExtensions[] = 'mp4';
4. When you want to embed a video or audio file onto a wiki page, you can now use the following markup:
 
	> &lt;html5media&gt;mediafile&lt;/html5media&gt; 
5. `mediafile` can be one of two things: (a) a fully-qualified URL to a media file or (b) a MediaWiki file tag (*e.g.* `File:Video.mp4`) if you uploaded an audio/video file to your wiki *a priori* and now want to embed it.
6. ...
7. Profit ...?

### Planned Functionality ###
Additional features to come in the next release include definable custom video height and width.

### Legal and Acknowledgments ###
Html5mediator is licensed under the GNU GPL.  It is based off of the parser_hook example extension, and contains a few lines of code shamelessly borrowed from Swiftlytilting's [Mediawikiplayer](http://www.mediawiki.org/wiki/Extension:MediawikiPlayer) extension.  It utilizes [html5media](http://html5media.info/) for audio and video playback.

### Changelog ###
<table>
	<tr>
		<td>Version</td>
		<td>Date</td>
		<td>Comments</td>
	</tr>
	<tr>
		<td>0.1</td>
		<td>8 August 2013</td>
		<td>Initial release.</td>
	</tr>
</table>
