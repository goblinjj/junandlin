<?php

	/**
	 * Class Savant3_Filter_noumlauts
	 * @author J.P.Jarolim <http://johannes.jarolim.com>
	 * @copyright J.P.Jarolim <http://johannes.jarolim.com>
	 */
	class Savant3_Filter_noumlauts extends Savant3_Filter {

		var $umlauts = array('ä','Ä','ö','Ö','ü','Ü','ß','é','É','è','È','Æ','æ','–','—','‘','’','“','”');
		var $replacements = array('auml','Auml','ouml','Ouml','uuml','Uuml','szlig','eacute','Eacute','egrave','Egrave','AElig','aelig','ndash','mdash','lsquo','rsquo','&rdquo;','&bdquo;');

		function toRegExp($element) {
			return '/' . $element . '/';
		}
		
		function toHtmlEntity($element) {
			return '&' . $element . ';';
		}
		
		/**
		 * Removes extra white space within the text.
		 * 
		 * Trim leading white space and blank lines from template source
		 * after it gets interpreted, cleaning up code and saving bandwidth.
		 * Does not affect <pre></pre>, <script></script>, or
		 * <textarea></textarea> blocks.
		 * 
		 * @access public
		 * 
		 * @param string $buffer The source text to be filtered.
		 * 
		 * @return string The filtered text.
		 * 
		 */
		public static function filter($buffer) {
			
			return preg_replace(
				array_map(
					array($this, 'toRegExp'), 
					$this->umlauts
				), 
				array_map(
					array($this, 'toHtmlEntity'),
					$this->replacements
				), 
				$buffer
			);
			
		}

	}

?>