wp.customize.controlConstructor["woofcicons"]=wp.customize.Control.extend({ready:function(){"use strict";var control=this;this.container.on("click","input",function(){control.setting.set(jQuery(this).val())})}});