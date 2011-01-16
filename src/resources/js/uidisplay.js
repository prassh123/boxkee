    // Load Dojo's code relating to the Button widget
     dojo.require("dijit.form.Button");
	 dojo.require("dijit.form.TextBox");
     dojo.require("dijit.layout.BorderContainer");
	 dojo.require("dijit.layout.TabContainer");
     dojo.require("dijit.layout.AccordionContainer");
     dojo.require("dijit.layout.ContentPane");
	 dojo.require("dojox.fx.Shadow");
     dojo.require("dojox.widget.FisheyeList");
	 dojo.require("dojo.parser");
     dojo.require("dojo.dnd.Source");
	 dojo.require("dojo.dnd.Selector");

 	 dojo.addOnLoad(function() {
		var cartPane = new dijit.layout.ContentPane({
			region: "left",
			style: "height: 250px",
			content: ""
		},"cartPaneNode");

		var inboxPane = new dijit.layout.ContentPane({
			region: "right",
			style: "height: 250px",
		},"inboxPaneNode");

		
		var cart = new dojo.dnd.Target("cartPaneNode");
		var inbox = dojo.dnd.Source("inboxPaneNode");
		var resetSelections = function(){
			cart.selectNone();
		};
		var clearCartButton = new dijit.form.Button({}, "clearCartNode");
		dojo.connect(clearCartButton, "onClick", function(e){
			cart.selectId("");
			cart.deleteSelectedNodes();
		});
		var getInboxButton = new dijit.form.Button({}, "getInboxNode");
		dojo.connect(getInboxButton, "onClick", function(e){
			jsaction('/codeIgniter/src/boxKee.php/boxkee/actions','getZipcodeStoreInfo',"inboxPaneNode");
		});		
		
	});


   function jsaction(url,mode,node) {
       //Look up the node we'll stick the text under.
       var targetNode = dojo.byId(node);
		//alert(dojo.byId('searchField').value);
       //The parameters to pass to xhrGet, the url, how to handle it, and the callbacks.
       var xhrArgs = {
           url: url,
           handleAs: "text",
           preventCache: true,
           content: {
               mode: mode,
               //store_zipcode: dojo.byId('searchField').value
				store_zipcode: '94568'
				},
			//dojo.byId('name').value
           load: function(data) {
               //Replace newlines with nice HTML tags.
               data = data.replace(/\n/g, "<br>");
               //Replace tabs with spacess.
               data = data.replace(/\t/g, "&nbsp;&nbsp;&nbsp;");
               targetNode.innerHTML = data;
           },
           error: function(error) {
               targetNode.innerHTML = "An unexpected error occurred: " + error;
           }
       }

       //Call the asynchronous xhrGet
       var deferred = dojo.xhrGet(xhrArgs);
   }	
		/* todo tut
		var c1, c2;
		c1 = new dojo.dnd.Selector(dojo.byId("cartPaneNode"));
		
		-- delete all 
		cart.selectAll();
		cart.deleteSelectedNodes();
		resetSelections();
		
		-- to delete an item for the page
		dojo.destroy("centerpane");

		-- to get a node 
		var node = dojo.byId("item1");
		dojo.destroy(node);			
		*/

