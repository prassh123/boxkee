<html>
<head>
  <title> Boxkee</title>
  <link rel="stylesheet" href="../../resources/style/demo.css">
  
  <! import DOJO>
  <style type="text/css">
	  @import "../../resources/js/dijit/themes/tundra/tundra.css";
      @import "../../resources/js/dojo/resources/dojo.css";
	  @import "../../resources/style/style.css";
	  @import "../../resources/js/dojo/resources/dnd.css";
	  @import "../../resources/style/dndDefault.css";
  </style> 
  <script type="text/javascript" src="../../resources/js/dojo/dojo.js" djConfig="parseOnLoad: true"></script>
  <script src="../../resources/js/uidisplay.js"></script>

</head>

<body class="tundra">
<div dojoType="dijit.layout.BorderContainer" style="width: 1020; height: 100%; margin-left:210px; margin-right:210px">

    <div dojoType="dijit.layout.ContentPane" region="top" style="height:80; border:none; border-bottom:1px groove #cccccc;">
        <div dojoType="dijit.layout.BorderContainer" style="height: 80;">
			<div dojoType="dijit.layout.ContentPane" region="left" style="height:60; width:300; border:none">
				<h1>BoXkee</h1>
				</div>
			<div dojoType="dijit.layout.ContentPane" region="right" style="height:60; width:400; border:none">
				<div dojoType="dojox.widget.FisheyeList"
				itemWidth="50" itemHeight="50"
				itemMaxWidth="60" itemMaxHeight="60"
				orientation="horizontal"
				effectUnits="1.5"
				attachEdge="top"
				labelEdge="bottom"
				id="fisheye2">
					<div dojoType="dojox.widget.FisheyeListItem"
						iconSrc="../../resources/images/friends.jpg" style="margin-left:5px;margin-right:5px" >
					</div>
					<div dojoType="dojox.widget.FisheyeListItem"
						iconSrc="../../resources/images/rate.jpg" style="margin-left:5px;margin-right:5px">
					</div>
					<div dojoType="dojox.widget.FisheyeListItem"
						iconSrc="../../resources/images/rating.jpg" style="margin-left:5px;margin-right:5px">
					</div>
					<div dojoType="dojox.widget.FisheyeListItem"
						iconSrc="../../resources/images/friends.jpg" style="margin-left:5px;margin-right:5px">
					</div>
				</div>

			</div>
		</div>
    </div>

	<div dojoType="dijit.layout.ContentPane" region="left" style="height:300; width:200; margin-top:30; border:1.5px ridge #cccccc">
			<div id="cartPaneNode"></div>
			<div id="clearCartNode">Clear</div>
    </div>

    <div dojoType="dijit.layout.ContentPane" region="center" id="centerpane">
        <textbox dojoType="dijit.form.TextBox" id="searchField"></textbox>
		<button dojoType="dijit.form.Button" id="test">
			Search <script type="dojo/method" event="onClick">jsaction('/boxkee/src/boxKee.php/boxkee/actions/getZipcodeStoreInfo','',"centercontent");</script>
		</button>
		<div id="centercontent"></div>
    </div>

	<div dojoType="dijit.layout.ContentPane" region="right" style="height:300; width:200; margin-top:30; border:1.5px ridge #cccccc">
		<div id="inboxSection">
			<div id="inboxPaneNode">
			<div class='dojoDndItem' id='item1'></div>
			<div class='dojoDndItem' id='item2'></div>
			<div class='dojoDndItem' id='item3'></div>
			</div>
			<div id="getInboxNode">Check Inbox</div>
		</div>
	</div>	


	<div dojoType="dijit.layout.ContentPane" region="bottom" style="height:120;border:none; border-top:2px ridge #cccccc;">
		<div dojoType="dojox.widget.FisheyeList"
		itemWidth="70" itemHeight="70"
		itemMaxWidth="100" itemMaxHeight="120"
		orientation="horizontal"
		effectUnits="2"
		itemPadding="10"
		attachEdge="top"
		labelEdge="bottom"
		id="fisheye1">
			<div dojoType="dojox.widget.FisheyeListItem"
				iconSrc="../../resources/images/box.jpg">
			</div>
			<div dojoType="dojox.widget.FisheyeListItem"
				iconSrc="../../resources/images/rate.jpg" >
			</div>
			<div dojoType="dojox.widget.FisheyeListItem"
				onclick="alert('click on ' + this.label + '(from widget id ' + this.widgetid + ')!');"
				iconSrc="../../resources/images/rating.jpg">
			</div>
			<div dojoType="dojox.widget.FisheyeListItem"
				onclick="alert('click on ' + this.label + '(from widget id ' + this.widgetid + ')!');"
				iconSrc="../../resources/images/friends.jpg">
			</div>
			<div dojoType="dojox.widget.FisheyeListItem"
				onclick="alert('click on ' + this.label + '(from widget id ' + this.widgetid + ')!');"
				iconSrc="../../resources/images/wishlist.jpg">
			</div>
		</div>
	</div>

</div>

</body>
</html>