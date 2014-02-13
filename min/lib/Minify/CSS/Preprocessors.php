<?php
/**
 * Class Minify_CSS_Preprocessors
 * @package Minify
 */

/**
 * Preprocessors for CSS
 *
 * 
 * @package Minify
 */
class Minify_CSS_Preprocessors {
	public static function prependImportStatements($css) {

		$importStatements = array();
		$collect = function($matches) use (&$importStatements) {
			$importStatements[] = $matches[0];
			return '/* replaced import "'.$matches[1].'" */';
		};

		$css = preg_replace_callback(Minify_ImportProcessor::IMPORT_STATEMENT_REGEX, $collect, $css);

		if ($importStatements) {
			$css = join("\n", $importStatements) . "\n" . $css;
		}

		return $css;
	}
}