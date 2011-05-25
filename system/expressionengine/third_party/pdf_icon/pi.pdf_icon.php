<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine Loop Plugin
 *
 * @package		Loop Plugin
 * @subpackage		Plugins
 * @category		Plugins
 * @author		Ben Croker
 * @link			http://www.putyourlightson.net/projects/loop/
 */

$plugin_info = array(
				'pi_name'			=> 'PDF Icon Detector',
				'pi_version'		=> '1',
				'pi_author'		=> 'Brad Morse',
				'pi_author_url'	=> 'http://twitter.com/bkmorse',
				'pi_description'	=> 'Adds PDF Icon to PDF linked files',
				'pi_usage'		=> Pdf_icon::usage()
			);


class Pdf_icon {

	var $return_data;

	
	/**
	  *  Constructor
	  */
	function Pdf_icon()
	{
		// make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
    $this->EE->load->helper('url');
		$file_url = $this->EE->TMPL->tagdata;
		$link_title = ($this->EE->TMPL->fetch_param('link_title') !== false) ? $this->EE->TMPL->fetch_param('link_title') : $file_url;
		$alt_tag = ($this->EE->TMPL->fetch_param('alt_tag') !== false) ? $this->EE->TMPL->fetch_param('link_title') : "PDF Icon";
		$pdf_img = ' <img src="./images/pdf_icon.png" alt="'.$alt_tag.'">';
		
		//  If it finds .pdf at the very end of the string,
		//  it will return true and tack on the PDF Icon PNG
		if(preg_match("/\b.pdf\z/i", $file_url)) {
			$return_data = anchor($file_url, $link_title.$pdf_img);
		} else {
		  $return_data = anchor($file_url, $link_title);
		}

		$this->return_data = $return_data;
	}
	/* END */
	
	
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>
Use as follows:

{exp:pdf_icon link_title="" alt_tag=""}{custom_field_url}{/exp:pdf_icon}

link_title and alt_tag parameters are optional

<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}
/* END */


}
// END CLASS

/* End of file pi.pdf_icon.php */
/* Location: ./system/expressionengine/third_party/pdf_icon/pi.pdf_icon.php */
?>