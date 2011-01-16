/****************************************************************************************
Just so there's no question at all about what you can and can't do with this
source code, here's the licensing terms. (Basically, you can do anything you
want with it, except not reproduce this license.)
*****************************************************************************************
The "New" BSD License:
**********************

Copyright (c) 2008, Matthew A. Russell
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

  * Redistributions of source code must retain the above copyright notice, this
    list of conditions and the following disclaimer.
  * Redistributions in binary form must reproduce the above copyright notice,
    this list of conditions and the following disclaimer in the documentation
    and/or other materials provided with the distribution.
  * Neither Matthew Russell nor his likeness may be used to endorse or promote products 
    derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED.  IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
****************************************************************************************/

dojo.provide("dojox.image.ImageReflector");

dojo.require("dojox.gfx");
dojo.require("dijit._Widget");
dojo.require("dijit._Templated");

dojo.declare("dtdg.ImageReflector", [dijit._Widget, dijit._Templated], {
    // summary: 
    //     A simple, degradable widget that provides the appearance of a reflective
    //     surface below an image.
    // description: 
    //     Draws a dojox.gfx surface below the image to provide the effect of a faded out reflection.
    //     No reflective surface is applied if VML is used as the drawing backend since VML does not
    //     support opacity in gradients.

    // reflectionRatio: Float
    //     What percentage of the image's height to use as the height below it for the 
    //     reflective surface. Default value is 0.3
    reflectionRatio: 0.3,

    templateString: "<div>"
                        +"<img src='${_src}' dojoAttachPoint='img'>"
                        +"<div dojoAttachPoint='mirror'></div>"
                    +"</div>",

    constructor : function(props,node) {
        // summary: 
        //     Captures the src, height, and width of the image along with the
        //     reflectionRatio (if provided.)
       node = dojo.byId(node);
       this._width = dojo.style(node, "width"), this._height = dojo.style(node, "height");
       this._src = node.src;
       if (props.reflectionRatio) {
            this.reflectionRatio = props.reflectionRatio;
       }
    },

    postCreate : function() {
        // summary:
        //     Draws the reflection of the image below it, using a general purpose reflection transform matrix
        //     to accomplish the reflection, and overlays a linear gradient that fades out the opacity

        if (dojox.gfx.renderer == "vml") return; //nothing to do, unfortunately.

        var mirror = dojox.gfx.createSurface(this.mirror, this._width,this._height*this.reflectionRatio);
        var theta = 0;

        //draw in the portion of the image...
        mirror
        .createImage({
            src : this._src,
            width : this._width,
            height : this._height,
            x : 0,
            y : 0
        })
        .setTransform({
            xx : Math.cos(2*theta),
            xy : Math.sin(2*theta),
            yx : Math.sin(2*theta),
            yy : -1*Math.cos(2*theta),
            dx : 0,
            dy :this._height 
        })
        ;

        //...and now apply a linear gradient that fades out the opacity
        mirror
        .createRect({
            x : 0,
            y : 0,
            width : this._width,
            height : this._height*this.reflectionRatio +1
        })
        .setFill({
           type : "linear",
            x1 : this._width/2,
            y1 : 0,
            x2 : this._width/2,
            y2 : this._height*this.reflectionRatio,
            colors : [
                {color : new dojo.Color([255,255,255,0.0]), offset: 0.0},
                {color : new dojo.Color([255,255,255,1.0]), offset : 1.0}
            ]

        })
        ;
    }
});
