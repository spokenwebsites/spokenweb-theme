					<?php
						$userdata = $GLOBALS['userdata']; 					
						$dname = $userdata->display_name;
						$fname = $userdata->user_firstname;
						$signed_in_as = ($fname != '' ? $fname : $dname);
						echo $signed_in_as;
					?>