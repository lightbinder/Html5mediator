## Html5mediator ##
**Html5mediator** is a simple extension for MediaWiki that defines a new tag (`<html5media>`) which can be used to embed HTML5 video and/or audio.  It is stable enough for production use, but has minimal extra features (e.g. defining video height and/or width) at this point in time.

### Obtaining ###
The latest version of Html5mediator (0.3.2 at the time of this writing) is always available at [github.com/lightbinder/Html5mediator](https://github.com/lightbinder/Html5mediator).

### Usage ###
1. Unzip `Html5mediator-0.3.2.zip` in your MediaWiki extensions directory.  A new subdirectory (`Html5mediator`) will be created, which contains a single file named `Html5mediator.php`.
2. Add the following code to the bottom of your `LocalSettings.php`:

	> require_once "$IP/extensions/Html5mediatorHtml5mediator.php";
3. Register the audio/video file formats that you want MediaWiki to play.  For instance, if you wanted to play MP4 files, you would add the following to `LocalSettings.php`:

	> $wgFileExtensions[] = 'mp4';
4. When you want to embed a video or audio file onto a wiki page, you can now use the following markup:
 
	> &lt;html5media&gt;mediafile&lt;/html5media&gt; 
5. `mediafile` can be one of two things: (a) a fully-qualified URL to a media file or (b) a MediaWiki file tag (e.g. `File:Video.mp4`) if you uploaded an audio/video file to your wiki *a priori* and now want to embed it.
6. As of version 0.2, you can define a custom height and width for video files.  For instance, if you wanted to play `File:Video.mp4` at 640x480, you would write:

	> &lt;html5media width="640" height="480"&gt;File:Video.mp4&lt;/html5media&gt;

7. As of version 0.3, you can embed YouTube files.  For instance, if you wanted to embed [this](http://www.youtube.com/watch?v=MGt25mv4-2Q) at 1280x720, you would write:

	> &lt;html5media width="1280" height="720"&gt;http://www.youtube.com/watch?v=MGt25mv4-2Q</html5media&gt;
	
### Planned Functionality ###
If there is enough demand for such functionality, future versions may allow for video embedding from other popular video streaming site sources (e.g. DailyMotion), as well as some of the more advanced features (e.g. automatically serving different versions of video files depending on the user's device) that are present in [html5media](http://html5media.info/) itself.

### Legal and Acknowledgments ###
Html5mediator is licensed under the GNU GPL.  It is based on the [parser_hook](https://svn.wikimedia.org/viewvc/mediawiki/trunk/extensions/examples/) example extension, and contains a few lines of code shamelessly borrowed from Swiftlytilting's [MediawikiPlayer](http://www.mediawiki.org/wiki/Extension:MediawikiPlayer) extension.  It utilizes [html5media](http://html5media.info/) for audio and video playback.

### Changelog ###
<table>
	<tr>
		<td>Version</td>
		<td>Date</td>
		<td>Comments</td>
	</tr>
	<tr>
		<td>0.3.2</td>
		<td>12 September 2013</td>
		<td>
			<ul>
				<li>More HTML special character escaping to guard against possible XSS vulnerability.</li>
			</ul>
		</td>
	</tr>		
	<tr>
		<td>0.3.1</td>
		<td>7 September 2013</td>
		<td>
			<ul>
				<li>Added support for https://www.youtube.com/ in YouTube embedding.</li>
			</ul>
		</td>
	</tr>	
	<tr>
		<td>0.3</td>
		<td>7 September 2013</td>
		<td>
			<ul>
				<li>Added YouTube embedding.</li>
			</ul>
		</td>
	</tr>	
	<tr>
		<td>0.2.1</td>
		<td>7 September 2013</td>
		<td>
			<ul>
				<li>Added URL information in $wgExtensionCredits.</li>
				<li>Normalized indentation style throughout the program.</li>
				<li>Miscellaneous code cleanup.</li>
			</ul>
		</td>
	</tr>	
	<tr>
		<td>0.2</td>
		<td>6 September 2013</td>
		<td>
			<ul>
				<li>Added support for user-defined height and width.</li>
			</ul>
		</td>
	</tr>
	<tr>
		<td>0.1</td>
		<td>8 August 2013</td>
		<td>
			<ul>
				<li>Initial release.</li>
			</ul>
		</td>
	</tr>
</table>
