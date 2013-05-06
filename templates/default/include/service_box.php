	<div class="servicebox">
        	<div class="bg phone"><?php echo $GLOBALS['taobao']['contact']['phone']; ?></div>
            <ul>
            	<li class="clearfix"><dl>&nbsp;&nbsp;Email:&nbsp;&nbsp;</dl><dt><a href="mailto:<?php echo $GLOBALS['taobao']['contact']['email']; ?>"><?php echo $GLOBALS['taobao']['contact']['email']; ?></a></dt></li>
                <li class="clearfix" style="padding:5px 40px">
                	<script type="text/javascript" src="http://settings.messenger.live.com/controls/1.0/PresenceButton.js"></script>
<div
  id="Microsoft_Live_Messenger_PresenceButton_6a2f88c34982f266"
  msgr:width="100"
  msgr:backColor="#F9A3A3"
  msgr:altBackColor="#FFFFFF"
  msgr:foreColor="#424542"
  msgr:conversationUrl="http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=6a2f88c34982f266@apps.messenger.live.com&mkt=en-US&useTheme=true&themeName=pink&foreColor=444444&backColor=FFD5D5&linkColor=444444&borderColor=ED7B7B&buttonForeColor=AA3636&buttonBackColor=FAD6D6&buttonBorderColor=AA3636&buttonDisabledColor=FAD6D6&headerForeColor=444444&headerBackColor=F9A3A3&menuForeColor=E45A5A&menuBackColor=FFFFFF&chatForeColor=444444&chatBackColor=FEF6F6&chatDisabledColor=F6F6F6&chatErrorColor=760502&chatLabelColor=6E6C6C"></div>
<script type="text/javascript" src="http://messenger.services.live.com/users/6a2f88c34982f266@apps.messenger.live.com/presence?dt=&mkt=en-US&cb=Microsoft_Live_Messenger_PresenceButton_onPresence"></script>
                </li>
                <li class="clearfix"><dl>&nbsp;&nbsp;Working:&nbsp;&nbsp;</dl><dt><?php echo $GLOBALS['taobao']['contact']['address']; ?></dt></li>
                <li class="clearfix"><dl>&nbsp;&nbsp;Now is :&nbsp;&nbsp;</dl><dt id="clock"></dt>
                </li>
            </ul>
        </div>
        <script language="javascript">
			setInterval('calcTime()',1000);	
			function calcTime() {		
				var offset = 8;		
				var d = new Date();		
				var utc = d.getTime() + (d.getTimezoneOffset() * 60000);				
				var nd = new Date(utc + (3600000*offset));			
				$("#clock").text(nd.toLocaleTimeString());
			}
		</script>