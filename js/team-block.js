/*
 * Gutenberg block Javascript code
 */
   // var __                = wp.i18n.__; // The __() function for internationalization.
    var createElement     = wp.element.createElement; // The wp.element.createElement() function to create elements.
    var registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() function to register blocks.
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
           // edit: props =>  aerisSearchTeams (props, handleSuccess, handleWait),
            // Defines the block within the editor.
            edit: function (props) {
            	  console.log(props);
            	if (aerisTeamOptions.length == 0) {
            		return 'NO TEAM';
            	}
      			var {attributes , setAttributes, focus, className} = props;
      			console.log('attrid='+attributes.id);
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
//            	withSelect( function(select, props) {
//            	return {
//                    teams: select( 'core' ).getEntityRecords( 'postType', 'aeris-team' )
//                };
//            })( function( props ) {
//            	
//            	 if ( ! props.teams ) {
//                     return "Loading...";
//                 }
//
//                 if ( props.teams.length === 0 ) {
//                     return "No teams";
//                 }
//                var options = [];
//                props.teams.forEach(function (team) {
//                	options.push({label: team.title.raw, value: team.id})
//                })
//                console.log(props);
//				var {attributes , setAttributes, focus, className} = props;
//				console.log(attributes.id);
//				var SelectControl = wp.components.SelectControl;
//				var onSelectTeam = function (v) {
//					return props.setAttributes({
//                        id: v
//                    });
//				}
//				return [
//					createElement(
//                        SelectControl,
//                        {
//                            onChange: onSelectTeam,
//                            value: attributes.id,
//                            options: options
//                        }
//					)					
//                ];
//            }),

            // Defines the saved block.
            save: function( props ) {
				return '';
//				createElement(
//                    'p',
//                    {
//                        className: props.className,
//						key: 'return-key',
//                    },props.attributes.content);
			},
        }
    );

