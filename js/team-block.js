/*
 * Gutenberg block Javascript code
 * @author epointal
 */
   // var __                = wp.i18n.__; // The __() function for internationalization.
    var createElement     = wp.element.createElement; // The wp.element.createElement() function to create elements.
    var registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() function to register blocks.
    
    // The team options are added with the php when build the page (with wp_localize_script in aeris-team.php)
    // If this not the case, define aerisTeamOptions like an empty array
    if (!aerisTeamOptions) {
	   var aerisTeamOptions = [];
    }

	/**
     * Register block
     *
     * @param  {string}   name     Block name.
     * @param  {Object}   settings Block settings.
     * @return {?WPBlock}          Block itself, if registered successfully,
     *                             otherwise "undefined".
     */
    registerBlockType(
		'aeris-wppl-team/team-block', // Block name. Must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.	
        {
            title:  'Team block', // Block title. __() function allows for internationalization.
            icon: 'groups', // Block icon from Dashicons. https://developer.wordpress.org/resource/dashicons/.
			category: 'common', // Block category. Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
            attributes: {
				id: {
                    type: 'number'
                }
            },
            // Defines the block within the editor.
            edit: function (props) {
            	// if there is no team
            	if (aerisTeamOptions.length == 0) {
            		return [ createElement('div', {}, __('No team'))];
            	}
            	// else, create select control for teams
      			var {attributes , setAttributes, focus, className} = props;

      			// Default team
      			if (!attributes.id) {
      				props.setAttributes({
      					id: parseInt(aerisTeamOptions[0].value)
      				})
      			}
      			var SelectControl = wp.components.SelectControl;
      			var onSelectTeam = function (v) {
      				return props.setAttributes({
                       id: parseInt(v)
                   });
      			}
      			return [
      				createElement(
                       SelectControl,
                       {
                           onChange: onSelectTeam,
                           value: attributes.id,
                           options: aerisTeamOptions
                       }
      				)					
               ];
            },

            // Defines the saved block (an empty string, there is no html to insert).
            save: function( props ) {
				return '';
			},
        }
    );

