<?php

/**
 * SkinTemplate class for LiquiFlow skin
 * @ingroup Skins
 */
class SkinLiquiFlow extends SkinTemplate {
	public $skinname = 'liquiflow';
	public $stylename = 'LiquiFlow';
	public $template = 'LiquiFlowTemplate';

	protected static $bodyId = 'top';

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param OutputPage $out Object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgHtml5Version;
		$wgHtml5Version = 'HTML+RDFa';

		parent::initPage( $out );
		global $wgStylePath, $wgServer, $wgSitename;
		$faviconPath = $wgStylePath . '/LiquiFlow/images/favicon/';
		$title = $this->getTitle();
		$description = trim( htmlspecialchars( substr( str_replace( array( "\n", "\r", "\n", "[edit]", "  ", "  ", "  " ), ' ', strip_tags( $out->getHTML() ) ), 0, 150 ) ) ) . '...';
		$addAutoMeta = true;
		foreach( $out->getMetaTags() as $metaTag) {
			if( $metaTag[0] == 'description' ) {
				$addAutoMeta = false;
				$description = htmlspecialchars( $metaTag[1] );
			}
		}

		// add text to recruit people from landing page
		$out->addHeadItem('recruitment',
			"<!-- \n" .
			"\t _ _             _                _ _       \n" .
			"\t| (_) __ _ _   _(_)_ __   ___  __| (_) __ _ \n" .
			"\t| | |/ _` | | | | | '_ \ / _ \/ _` | |/ _` |\n" .
			"\t| | | (_| | |_| | | |_) |  __/ (_| | | (_| |\n" .
			"\t|_|_|\__, |\__,_|_| .__/ \___|\__,_|_|\__,_|\n" .
			"\t        |_|       |_|                       \n" .
			"\n" .
			"\tHi you, yes you who's looking at our source code! Are you a website specialist?\n" .
			"\tWe are looking for people to help us with our templates, especially with mobile development.\n" .
			"\tIf you want to help, be sure to visit us on our IRC channel #liquipedia on QuakeNet,\n" .
			"\tjoin us on discord (http://liquipedia.net/discord), or send us an email to\n" .
			"liquipedia <at> teamliquid <dot> net!\n" .
			"-->");

		// Append CSS which includes IE only behavior fixes for hover support -
		// this is better than including this in a CSS file since it doesn't
		// wait for the CSS file to load before fetching the HTC file.
		$out->addHeadItem( 'ie-edge', '<meta http-equiv="X-UA-Compatible" content="IE=edge">');
		$out->addHeadItem( 'x-ie8-fix',
			"<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->\n" .
			"<!--[if lt IE 9]>\n" .
			"<script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>\n" .
			"<script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>\n" .
			"<![endif]-->");

		// Meta tags for mobile
		$out->addHeadItem( 'responsive', '<meta name="viewport" content="width=device-width, initial-scale=1.0">');
		$out->addHeadItem( 'mobile-head-color', '<meta name="theme-color" content="#052b4c">' );

		// Favicons
		$out->addHeadItem( 'favicons', 
			'<link rel="apple-touch-icon-precomposed" sizes="57x57" href="' . $faviconPath . 'apple-touch-icon-57x57.png" />'
			. '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . $faviconPath . 'apple-touch-icon-114x114.png" />'
			. '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . $faviconPath . 'apple-touch-icon-72x72.png" />'
			. '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . $faviconPath . 'apple-touch-icon-144x144.png" />'
			. '<link rel="apple-touch-icon-precomposed" sizes="60x60" href="' . $faviconPath . 'apple-touch-icon-60x60.png" />'
			. '<link rel="apple-touch-icon-precomposed" sizes="120x120" href="' . $faviconPath . 'apple-touch-icon-120x120.png" />'
			. '<link rel="apple-touch-icon-precomposed" sizes="76x76" href="' . $faviconPath . 'apple-touch-icon-76x76.png" />'
			. '<link rel="apple-touch-icon-precomposed" sizes="152x152" href="' . $faviconPath . 'apple-touch-icon-152x152.png" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-196x196.png" sizes="196x196" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-96x96.png" sizes="96x96" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-32x32.png" sizes="32x32" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-16x16.png" sizes="16x16" />'
			. '<link rel="icon" type="image/png" href="' . $faviconPath . 'favicon-128x128.png" sizes="128x128" />'
			. '<meta name="application-name" content="' . $wgSitename . '"/>'
			. '<meta name="msapplication-TileColor" content="#ffffff" />'
			. '<meta name="msapplication-TileImage" content="' . $faviconPath . 'mstile-144x144.png" />'
			. '<meta name="msapplication-square70x70logo" content="' . $faviconPath . 'mstile-70x70.png" />'
			. '<meta name="msapplication-square150x150logo" content="' . $faviconPath . 'mstile-150x150.png" />'
			. '<meta name="msapplication-wide310x150logo" content="' . $faviconPath . 'mstile-310x150.png" />'
			. '<meta name="msapplication-square310x310logo" content="' . $faviconPath . 'mstile-310x310.png" />' );

		// Do stuff for SEO
		$out->addHeadItem( 'ogproperties', 
			'<meta property="og:type" content="article">'
			. '<meta property="og:image" content="' . $wgServer . $faviconPath . 'mstile-310x310.png" />'
			. '<meta property="og:url" content="' . $title->getFullURL() . '" />'
			. '<meta property="og:title" content="' . htmlspecialchars( $out->getPageTitle() ) . '" />'
			. '<meta property="og:description" content="' . $description . '" />' );
		$addAutoMeta = true;
		foreach( $out->getMetaTags() as $metaTag) {
			if( $metaTag[0] == 'description' ) {
				$addAutoMeta = false;
			}
		}
		if( $addAutoMeta ) {
			$out->addMeta( 'description', $description );
		}

		Hooks::run( 'LiquiFlowAdStartCode', array( &$out ) );

		$scripts = array( 'skins.liquiflow', 'skins.liquiflow.bottom', 'jquery.chosen' );
		$out->addModuleScripts( $scripts );
		if ($this->getSkin()->getUser()->getOption( 'liquiflow-prefs-show-dropdown-on-hover' ) == true) {
			$out->addModuleScripts( 'skins.liquiflow.hoverdropdown' );
		}

		if( wfMessage( 'liquiflow-js-urls' )->exists() ) {
			$urlScripts = wfMessage( 'liquiflow-js-urls' )->plain();
			$urlScripts = explode( "\n", $urlScripts );
			foreach( $urlScripts as $urlId => $urlScript ) {
				if( strpos( trim( $urlScript) , '*' ) !== 0 ) {
					continue;
				}
				$urlScript = ltrim( trim( $urlScript ), '* ' );
				$out->addHeadItem( 'liquiflow-script-' . $urlId, "<script src=\"" . $urlScript . "\"></script>\n" );
			}
		}
	}
	/**
	 * Loads skin and user CSS files.
	 * @param OutputPage $out
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$out->addStyle( 'https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,700,700italic%7CDroid+Sans+Mono%7CRoboto:500' );
		$styles = array( 'mediawiki.skinning.interface', 'skins.liquiflow', 'skins.liquiflow.bottom' );
		$out->addModuleStyles( $styles );
		global $wgScriptPath;
		if( $out->getResourceLoader()->isModuleRegistered( 'skins.liquiflow.theme.' . substr($wgScriptPath, 1) ) ) {
			$out->addModuleStyles( 'skins.liquiflow.theme.' . substr($wgScriptPath, 1) );
		} else {
			$out->addModuleStyles( 'skins.liquiflow.theme.commons' );
		}
		if ( $this->getSkin()->getUser()->isLoggedIn() ) {
			$out->addModuleStyles( 'skins.liquiflow.loggedin' );
		}
		if ( !$this->getSkin()->getUser()->getOption ( 'liquiflow-prefs-show-buggy-editor-tabs' ) ) {
			$out->addModuleStyles( 'skins.liquiflow.removebuggyeditortabs' );
		}

		if( wfMessage( 'liquiflow-css-urls' )->exists() ) {
			$urlStyles = wfMessage( 'liquiflow-css-urls' )->plain();
			$urlStyles = explode( "\n", $urlStyles );
			foreach( $urlStyles as $urlStyle ) {
				if ( strpos( trim( $urlStyle ) , '*' ) !== 0 ) {
					continue;
				}
				$urlStyle = ltrim( trim( $urlStyle ), '* ' );
				if( !empty( $urlStyle ) && strlen( $urlStyle ) > 0 ) {
					$out->addStyle( $urlStyle );
				}
			}
		}
	}

	/**
	 * Adds stuff to the body element.
	 *
	 * @param OutputPage $out
	 * @param array &$bodyAttrs Array of attributes that will be set on the body element
	 */
	function addToBodyAttributes( $out, &$bodyAttrs ) {
		global $wgScriptPath;
		$bodyAttrs['id'] = static::$bodyId;
		if ( $this->getSkin()->getUser()->isLoggedIn() ) {
			$bodyAttrs['class'] .= ' logged-in';
		} else {
			$bodyAttrs['class'] .= ' logged-out';
		}
		$bodyAttrs['class'] .= ' wiki-' . substr( $wgScriptPath, 1 );
	}

	/**
	 * Return values for <html> element
	 * @return array Array of associative name-to-value elements for <html> element
	 */
	public function getHtmlElementAttributes() {
		$lang = $this->getLanguage();
		return [
			'lang' => $lang->getHtmlCode(),
			'dir' => $lang->getDir(),
			'class' => 'client-nojs pizza',
			'xmlns:og' => 'http://opengraphprotocol.org/schema/',
		];
	}
}
