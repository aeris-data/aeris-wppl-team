/*
 * Gutenberg block Javascript code
 */
   // var __                = wp.i18n.__; // The __() function for internationalization.
    var createElement     = wp.element.createElement; // The wp.element.createElement() function to create elements.
    var registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() function to register blocks.
	
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
				teamID: {
                    type: 'number'
                },
                name: {
                    type: 'string'
                }
            },
            // Defines the block within the editor.
            edit: function( props ) {
				
				var {attributes , setAttributes, focus, className} = props;
                console.log(props);
				var InspectorControls = wp.editor.InspectorControls;
				var Button = wp.components.Button;
				var RichText = wp.editor.RichText;
				var Editable = wp.blocks.Editable; // Editable component of React.
				var MediaUpload = wp.editor.MediaUpload;
				var btn = wp.components.Button;
				var TextControl = wp.components.TextControl;
				var SelectControl = wp.components.SelectControl;
				var RadioControl = wp.components.RadioControl;
			    var CheckboxControl = wp.components.CheckboxControl;
				var options = [{ label: 'Equipe1', value: '21' },
					{ label: 'Equipe2', value: '22' }];
		        if (!attributes.teamID) {
		        	setAttributes({
		        		teamId: options[0].value,
		        		name: options[0].name
		        	})
		        }
		        console.log(props);
				function onSelectTeam (v) {
					var name = null;
					options.forEach(function (item) {
						if (item.value === 'v') {
							name = item.label;
						}
					})
					return props.setAttributes({
                        teamID: v,
                        name: name
                    });
				}
				return [
					createElement(
                        SelectControl,
                        {
                            onSelect: onSelectTeam,
                            value: attributes.teamID,
                            options: options
                        }
					)
										
                ];
            },

            // Defines the saved block.
            save: function( props ) {
				return createElement(
                    'p',
                    {
                        className: props.className,
						key: 'return-key',
                    },props.attributes.content);
			},
        }
    );
