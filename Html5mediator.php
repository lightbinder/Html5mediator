<?php

if ( !defined( 'MEDIAWIKI' ) ) die();

$wgExtensionCredits['html5mediator'][] = array(
	'path' => __FILE__,
	'name' => 'Html5mediator',
	'url' => 'https://www.mediawiki.org/wiki/Extension:Html5mediator',
	'description' => 'A simple way to embed audio and video files in a wiki',
	'author' => 'Seung Park'
 	);

/* Register the registration function */
$wgHooks['ParserFirstCallInit'][] = 'wfHtml5Mediator';

function wfHtml5Mediator($parser)
{
	$parser->setHook('html5media' , 'wfHtml5MediatorParse');
	return true;
}

function wfHtml5MediatorParse($data, $params, $parser, $frame)
{
	global $wgContLang;

	// escape from XSS vulnerabilities
	foreach ($params as $param => $paramval)
	{
		$params[$param] = htmlspecialchars ($paramval);
	}
	$data = htmlspecialchars($data);

	/*
	 * This block of code is borrowed from the fabulous
	 * MediawikiPlayer by Swiftlytilting.  It converts
	 * MediaWiki "File:" tags into fully-valid URLs.
	 */

	// load international name of File namespace
	$namespaceNames = $wgContLang->getNamespaces();
	$fileNS = strtolower($namespaceNames[NS_FILE]);
	$ns = strtolower(substr($data, 0, 5));

	// check to see if a file specified
	if ($ns == 'file:' || $ns == ($fileNS . ':'))
	{
		$image = wfFindFile(substr($data, 5));
		if ($image)
		{
			$data = $image->getFullURL();
		}
		else
		{
			return 'Html5mediator: error loading file:' . Xml::encodeJsVar(substr($data, 5));
		}
	}

	/* End borrowed code */

	// Perform validation on the purported URL
	if (!filter_var($data, FILTER_VALIDATE_URL)) return 'Html5mediator: not a valid URL';

	// Get the file extension -- first check for a 3-char extension (mp3, mp4), then 4-char (webm)
	if (substr($data, -4, 1) == ".") $ext = substr($data, -3);
	else if (substr($data, -5, 1) == ".") $ext = substr($data, -4);
	else if (strtolower(substr($data, 0, 23)) == "http://www.youtube.com/" || strtolower(substr($data, 0, 24)) == "https://www.youtube.com/") $ext = "youtube";

	// Write out the actual HTML
	$code = "<script src=\"http://api.html5media.info/1.1.5/html5media.min.js\"></script>";

	switch ($ext)
	{
		// video file extensions
		case "mp4":
		case "webm":
		case "mov":
		case "ogv":
			$code = $code . "<video src=\"" . $data . "\" controls preload";
			foreach ($params as $param => $paramval)
			{
				$code = $code . " " . htmlspecialchars($param) . "=\"" . $paramval . "\"";
			}
			$code = $code . "></video>";
			break;

		// audio file extensions
		case "mp3":
		case "ogg":
			$code = $code . "<audio src=\"" . $data . "\" controls preload";
			foreach ($params as $param => $paramval)
			{
				$code = $code . " " . htmlspecialchars($param) . "=\"" . $paramval . "\"";
			}
			$code = $code . "></audio>";
			break;
		
		// youtube
		case "youtube":
			$code = "<iframe";
			foreach ($params as $param => $paramval)
			{
				$code = $code . " " . htmlspecialchars($param) . "=\"" . $paramval . "\"";
			}
			$code = $code . " src=\"//www.youtube.com/embed/" . substr($data, -11) . "?rel=0\" frameborder=\"0\" allowfullscreen></iframe>";
			break;

		// unrecognized file extensions
		default:
			return "Html5mediator: file extension not recognized";
	}

	return $code;
}
