		<div data-role="footer" data-id="foo2" data-position="fixed" data-fullscreen="false">
			<div data-role="navbar">
				<ul>
	
					<?php
						
						if($_SERVER['REQUEST_URI']!= "/intro"){
							echo '<li><a href="/intro" class="ui-state-persist">Intro</a></li>';
						}

						if($_SERVER['REQUEST_URI']!= "/map"){
							echo '<li><a href="/map" class="ui-state-persist">Map</a></li>';
						}

					?>

					<?php
						if(Authen::signedin()== "true"){

							if($_SERVER['REQUEST_URI']!= "/journal"){
								echo '<li><a href="/journal" class="ui-state-persist">Journal</a></li>';
							}

							if($_SERVER['REQUEST_URI']!= "/settings"){
								echo '<li><a href="/settings" class="ui-state-persist">Settings</a></li>';
							}
							// echo '<li><a href="/ualm/deauthen" class="ui-state-persist">Sign Out</a></li>';
						}else{
							echo '<li><a href="#popupLogin" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-theme="a" data-transition="pop">Sign in</a></li>';

						}
					?>



				</ul>
			</div><!-- /navbar -->
		</div><!-- /footer -->






		<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all" data-corners="false">
		        <div style="padding:10px 20px;">
		            <h3 data-corners="false">Please sign in</h3>
		            <label for="un" class="ui-hidden-accessible" data-corners="false">Username:</label>
		            <input type="text" name="email" id="un" value="" placeholder="email" data-theme="b" data-corners="false">
		            <label for="pw" class="ui-hidden-accessible" data-corners="false">Password:</label>
		            <input type="password" name="pass" id="pw" value="" placeholder="password" data-theme="b" data-corners="false">
		            <button type="button" data-theme="b" data-corners="false" class="signin"     data-textonly="true" data-textvisible="true" data-msgtext="Signing In....">Sign in</button>

						<script>

							$(function(){
								$( document ).on( "click", ".signin", function() {
								    var $this = $( this ),
								        theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
								        msgText = $this.jqmData( "msgtext" ) || $.mobile.loader.prototype.options.text,
								        textVisible = $this.jqmData( "textvisible" ) || $.mobile.loader.prototype.options.textVisible,
								        textonly = !!$this.jqmData( "textonly" );
								        html = $this.jqmData( "html" ) || "";
								    $.mobile.loading( "show", {
								            text: msgText,
								            textVisible: textVisible,
								            theme: theme,
								            textonly: textonly,
								            html: html
								    });


									catchfailure= function(data){
								  		$.mobile.loading( "hide" );
									    $.mobile.loading( "show", {
									            text: "You entered the wrong email or password :(",
									            textVisible: true,
									            theme: "b",
									            textonly: true
									    });
									    timer= setTimeout(function(){
								  			$.mobile.loading( "hide" );
								  			document.location.reload();
									    }, 2000);
									};

									catchf= setTimeout(catchfailure, 3000);

								    // data submitting
								    $.post("/ualm/authen", { email: $("#un").val(), pass: $("#pw").val() })
									.done(function(data) {
									  if(data.split(",")[0]== "OK"){
								  		$.mobile.loading( "hide" );
									    $.mobile.loading( "show", {
									            text: "Welcome Back "+data.split(",")[1],
									            textVisible: true,
									            theme: "b",
									            textonly: true
									    });
									    timer= setTimeout(function(){
								  			$.mobile.loading( "hide" );
								  			document.location.reload();
									    }, 2000);
									  }
									});

								});
							});

						</script>

		        </div>
		</div>











		<script>

			$(function(){
				btnactiverefocus= function(){
					$("div[data-role='navbar']").find("a").removeClass("ui-btn-active");
					// $("div[data-role='navbar']").find("a[href='"+location.pathname+"']").addClass("ui-btn-active");    NO use anymore, current menu item is hidden
				}
				btnactive= setInterval(btnactiverefocus, 100);


				// header visable auto hide
				// autohide= function(){
				// 	$("div[data-role='page']").click();
				// }
				// autohider= setTimeout(autohide, 2000);

				$("div").removeClass("ui-footer-fullscreen");
				$("div").removeClass("ui-page-footer-fullscreen");




				// FORM ON ENTER KEY FIX
				$("#pw").keypress(function(e){
					if(e.keyCode== 13){
						$(".signin").click();
					}
				});	


			});
		</script>


	









