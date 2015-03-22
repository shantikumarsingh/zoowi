<?php
	#AUTOGENERATED BY HYBRIDAUTH 2.1.1-dev INSTALLER - Wednesday 18th of February 2015 09:17:33 AM

/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------
return 
	array(
		"base_url" => "http://localhost/hoauthmasteryii/index.php?r=site/oauth", 

		"providers" => array ( 
			// openid providers
			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( 
					"id" => "97768727470-rjrtasa09l1coo9oli5r7ea0qv98ter1.apps.googleusercontent.com", 
					"secret" => "a-u2kHpMe9bGdcNkkhdy9q1I" 
							)
			),
			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array (
				 		"id" => "1534503190133665", 
				 		"secret" => "c2ed70bd12e6fb1cc0fa93a389fbaa86" 

				),
				"scope"   => "read_stream,user_about_me,user_actions.books,user_actions.fitness,user_actions.music,user_actions.news,user_actions.video,
							  user_activities,user_birthday,user_education_history,user_events,user_friends,user_games_activity,user_groups,
							  user_hometown,user_interests,user_likes,user_location,user_photos,user_relationship_details ,user_relationships,
							  user_religion_politics,user_status,user_tagged_places,user_videos,user_website, user_work_history, 
							  ads_management,ads_read,email,manage_notifications,manage_pages,publish_actions,read_friendlists,read_insights,
							  read_mailbox,read_page_mailboxes,rsvp_event",
				"display" => "popup" // optional
			),
			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "oMO8chvHmskdLcIEW0X8IagZd", "secret" => "ruAxeccTi4uS5PokQWimyTnVoEhaiSNYZGlKaBH8eEuIiH3UWk" ) 
			),
			"Instagram" =>   array ( 
				"enabled"   => true,
				"keys"   => array ( "id" => "0d703d08296f4a31bc40a68a4ee60bed", "secret" => "f92c00828052406697639c7a236f1d79" )
			), 
			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "SQALUPBSPPVOYTQSGTUX3J3133FY5TOQN5NLHL2IQ35BUG23", 
									 "secret" => "BHGOHMS4MUYEQVWEY2MRDX0YY3L0BLBRMPXBGLD4MKOAL2XS" ) 
			),
			"Tumblr" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "a40mfQYXnQMxPTVLQhtlS254xswVOKDDKOHXwGolAz6X2b7XJX", 
									 "secret" => "YSqxxuny9Kjy8BntmF4UbTn6FsVJHfkGGovWaudJSQCfUrhVNi" ) 
			),
			"LinkedIn" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "77lvh5lcnzh4xj", "secret" => "q0uFyLWnWSFSjonT" ) 
			),
			"Vimeo" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "fd22289e4793535c9457b3d4ddf2bf43aa55c31a", 
									 "secret" => "5df97557a50d94e8d3ac075341938b8e55bf9f00" ) 
			),
		),
		"debug_mode" => false,
		//"debug_file" => "/hybridauth.log"
	);
