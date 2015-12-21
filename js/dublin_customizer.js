/*
Upsells
*/

jQuery(document).ready(function() {

	/* Upsells in customizer (Documentation link and Upgrade to PRO link */


	if( !jQuery( ".dublin-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section dublin-upsells" style="padding-bottom: 15px">');
		}

    if( jQuery( ".dublin-upsells" ).length ) {

  		jQuery('.dublin-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://flyfreemedia.com/documentation/dublin/" class="button" target="_blank">{documentation}</a>'.replace('{documentation}', dublinCustomizerObject.documentation));
  		jQuery('.dublin-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://github.com/Codeinwp/dublin" class="button" target="_blank">{github}</a>'.replace('{github}', dublinCustomizerObject.github));
  		jQuery('.dublin-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://wordpress.org/support/view/theme-reviews/dublin#postform" class="button" target="_blank">{review}</a>'.replace('{review}', dublinCustomizerObject.review));

  	}

	if ( !jQuery( ".dublin-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('</li>');
	}
});
