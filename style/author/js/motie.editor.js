/**
 * @license Rangy Text Inputs, a cross-browser textarea and text input library plug-in for jQuery.
 * http://code.google.com/p/rangyinputs/
 *
 * Depends on jQuery 1.0 or later.
 *
 * Related project: Rangy, a cross-browser JavaScript range and selection library
 * http://code.google.com/p/rangyinputs/
 *
 * Copyright %%build:year%%, Tim Down
 * Licensed under the MIT license.
 * Version: %%build:version%%
 * Build date: %%build:date%%
 */
(function($) {
    var UNDEF = "undefined";
    var getSelection, setSelection, deleteSelectedText, deleteText, insertText;
    var replaceSelectedText, surroundSelectedText, extractSelectedText, collapseSelection;

    // Trio of isHost* functions taken from Peter Michaux's article:
    // http://peter.michaux.ca/articles/feature-detection-state-of-the-art-browser-scripting
    function isHostMethod(object, property) {
        var t = typeof object[property];
        return t === "function" || (!!(t == "object" && object[property])) || t == "unknown";
    }

    function isHostProperty(object, property) {
        return typeof(object[property]) != UNDEF;
    }

    function isHostObject(object, property) {
        return !!(typeof(object[property]) == "object" && object[property]);
    }

    function fail(reason) {
        if (window.console && window.console.log) {
            window.console.log("RangyInputs not supported in your browser. Reason: " + reason);
        }
    }

    function adjustOffsets(el, start, end) {
        if (start < 0) {
            start += el.value.length;
        }
        if (typeof end == UNDEF) {
            end = start;
        }
        if (end < 0) {
            end += el.value.length;
        }
        return { start: start, end: end };
    }

    function makeSelection(el, start, end) {
        return {
            start: start,
            end: end,
            length: end - start,
            text: el.value.slice(start, end)
        };
    }

    function getBody() {
        return isHostObject(document, "body") ? document.body : document.getElementsByTagName("body")[0];
    }

    $(document).ready(function() {
        var testTextArea = document.createElement("textarea");

        getBody().appendChild(testTextArea);

        if (isHostProperty(testTextArea, "selectionStart") && isHostProperty(testTextArea, "selectionEnd")) {
            getSelection = function(el) {
                var start = el.selectionStart, end = el.selectionEnd;
                return makeSelection(el, start, end);
            };

            setSelection = function(el, startOffset, endOffset) {
                var offsets = adjustOffsets(el, startOffset, endOffset);
                el.selectionStart = offsets.start;
                el.selectionEnd = offsets.end;
            };

            collapseSelection = function(el, toStart) {
                if (toStart) {
                    el.selectionEnd = el.selectionStart;
                } else {
                    el.selectionStart = el.selectionEnd;
                }
            };
        } else if (isHostMethod(testTextArea, "createTextRange") && isHostObject(document, "selection") &&
                   isHostMethod(document.selection, "createRange")) {

            getSelection = function(el) {
                var start = 0, end = 0, normalizedValue, textInputRange, len, endRange;
                var range = document.selection.createRange();

                if (range && range.parentElement() == el) {
                    len = el.value.length;

                    normalizedValue = el.value.replace(/\r\n/g, "\n");
                    textInputRange = el.createTextRange();
                    textInputRange.moveToBookmark(range.getBookmark());
                    endRange = el.createTextRange();
                    endRange.collapse(false);
                    if (textInputRange.compareEndPoints("StartToEnd", endRange) > -1) {
                        start = end = len;
                    } else {
                        start = -textInputRange.moveStart("character", -len);
                        start += normalizedValue.slice(0, start).split("\n").length - 1;
                        if (textInputRange.compareEndPoints("EndToEnd", endRange) > -1) {
                            end = len;
                        } else {
                            end = -textInputRange.moveEnd("character", -len);
                            end += normalizedValue.slice(0, end).split("\n").length - 1;
                        }
                    }
                }

                return makeSelection(el, start, end);
            };

            // Moving across a line break only counts as moving one character in a TextRange, whereas a line break in
            // the textarea value is two characters. This function corrects for that by converting a text offset into a
            // range character offset by subtracting one character for every line break in the textarea prior to the
            // offset
            var offsetToRangeCharacterMove = function(el, offset) {
                return offset - (el.value.slice(0, offset).split("\r\n").length - 1);
            };

            setSelection = function(el, startOffset, endOffset) {
                var offsets = adjustOffsets(el, startOffset, endOffset);
                var range = el.createTextRange();
                var startCharMove = offsetToRangeCharacterMove(el, offsets.start);
                range.collapse(true);
                if (offsets.start == offsets.end) {
                    range.move("character", startCharMove);
                } else {
                    range.moveEnd("character", offsetToRangeCharacterMove(el, offsets.end));
                    range.moveStart("character", startCharMove);
                }
                range.select();
            };

            collapseSelection = function(el, toStart) {
                var range = document.selection.createRange();
                range.collapse(toStart);
                range.select();
            };
        } else {
            getBody().removeChild(testTextArea);
            fail("No means of finding text input caret position");
            return;
        }

        // Clean up
        getBody().removeChild(testTextArea);

        deleteText = function(el, start, end, moveSelection) {
            var val;
            if (start != end) {
                val = el.value;
                el.value = val.slice(0, start) + val.slice(end);
            }
            if (moveSelection) {
                setSelection(el, start, start);
            }
        };

        deleteSelectedText = function(el) {
            var sel = getSelection(el);
            deleteText(el, sel.start, sel.end, true);
        };

        extractSelectedText = function(el) {
            var sel = getSelection(el), val;
            if (sel.start != sel.end) {
                val = el.value;
                el.value = val.slice(0, sel.start) + val.slice(sel.end);
            }
            setSelection(el, sel.start, sel.start);
            return sel.text;
        };

        insertText = function(el, text, index, moveSelection) {
            var val = el.value, caretIndex;
            el.value = val.slice(0, index) + text + val.slice(index);
            if (moveSelection) {
                caretIndex = index + text.length;
                setSelection(el, caretIndex, caretIndex);
            }
        };

        replaceSelectedText = function(el, text) {
            var sel = getSelection(el), val = el.value;
            el.value = val.slice(0, sel.start) + text + val.slice(sel.end);
            var caretIndex = sel.start + text.length;
            setSelection(el, caretIndex, caretIndex);
        };

        surroundSelectedText = function(el, before, after) {
            if (typeof after == UNDEF) {
                after = before;
            }
            var sel = getSelection(el), val = el.value;
            el.value = val.slice(0, sel.start) + before + sel.text + after + val.slice(sel.end);
            var startIndex = sel.start + before.length;
            var endIndex = startIndex + sel.length;
            setSelection(el, startIndex, endIndex);
        };

        function jQuerify(func, returnThis) {
            return function() {
                var el = this.jquery ? this[0] : this;
                var nodeName = el.nodeName.toLowerCase();

                if (el.nodeType == 1 && (nodeName == "textarea" || (nodeName == "input" && el.type == "text"))) {
                    var args = [el].concat(Array.prototype.slice.call(arguments));
                    var result = func.apply(this, args);
                    if (!returnThis) {
                        return result;
                    }
                }
                if (returnThis) {
                    return this;
                }
            };
        }

        $.fn.extend({
            getSelection: jQuerify(getSelection, false),
            setSelection: jQuerify(setSelection, true),
            collapseSelection: jQuerify(collapseSelection, true),
            deleteSelectedText: jQuerify(deleteSelectedText, true),
            deleteText: jQuerify(deleteText, true),
            extractSelectedText: jQuerify(extractSelectedText, false),
            insertText: jQuerify(insertText, true),
            replaceSelectedText: jQuerify(replaceSelectedText, true),
            surroundSelectedText: jQuerify(surroundSelectedText, true)
        });

        $.fn.rangyInputs = {
            getSelection: getSelection,
            setSelection: setSelection,
            collapseSelection: collapseSelection,
            deleteSelectedText: deleteSelectedText,
            deleteText: deleteText,
            extractSelectedText: extractSelectedText,
            insertText: insertText,
            replaceSelectedText: replaceSelectedText,
            surroundSelectedText: surroundSelectedText
        };
    });
})(jQuery);

//@author languid
//editor
;Motie = Motie || {};
Motie.editor = Base.extend({
	constructor: function(params){
		var setting = {
			 content: null
			,imgCount: 0
			,musCount: 0
			
			,caller: 'main'
			
			,autoComposeHandle: null
			,wordCal: true
			,wordStatus: null
			
			,articleId: 0
			,type: 5
			
			,addMusicHandle: null
			,addVideoHandle: null
			,addLinkHandle: null

			,uploadImgHandle: null
			,uploadStatus: null
			,uploadImgUrl: MotieHost+'/ajax/articleImg/tempadd'
			,uploadExt: /^(jpg|jpeg|gif|png)$/i
			,uploadErrorMsg: '?????????  JPG???jpeg??? GIF???PNG ???????????????'
			,uploadingText: '???????????????...'
			,uploadingClass: 'uploading'
			,uploadFileName: 'uploadfile'
			
			,onUploadComplete: $.noop
			,onDeleteImage: $.noop
			,onDeleteVideo: $.noop
			
			,delImgUrl: ''
			,imgAppendTo: '#imageLabel'
			,imgSelector: '.articleImage'
			
			,musAppendTo: '#musicLabel'
			,musSelector: '.articleMusic'
			,videoSelector: '.articleVideo'
			,onAddMusic: $.noop
			,onAddVideo: $.noop
			,onDeleteMusic: $.noop
		},
		
		_self = this;
		
		if(params){
			$.extend(setting, params)
		}
		
		this.setting 		= setting;
		this.imgCount 		= setting.imgCount;
		this.musCount 		= setting.musCount;
		this.videoCount 	= setting.videoCount;
		this.content 		= setting.content !==null && $(setting.content);
		this.wordStatus 	= setting.wordStatus !== null && $(setting.wordStatus);
		this.uploadHandle 	= setting.uploadImgHandle !== null && $(setting.uploadImgHandle);
		this.linkHandle 	= setting.addLinkHandle !== null && $(setting.addLinkHandle);
		this.musicHandle 	= setting.addMusicHandle !== null && $(setting.addMusicHandle);
		this.videoHandle    = setting.addVideoHandle !== null && $(setting.addVideoHandle);
		this.acHandle 		= setting.autoComposeHandle !== null && $(setting.autoComposeHandle);
		
		this.imgLabel 		= setting.imgAppendTo !== null && $(setting.imgAppendTo);
		this.musLabel 		= setting.musAppendTo !== null && $(setting.musAppendTo);
		this.videoLabel 	= setting.videoAppendTo !== null && $(setting.videoAppendTo);
		
		//setup
		this.uploadHandle.length && this.uploadImg();
		this.linkHandle.length && this.addLink();
		this.acHandle.length && this.autoCompose();
		this.musicHandle.length && this.addMusic();
		this.videoHandle.length && this.addVideo();
		
		this.contentPos = 0;
		this.content.click(function(){
			_self.contentPos = _self.content.getSelection().end
		});
		
		setting.wordCal && this.content.length && this.wordStatus.length && this.wordCal();
		
		var imgs = this.imgLabel.find(setting.imgSelector);
		imgs.length && this.bindRemoveItem(imgs, 'img', true) && this.bindLimit(imgs);
		
		var muss = this.musLabel.find(setting.musSelector);
		muss.length && this.bindRemoveItem(muss, 'mus', true)
		
		var videos = this.videoLabel.find(setting.videoSelector);
		videos.length && this.bindRemoveItem(videos, 'video', true)
	}
	,wordCal: function(){
		var _self = this;
		new Mo.wordsCalculation(this.content,this.wordStatus).Cal(this.content.text());
		return this;
	}
	,bindRemoveItem: function(imgs, type, ajax){
		var _self = this, setting = this.setting, content = _self.content;
		imgs.each(function(){
			var $this = $(this), 
				$del = $this.find('.remove');
			
			$this.hover(function(){
				$del.removeClass('hidden')
			},function(){
				$del.addClass('hidden')
			})
			
			$del.click(function(){
	    		var picName = $.trim($this.find('.imgName').val()), icon = picName.substring(3,picName.length-1);
	    		content.val(content.val().replace(new RegExp(picName,'gm'),''));
	    		$this.remove();
	    		switch(type){
	    			case 'mus': 
	    				ajax && $.getJSON(setting.delImgUrl, { resType: 3, id : setting.articleId , type: setting.type , icon: icon });
	    				setting.onDeleteMusic(_self); 
	    				break;
	    			case 'img': 
	    				ajax && $.getJSON(setting.delImgUrl, { resType: 1, id : setting.articleId , type: setting.type , icon: icon });
	    				setting.onDeleteImage(_self); 
	    				break;
	    			case 'video': 
	    				ajax && $.getJSON(setting.delImgUrl, { resType: 2, id : setting.articleId , type: setting.type , icon: icon });
	    				setting.onDeleteVideo(_self); 
	    				break;
	    		}
			})
		})
	}
	,bindLimit: function(area){
		
		$(area).each(function(){
			var $this = $(this), textarea = $this.find('.textarea'), status = $this.find('.status');
			textarea.keyup(function(){
				!Motie.limitTextarea(textarea, 30, status) ? textarea.attr('long','long') : textarea.removeAttr('long')
			}).trigger('keyup')
		})
		return this;
	}
	,autoCompose: function(){
		var _self = this;
		this.acHandle.click(function(){
			_self.content.val(Motie.editor.formatText(_self.content.val()))
		})
	}
	,uploadImg: function(){
		var _self = this, setting = _self.setting, status = $(setting.uploadStatus), content = this.content, textarea = content[0],
			imgLabel = this.imgLabel, uploading = false, handle = this.uploadHandle, tu = Motie.TextareaUtils;
			
		new AjaxUpload(handle, {  
       		 action: setting.uploadImgUrl
            ,name: setting.uploadFileName 
            ,onSubmit: function (file, ext){
				if(uploading){
					return false
				}
                if (!(ext && setting.uploadExt.test(ext))) {
                	Mo.ui.info(handle,_self.setting.uploadErrorMsg,'mo-ui-info-warning')
                    return false;  
                }
				handle.text('?????????..')
                uploading = true;
             }  
            ,onComplete: function (file, html) { 
            	uploading = false;
            	handle.text('????????????');
            	if($.trim(html) == ''){
            		Mo.ui.info(handle,'??????????????????5M','mo-ui-info-warning')
            		return ;
            	}
            	setting.onUploadComplete(_self, file, html);
            	var jhtml = $(html), content = _self.content;
            	
			   	imgLabel.append(jhtml);
			   	
			   	var aiLength = imgLabel.find(setting.imgSelector);
			 	
	        	if(_self.imgCount == 0){
	        	 	_self.imgCount = aiLength.length;
	        	} else{
	        		if(_self.imgCount < aiLength.length){
	        			_self.imgCount = aiLength.length;
	        		}else{
	        			_self.imgCount++;
	        		}
	        	}
        		jhtml.find(".imgName").val("<??????"+ _self.imgCount +">");
        		
        		jhtml.find("label").eq(0).attr("for", "al" + _self.imgCount).end()
        						   .eq(1).attr("for", "ac" + _self.imgCount).end()
        						   .eq(2).attr("for", "ar" + _self.imgCount);
        						   
        		jhtml.find(".posi").attr("name", "posi" + _self.imgCount)
        						   .eq(0).attr("id", "al" + _self.imgCount).end()
        						   .eq(1).attr("id", "ac" + _self.imgCount).end()
        						   .eq(2).attr("id", "ar" + _self.imgCount);
        		
			   	_self.bindLimit(jhtml);
			   	_self.bindRemoveItem(jhtml, 'img', false)
	        	
	        	var valu = '<??????' + _self.imgCount + '>';
			   	content.insertText(valu, _self.contentPos);
			   	_self.contentPos += _self.contentPos+valu.length
			   	content.setSelection(_self.contentPos,_self.contentPos)
            }  
        }); 
	}
   ,addLink: function(){
	   var _self = this, setting = _self.setting, caller = setting.caller, content = this.content, vform = null, tu = Motie.TextareaUtils, pos = 1;
	   new Mo.layer({
		    handle: this.linkHandle
		   ,tpl: caller == 'main' ? Mo.layer.tplStore.basicTpl : Mo.layer.tplStore.SiteBasicTpl
		   ,data: {
			   html: caller == 'main' ? Mo.editor.addLinkTemplate : Mo.editor.addLinkTemplateSite,
			   title: '????????????'
		   }
		   ,width: 550
		   ,destroy: false
		   ,onShow: function(){
		   		vform.resetForm();
		   }
		   ,onRendered: function(that){
		   		var layer = that.layer, addLinkButton = $("#addlink"), texts = $('#texts'), url = $('#url'), form = layer.find('form');
		   		
		   		vform = form.validate({
		   			debug: true,
		   			messages: {
		   				texts: {
		   					required: '????????????????????????'
		   				},
		   				url: {
		   					required: '??????????????????',
		   					url: '?????????????????????'
		   				}
		   			},
		   			errorClass: 'is-error',
		   			errorPlacement: function(error,ele){
		   				$('#'+ele.attr('name')+'-msg').html(error)
		   			}
		   		});
		   		
		   		addLinkButton.click(function(){
		   			if(vform.form()){
			   			var valu ='';
						valu = valu + '<a class="bule" href="' + url.val() + '">' + texts.val() + '</a>';
						content.insertText(valu, _self.contentPos)
						that.hideLayer()
					}
		   		});
		   		
		   }
	   });
   }
   ,addVideo: function(){
	   var _self = this, setting = this.setting, content = this.content, vform, tu = Motie.TextareaUtils;
  		
//  		jQuery.validator.addMethod("video", function(value, element) { 
//			return this.optional(element) || /^http:\/\/.*\.swf$/i.test(value); 
//		}, "??????????????????"); 
  		
  		new Mo.layer({
  			handle: this.videoHandle
  			,data:{ html : Motie.editor.addVideoTemplate }
  			,width: 550
  			,destroy: true
  			,onRendered: function(that){
  				var layer = that.layer, addvideo = layer.find('#addvideo'), form = layer.find('form'), src = layer.find('#videosrc');
  				form.submit(function(){
  					return false;
  				})
  				addvideo.click(function(){
  					//if(vform.form()){
  						var valu ='', url = src.val();
  						_self.videoCount++;
  						valu = '<??????'+_self.videoCount+'>';
						var data = {};
						data = {
							src: url,
							count: _self.videoCount,
							width: 200,
							height: 180
						}
						content.insertText(valu, _self.contentPos)
						
						var $html = $(Mustache.to_html(Motie.editor.videoTpl, data));
						_self.videoLabel.append( $html );
						_self.bindRemoveItem( $html, 'video' );
						setting.onAddVideo(_self);
						that.hideLayer();
						return false;
  					//}
  				});
  				
  			}
  			
  		});
   }
   ,addMusic: function(){
   		var _self = this, setting = this.setting, content = this.content, vform, tu = Motie.TextareaUtils;
   		
   		jQuery.validator.addMethod("music", function(value, element) { 
			return this.optional(element) || /^http:\/\/www\.xiami\.com\/widget\/\d+_\d+\/singlePlayer.swf$/i.test(value) 
									  	  || /^http:\/\/www\.xiami\.com\/song\/\d+$/i.test(value) 
									  	  || /http:\/\/box\.baidu\.com\/widget\/flash\/mbsong\.swf\?name=.+&artist=.+/i.test(value); 
		}, "??????????????????"); 
   		
   		new Mo.layer({
   			handle: this.musicHandle
   			,data:{ html : Motie.editor.addMusicTemplate }
   			,width: 550
   			,destroy: false
   			,onHide: function(_self){
   				vform.resetForm();
   			}
   			,onRendered: function(that){
   				var layer = that.layer, addmusic = layer.find('#addmusic'), form = layer.find('form'), src = layer.find('#src');
   				vform = form.validate({
   					debug: true,
   					rules: {
   						src: {
   							music: true,
   							required: true
   						}
   					},
   					messages: {
   						src: {
   							music: '??????????????????',
   							required: '??????????????????'
   						}
   					},
   					errorClass: 'is-error',
		   			errorPlacement: function(error,ele){
		   				$('#'+ele.attr('name')+'-msg').html(error)
		   			}
   				});
   				
   				addmusic.click(function(){
   					if(vform.form()){
   						var valu ='', url = src.val();
   						_self.musCount++;
   						valu = '<??????'+_self.musCount+'>';
						var data = {};
						if(url.search('xiami') != -1){
							if(url.search('widget') == -1){
								url = 'http://www.xiami.com/widget/0_'+url.replace(/[^\d]*/i,'')+'/singlePlayer.swf';
							}
							data = {
								src: url,
								count: _self.musCount,
								width: 275,
								height: 33
							}
						}else if(url.search('baidu')){
							data = {
								src: url,
								count: _self.musCount,
								width: 400,
								height: 95
							}
						}
						content.insertText(valu, _self.contentPos)
						
						var $html = $(Mustache.to_html(Motie.editor.musTpl, data));
						_self.musLabel.append( $html );
						_self.bindRemoveItem( $html, 'mus' );
						setting.onAddMusic(_self);
						that.hideLayer()
   					}
   				});
   				
   			}
   			
   		});
   }
}, {
	 addLinkTemplate:  '<a href="javascript:;" class="fr pop-close"></a><h3><img src="'+ImgMotie+'/_assets/title-review-the-book.gif" class="fl" />????????????</h3><div class="sp-20"></div><div class="txtbox-editor"><form><table class="for-table" width="100%"><tbody><tr><td class="col1 vm" style="width:80px">???????????????</td><td class="col2" width="330"><input name="texts" id="texts" class="text-single required" style="width: 300px;" /></td><td class="vm desc" id="texts-msg"></td></tr><tr><td class="col1">?????????</td><td class="col2"><input name="url" id="url" style="width: 300px;" class="text-single required url" /></td><td class="vm desc" id="url-msg">??????http://??????</td></tr><tr><td></td><td colspan="2"><div class="sp-10"></div><input type="submit" value="??????" title="??????" id="addlink" class="btn-submit btn-has-text fl" style="margin-right: 15px;" alt=""><div class="cl"></div></td></tr></tbody></table></form></div>'
	,addLinkTemplateSite:  '<form><div class="c-item"><label class="c-title">???????????????</label><input name="texts" id="texts" class="text required" style="width: 300px;" /><span id="texts-msg"></span></div><div class="c-item"><label class="c-title">?????????</label><input name="url" id="url" style="width: 300px;" class="text required url" /><span id="url-msg">??????http://??????</span></div><div class="c-submit"><a href="javascript:;" title="??????" id="addlink" class="button" style="margin-right: 15px;">??????</a><a href="javascript:;" class="pop-close button">??????</a></div></form>'
	,addMusicTemplate: '<a href="javascript:;" class="fr pop-close"></a><h3><img src="'+ImgMotie+'/_assets/title-review-the-book.gif" class="fl" />????????????</h3><div class="sp-20"></div><div class="txtbox-editor"><form><p class="desc">??????????????? <span class="color-f60">??????</span> ??? <span class="color-f60">??????</span> ???Flash???????????????</p><div class="sp-10"></div><table class="for-table" width="100%"><tbody><tr><td class="col1 vm al">?????????</td><td class="col2" width="330"><input name="src" id="src" style="width: 310px;" class="text-single required" /></td><td class="vm desc" id="src-msg"></td></tr><tr><td></td><td colspan="2"><div class="sp-10"></div><input type="submit" value="??????" title="??????" id="addmusic" class="btn-submit btn-has-text fl" style="margin-right: 15px;" alt=""><a href="javascript:;" class="pop-close fl btn-submit btn-has-text">??????</a><div class="cl"></div></td></tr></tbody></table></form></div>'
	,addVideoTemplate: '<a href="javascript:;" class="fr pop-close"></a><h3><img src="'+ImgMotie+'/_assets/title-review-the-book.gif" class="fl" />????????????</h3><div class="sp-20"></div><div class="txtbox-editor"><form><p class="desc">?????????flash?????????</p><div class="sp-10"></div><table class="for-table" width="100%"><tbody><tr><td class="col1 vm al">?????????</td><td class="col2" width="330"><input name="src" id="videosrc" style="width: 310px;" class="text-single" /></td><td class="vm desc" id="src-msg"></td></tr><tr><td></td><td colspan="2"><div class="sp-10"></div><input type="submit" value="??????" title="??????" id="addvideo" class="btn-submit btn-has-text fl" style="margin-right: 15px;" alt=""><a href="javascript:;" class="pop-close fl btn-submit btn-has-text">??????</a><div class="cl"></div></td></tr></tbody></table></form></div>'
	,imgTpl: '\
		<li class="articleImage">\
			<table width="100%">\
				<tr>\
					<td width="160">\
						<img src="{{url}}" alt="" class="img" />\
						<input type="hidden" name="objectImage" value="{{url}}">\
					</td>\
					<td width="20" rowspan="2"></td>\
					<td width="480">\
						<textarea name="" id="" class="textarea input"></textarea>\
					</td>\
					<td rowspan="2"><span class="remove fr"></span></td>\
				</tr>\
				<tr>\
					<td>\
						<input type="text" name="imgName" class="imgName" id="" value="<??????1>" />\
					</td>\
					<td>\
						<em class="desc fr fb">????????????(<span class="status">0</span>)</em>\
						<label for="al1"><input type="radio" name="posi{{count}}" id="al{{count}}" class="radio" />??????</label>\
						<label for="ac1"><input type="radio" name="posi{{count}}" checked="checked" id="ac{{count}}" class="radio" />??????</label>\
						<label for="ar1"><input type="radio" name="posi{{count}}" id="ar{{count}}" class="radio" />??????</label>\
					</td>\
				</tr>\
			</table>\
		</li>\
	'
	,musTpl: '\
		<li class="articleMusic">\
			<table width="100%">\
				<tr>\
					<td width="60"><input type="text" name="musName" class="imgName" id="" value="<??????{{count}}>" /></td>\
					<td width="20"></td>\
					<td width="600">\
						<input type="hidden" name="musUrl" value="{{src}}" />\
						<p>\
							<input type="text" class="input" name="musDesc" maxlength="30" />\
						</p>\
						<p><embed src="{{src}}" type="application/x-shockwave-flash" width="{{width}}" height="{{height}}" wmode="transparent"></embed></p>\
					</td>\
					<td width="26"><span class="remove fr"></span></td>\
				</tr>\
			</table>\
		</li>\
	'
	,videoTpl: '\
		<li class="articleVideo">\
			<table width="100%">\
				<tr>\
					<td width="60"><input type="text" name="videoName" class="imgName" id="" value="<??????{{count}}>" /></td>\
					<td width="20"></td>\
					<td width="600">\
						<input type="hidden" name="videoUrl" value="{{src}}" />\
						<p>\
							<input type="text" class="input" name="videoDesc" maxlength="30" />\
						</p>\
						<p><embed src="{{src}}" type="application/x-shockwave-flash" width="{{width}}" height="{{height}}" wmode="transparent"></embed></p>\
					</td>\
					<td width="26"><span class="remove fr"></span></td>\
				</tr>\
			</table>\
		</li>\
	'
	,formatText: function(content){
		var lines = content.split('(\n\r)|(\n)'), line = null, i = 0, allLine = [];
		
		for(var len = lines.length; i< len; i++){
			var line = lines[i];
			if(line == ''){
				allLine.push('\n\r');
			}else{
				allLine.push(replaceSpace(line));
			}
		}
		
		function replaceSpace(str){
			var links = str.match(/(<a\b[^>]+>(.*?)<\/a>)/ig), links2 = [];
			str = "\u3000\u3000"+str.replace(/[ \u3000\t\r]/g, "").replace(/[\n]+/g, "\r\n\r\n\u3000\u3000");
			if(links && links.length){
				links2 = str.match(/(<a[^>]+>(.*?)<\/a>)/ig);
				for(var i=0,len = links2.length; i<len;i++){
					str = str.replace(links2[i],links[i])
				}
			}
			return str;
		}
		
		return allLine.join('');
	}
});

;Motie.editor.article = function(params){
	
	$(window).load(function(){
		$('.articleImage').length && $('#imageLabel').removeClass('hidden')
		$('.articleMusic').length && $('#musicLabel').removeClass('hidden')
		$('.articleVideo').length && $('#videoLabel').removeClass('hidden')
	})
	
	var set = {
		onUploadComplete: function(s, f, h){
			$('#imageLabel').removeClass('hidden')
		},
		onDeleteImage: function(){
			!$('.articleImage').length && $('#imageLabel').addClass('hidden')
		},
		onAddVideo: function(){
			$('#videoLabel').removeClass('hidden')
		},
		onAddMusic: function(){
			$('#musicLabel').removeClass('hidden')
		},
		onDeleteMusic: function(){
			!$('.articleMusic').length && $('#musicLabel').addClass('hidden')
		},
		onDeleteVideo: function(){
			!$('.articleVideo').length && $('#videoLabel').addClass('hidden')
		}
	}
	
	$.extend(set, params);
	
	new Motie.editor(set).bindLimit('.articleImage, .articleMusic')
}

