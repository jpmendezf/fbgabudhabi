/**handles:gform_json,gform_gravityforms**/
!function($){"use strict";var escape=/["\\\x00-\x1f\x7f-\x9f]/g,meta={"\b":"\\b","\t":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},hasOwn=Object.prototype.hasOwnProperty;$.toJSON="object"==typeof JSON&&JSON.stringify?JSON.stringify:function(t){if(null===t)return"null";var e,r,n,o,i=$.type(t);if("undefined"!==i){if("number"===i||"boolean"===i)return String(t);if("string"===i)return $.quoteString(t);if("function"==typeof t.toJSON)return $.toJSON(t.toJSON());if("date"===i){var f=t.getUTCMonth()+1,u=t.getUTCDate(),s=t.getUTCFullYear(),a=t.getUTCHours(),l=t.getUTCMinutes(),c=t.getUTCSeconds(),p=t.getUTCMilliseconds();return 10>f&&(f="0"+f),10>u&&(u="0"+u),10>a&&(a="0"+a),10>l&&(l="0"+l),10>c&&(c="0"+c),100>p&&(p="0"+p),10>p&&(p="0"+p),'"'+s+"-"+f+"-"+u+"T"+a+":"+l+":"+c+"."+p+'Z"'}if(e=[],$.isArray(t)){for(r=0;r<t.length;r++)e.push($.toJSON(t[r])||"null");return"["+e.join(",")+"]"}if("object"==typeof t){for(r in t)if(hasOwn.call(t,r)){if(i=typeof r,"number"===i)n='"'+r+'"';else{if("string"!==i)continue;n=$.quoteString(r)}i=typeof t[r],"function"!==i&&"undefined"!==i&&(o=$.toJSON(t[r]),e.push(n+":"+o))}return"{"+e.join(",")+"}"}}},$.evalJSON="object"==typeof JSON&&JSON.parse?JSON.parse:function(str){return eval("("+str+")")},$.secureEvalJSON="object"==typeof JSON&&JSON.parse?JSON.parse:function(str){var filtered=str.replace(/\\["\\\/bfnrtu]/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,"");if(/^[\],:{}\s]*$/.test(filtered))return eval("("+str+")");throw new SyntaxError("Error parsing JSON, source is not valid.")},$.quoteString=function(t){return t.match(escape)?'"'+t.replace(escape,function(t){var e=meta[t];return"string"==typeof e?e:(e=t.charCodeAt(),"\\u00"+Math.floor(e/16).toString(16)+(e%16).toString(16))})+'"':'"'+t+'"'}}(jQuery);
function gformBindFormatPricingFields(){jQuery(".ginput_amount, .ginput_donation_amount").bind("change",function(){gformFormatPricingField(this)}),jQuery(".ginput_amount, .ginput_donation_amount").each(function(){gformFormatPricingField(this)})}function Currency(e){this.currency=e,this.toNumber=function(e){return this.isNumeric(e)?parseFloat(e):gformCleanNumber(e,this.currency.symbol_right,this.currency.symbol_left,this.currency.decimal_separator)},this.toMoney=function(e,r){if(r=r||!1,r||(e=gformCleanNumber(e,this.currency.symbol_right,this.currency.symbol_left,this.currency.decimal_separator)),e===!1)return"";e+="",negative="","-"==e[0]&&(e=parseFloat(e.substr(1)),negative="-"),money=this.numberFormat(e,this.currency.decimals,this.currency.decimal_separator,this.currency.thousand_separator),"0.00"==money&&(negative="");var t=this.currency.symbol_left?this.currency.symbol_left+this.currency.symbol_padding:"",i=this.currency.symbol_right?this.currency.symbol_padding+this.currency.symbol_right:"";return money=negative+this.htmlDecode(t)+money+this.htmlDecode(i),money},this.numberFormat=function(e,r,t,i,n){var n="undefined"==typeof n;e=(e+"").replace(",","").replace(" ","");var o=isFinite(+e)?+e:0,a=isFinite(+r)?Math.abs(r):0,l="undefined"==typeof i?",":i,f="undefined"==typeof t?".":t,s="",u=function(e,r){var t=Math.pow(10,r);return""+Math.round(e*t)/t};return"0"==r?(o+=1e-10,s=(""+Math.round(o)).split(".")):-1==r?s=(""+o).split("."):(o+=1e-10,s=u(o,a).split(".")),s[0].length>3&&(s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,l)),n&&(s[1]||"").length<a&&(s[1]=s[1]||"",s[1]+=new Array(a-s[1].length+1).join("0")),s.join(f)},this.isNumeric=function(e){return gformIsNumber(e)},this.htmlDecode=function(e){var r,t,i=e,n=i.match(/&#[0-9]{1,5};/g);if(null!=n)for(var o=0;o<n.length;o++)t=n[o],r=t.substring(2,t.length-1),i=r>=-32768&&65535>=r?i.replace(t,String.fromCharCode(r)):i.replace(t,"");return i}}function gformCleanNumber(e,r,t,i){var n="",o="",a="",l=!1;e+=" ",e=e.replace(/&.*?;/g,""),e=e.replace(r,""),e=e.replace(t,"");for(var f=0;f<e.length;f++)a=e.substr(f,1),parseInt(a)>=0&&parseInt(a)<=9||a==i?n+=a:"-"==a&&(l=!0);for(var f=0;f<n.length;f++)a=n.substr(f,1),a>="0"&&"9">=a?o+=a:a==i&&(o+=".");return l&&(o="-"+o),!!gformIsNumber(o)&&parseFloat(o)}function gformGetDecimalSeparator(e){var r;switch(e){case"currency":var t=new Currency(gf_global.gf_currency_config);r=t.currency.decimal_separator;break;case"decimal_comma":r=",";break;default:r="."}return r}function gformIsNumber(e){return!isNaN(parseFloat(e))&&isFinite(e)}function gformIsNumeric(e,r){switch(r){case"decimal_dot":var t=new RegExp("^(-?[0-9]{1,3}(?:,?[0-9]{3})*(?:.[0-9]+)?)$");return t.test(e);case"decimal_comma":var t=new RegExp("^(-?[0-9]{1,3}(?:.?[0-9]{3})*(?:,[0-9]+)?)$");return t.test(e)}return!1}function gformDeleteUploadedFile(e,r,t){var i=jQuery("#field_"+e+"_"+r),n=jQuery(t).parent().index();i.find(".ginput_preview").eq(n).remove(),i.find('input[type="file"]').removeClass("gform_hidden"),i.find(".ginput_post_image_file").show(),i.find('input[type="text"]').val("");var o=jQuery("#gform_uploaded_files_"+e).val();if(o){var a=jQuery.secureEvalJSON(o);if(a){var l="input_"+r,f=i.find("#gform_multifile_upload_"+e+"_"+r);if(f.length>0){a[l].splice(n,1);var s=f.data("settings"),u=s.gf_vars.max_files;jQuery("#"+s.gf_vars.message_id).html(""),a[l].length<u&&gfMultiFileUploader.toggleDisabled(s,!1)}else a[l]=null;jQuery("#gform_uploaded_files_"+e).val(jQuery.toJSON(a))}}}function gformIsHidden(e){return"none"==e.parents(".gfield").not(".gfield_hidden_product").css("display")}function gformCalculateTotalPrice(e){if(_gformPriceFields[e]){var r=0;_anyProductSelected=!1;for(var t=0;t<_gformPriceFields[e].length;t++)r+=gformCalculateProductPrice(e,_gformPriceFields[e][t]);if(_anyProductSelected){var i=gformGetShippingPrice(e);r+=i}window.gform_product_total&&(r=window.gform_product_total(e,r)),r=gform.applyFilters("gform_product_total",r,e);var n=jQuery(".ginput_total_"+e);if(n.length>0){var o=n.next().val(),a=gformFormatMoney(r,!0);o!=r&&n.next().val(r).change(),a!=n.first().text()&&n.html(a)}}}function gformGetShippingPrice(e){var r=jQuery(".gfield_shipping_"+e+' input[type="hidden"], .gfield_shipping_'+e+" select, .gfield_shipping_"+e+" input:checked"),t=0;return 1!=r.length||gformIsHidden(r)||(t=r.attr("type")&&"hidden"==r.attr("type").toLowerCase()?r.val():gformGetPrice(r.val())),gformToNumber(t)}function gformGetFieldId(e){var r=jQuery(e).attr("id"),t=r.split("_");if(t.length<=0)return 0;var i=t[t.length-1];return i}function gformCalculateProductPrice(e,r){var t="_"+e+"_"+r;jQuery(".gfield_option"+t+", .gfield_shipping_"+e).find("select").each(function(){var r=jQuery(this),t=gformGetPrice(r.val()),i=r.attr("id").split("_")[2];r.children("option").each(function(){var r=jQuery(this),n=gformGetOptionLabel(r,r.val(),t,e,i);r.html(n)}),r.trigger("chosen:updated")}),jQuery(".gfield_option"+t).find(".gfield_checkbox").find("input:checkbox").each(function(){var r=jQuery(this),t=r.attr("id"),i=t.split("_")[2],n=t.replace("choice_","#label_"),o=jQuery(n),a=gformGetOptionLabel(o,r.val(),0,e,i);o.html(a)}),jQuery(".gfield_option"+t+", .gfield_shipping_"+e).find(".gfield_radio").each(function(){var r=0,t=jQuery(this),i=t.attr("id"),n=i.split("_")[2],o=t.find("input:radio:checked").val();o&&(r=gformGetPrice(o)),t.find("input:radio").each(function(){var t=jQuery(this),i=t.attr("id").replace("choice_","#label_"),o=jQuery(i);if(o){var a=gformGetOptionLabel(o,t.val(),r,e,n);o.html(a)}})});var i=gformGetBasePrice(e,r),n=gformGetProductQuantity(e,r);return n>0&&(jQuery(".gfield_option"+t).find("input:checked, select").each(function(){gformIsHidden(jQuery(this))||(i+=gformGetPrice(jQuery(this).val()))}),_anyProductSelected=!0),i*=n,i=Math.round(100*i)/100}function gformGetProductQuantity(e,r){if(!gformIsProductSelected(e,r))return 0;var t,i,n=jQuery("#ginput_quantity_"+e+"_"+r);if(n.length>0)t=n.val();else if(n=jQuery(".gfield_quantity_"+e+"_"+r+" :input"),t=1,n.length>0){t=n.val();var o=n.attr("id"),a=gf_get_input_id_by_html_id(o);i=gf_get_field_number_format(a,e,"value")}i||(i="currency");var l=gformGetDecimalSeparator(i);return t=gformCleanNumber(t,"","",l),t||(t=0),t}function gformIsProductSelected(e,r){var t="_"+e+"_"+r,i=jQuery("#ginput_base_price"+t+", .gfield_donation"+t+' input[type="text"], .gfield_product'+t+" .ginput_amount");return!(!i.val()||gformIsHidden(i))||(i=jQuery(".gfield_product"+t+" select, .gfield_product"+t+" input:checked, .gfield_donation"+t+" select, .gfield_donation"+t+" input:checked"),!(!i.val()||gformIsHidden(i)))}function gformGetBasePrice(e,r){var t="_"+e+"_"+r,i=0,n=jQuery("#ginput_base_price"+t+", .gfield_donation"+t+' input[type="text"], .gfield_product'+t+" .ginput_amount");if(n.length>0)i=n.val(),gformIsHidden(n)&&(i=0);else{n=jQuery(".gfield_product"+t+" select, .gfield_product"+t+" input:checked, .gfield_donation"+t+" select, .gfield_donation"+t+" input:checked");var o=n.val();o&&(o=o.split("|"),i=o.length>1?o[1]:0),gformIsHidden(n)&&(i=0)}var a=new Currency(gf_global.gf_currency_config);return i=a.toNumber(i),i===!1?0:i}function gformFormatMoney(e,r){if(!gf_global.gf_currency_config)return e;var t=new Currency(gf_global.gf_currency_config);return t.toMoney(e,r)}function gformFormatPricingField(e){if(gf_global.gf_currency_config){var r=new Currency(gf_global.gf_currency_config),t=r.toMoney(jQuery(e).val());jQuery(e).val(t)}}function gformToNumber(e){var r=new Currency(gf_global.gf_currency_config);return r.toNumber(e)}function gformGetPriceDifference(e,r){var t=parseFloat(r)-parseFloat(e);return price=gformFormatMoney(t,!0),t>0&&(price="+"+price),price}function gformGetOptionLabel(e,r,t,i,n){e=jQuery(e);var o=gformGetPrice(r),a=e.attr("price"),l=e.html().replace(/<span(.*)<\/span>/i,"").replace(a,""),f=gformGetPriceDifference(t,o);f=0==gformToNumber(f)?"":" "+f,e.attr("price",f);var s="option"==e[0].tagName.toLowerCase()?" "+f:"<span class='ginput_price'>"+f+"</span>",u=l+s;return window.gform_format_option_label&&(u=gform_format_option_label(u,l,s,t,o,i,n)),u}function gformGetProductIds(e,r){for(var t=jQuery(r).hasClass(e)?jQuery(r).attr("class").split(" "):jQuery(r).parents("."+e).attr("class").split(" "),i=0;i<t.length;i++)if(t[i].substr(0,e.length)==e&&t[i]!=e)return{formId:t[i].split("_")[2],productFieldId:t[i].split("_")[3]};return{formId:0,fieldId:0}}function gformGetPrice(e){var r=e.split("|"),t=new Currency(gf_global.gf_currency_config);return r.length>1&&t.toNumber(r[1])!==!1?t.toNumber(r[1]):0}function gformRegisterPriceField(e){_gformPriceFields[e.formId]||(_gformPriceFields[e.formId]=new Array);for(var r=0;r<_gformPriceFields[e.formId].length;r++)if(_gformPriceFields[e.formId][r]==e.productFieldId)return;_gformPriceFields[e.formId].push(e.productFieldId)}function gformInitPriceFields(){jQuery(".gfield_price").each(function(){var e=gformGetProductIds("gfield_price",this);gformRegisterPriceField(e),jQuery(this).on("change",'input[type="text"], input[type="number"], select',function(){var e=gformGetProductIds("gfield_price",this);0==e.formId&&(e=gformGetProductIds("gfield_shipping",this)),jQuery(document).trigger("gform_price_change",[e,this]),gformCalculateTotalPrice(e.formId)}),jQuery(this).on("click",'input[type="radio"], input[type="checkbox"]',function(){var e=gformGetProductIds("gfield_price",this);0==e.formId&&(e=gformGetProductIds("gfield_shipping",this)),jQuery(document).trigger("gform_price_change",[e,this]),gformCalculateTotalPrice(e.formId)})});for(formId in _gformPriceFields)_gformPriceFields.hasOwnProperty(formId)&&gformCalculateTotalPrice(formId)}function gformShowPasswordStrength(e){var r=jQuery("#"+e).val(),t=jQuery("#"+e+"_2").val(),i=gformPasswordStrength(r,t),n=window.gf_text["password_"+i];jQuery("#"+e+"_strength").val(i),jQuery("#"+e+"_strength_indicator").removeClass("blank mismatch short good bad strong").addClass(i).html(n)}function gformPasswordStrength(e,r){var t,i,n=0;return e.length<=0?"blank":e!=r&&r.length>0?"mismatch":e.length<4?"short":(e.match(/[0-9]/)&&(n+=10),e.match(/[a-z]/)&&(n+=26),e.match(/[A-Z]/)&&(n+=26),e.match(/[^a-zA-Z0-9]/)&&(n+=31),t=Math.log(Math.pow(n,e.length)),i=t/Math.LN2,40>i?"bad":56>i?"good":"strong")}function gformAddListItem(e,r){var t=jQuery(e);if(!t.hasClass("gfield_icon_disabled")){var i=t.parents(".gfield_list_group"),n=i.clone(),o=i.parents(".gfield_list_container"),a=n.find(":input:last").attr("tabindex");n.find("input, select").attr("tabindex",a).not(":checkbox, :radio").val(""),n.find(":checkbox, :radio").prop("checked",!1),n=gform.applyFilters("gform_list_item_pre_add",n,i),i.after(n),gformToggleIcons(o,r),gformAdjustClasses(o)}}function gformDeleteListItem(e,r){var t=jQuery(e),i=t.parents(".gfield_list_group"),n=i.parents(".gfield_list_container");i.remove(),gformToggleIcons(n,r),gformAdjustClasses(n)}function gformAdjustClasses(e){var r=e.find(".gfield_list_group");r.each(function(e){var r=jQuery(this),t=(e+1)%2==0?"gfield_list_row_even":"gfield_list_row_odd";r.removeClass("gfield_list_row_odd gfield_list_row_even").addClass(t)})}function gformToggleIcons(e,r){var t=e.find(".gfield_list_group").length,i=e.find(".add_list_item");e.find(".delete_list_item").css("visibility",1==t?"hidden":"visible"),r>0&&t>=r?(i.data("title",e.find(".add_list_item").attr("title")),i.addClass("gfield_icon_disabled").attr("title","")):r>0&&(i.removeClass("gfield_icon_disabled"),i.data("title")&&i.attr("title",i.data("title")))}function gformMatchCard(e){var r=gformFindCardType(jQuery("#"+e).val()),t=jQuery("#"+e).parents(".gfield").find(".gform_card_icon_container");r?(jQuery(t).find(".gform_card_icon").removeClass("gform_card_icon_selected").addClass("gform_card_icon_inactive"),jQuery(t).find(".gform_card_icon_"+r).removeClass("gform_card_icon_inactive").addClass("gform_card_icon_selected")):jQuery(t).find(".gform_card_icon").removeClass("gform_card_icon_selected gform_card_icon_inactive")}function gformFindCardType(e){if(e.length<4)return!1;var r=window.gf_cc_rules,t=new Array;for(type in r)if(r.hasOwnProperty(type))for(i in r[type])if(r[type].hasOwnProperty(i)&&0===r[type][i].indexOf(e.substring(0,r[type][i].length))){t[t.length]=type;break}return 1==t.length&&t[0].toLowerCase()}function gformToggleCreditCard(){jQuery("#gform_payment_method_creditcard").is(":checked")?jQuery(".gform_card_fields_container").slideDown():jQuery(".gform_card_fields_container").slideUp()}function gformInitChosenFields(e,r){return jQuery(e).each(function(){var e=jQuery(this);if("rtl"==jQuery("html").attr("dir")&&e.addClass("chosen-rtl chzn-rtl"),e.is(":visible")&&0==e.siblings(".chosen-container").length){var t=gform.applyFilters("gform_chosen_options",{no_results_text:r},e);e.chosen(t)}})}function gformInitCurrencyFormatFields(e){jQuery(e).each(function(){var e=jQuery(this);e.val(gformFormatMoney(jQuery(this).val()))}).change(function(e){jQuery(this).val(gformFormatMoney(jQuery(this).val()))})}function gformFormatNumber(e,r,t,i){if("undefined"==typeof t)if(window.gf_global){var n=new Currency(gf_global.gf_currency_config);t=n.currency.decimal_separator}else t=".";if("undefined"==typeof i)if(window.gf_global){var n=new Currency(gf_global.gf_currency_config);i=n.currency.thousand_separator}else i=",";var n=new Currency;return n.numberFormat(e,r,t,i,!1)}function gformToNumber(e){var r=new Currency(gf_global.gf_currency_config);return r.toNumber(e)}function getMatchGroups(e,r){for(var t=new Array;r.test(e);){var i=t.length;t[i]=r.exec(e),e=e.replace(""+t[i][0],"")}return t}function gf_get_field_number_format(e,r,t){var i=rgars(window,"gf_global/number_formats/{0}/{1}".format(r,e)),n=!1;return""===i?n:n="undefined"==typeof t?i.price!==!1?i.price:i.value:i[t]}function renderRecaptcha(){jQuery(".ginput_recaptcha").each(function(){var e=jQuery(this),r={sitekey:e.data("sitekey"),theme:e.data("theme")};e.is(":empty")&&(e.data("stoken")&&(r.stoken=e.data("stoken")),grecaptcha.render(this.id,r),gform.doAction("gform_post_recaptcha_render",e))})}function gformValidateFileSize(e,r){if(jQuery(e).closest("div").siblings(".validation_message").length>0)var t=jQuery(e).closest("div").siblings(".validation_message");else var t=jQuery(e).siblings(".validation_message");if(window.FileReader&&window.File&&window.FileList&&window.Blob){var i=e.files[0];if(i.size>r){t.html(i.name+" - "+gform_gravityforms.strings.file_exceeds_limit);var n=jQuery(e);n.replaceWith(n.val("").clone(!0))}else t.html("")}}function gformInitSpinner(e,r){"undefined"!=typeof r&&r||(r=gform.applyFilters("gform_spinner_url",gf_global.spinnerUrl,e)),jQuery("#gform_"+e).submit(function(){if(0==jQuery("#gform_ajax_spinner_"+e).length){var t=gform.applyFilters("gform_spinner_target_elem",jQuery("#gform_submit_button_"+e+", #gform_wrapper_"+e+" .gform_next_button, #gform_send_resume_link_button_"+e),e);t.after('<img id="gform_ajax_spinner_'+e+'"  class="gform_ajax_spinner" src="'+r+'" alt="" />')}})}function gf_raw_input_change(e,r){clearTimeout(__gf_keyup_timeout);var t=jQuery(r),i=t.attr("id"),n=gf_get_input_id_by_html_id(i),o=gf_get_form_id_by_html_id(i);if(n){var a=t.is(":checkbox")||t.is(":radio")||t.is("select"),l=!a||t.is("textarea");("keyup"!=e.type||l)&&("change"!=e.type||a||l)&&("keyup"==e.type?__gf_keyup_timeout=setTimeout(function(){gf_input_change(this,o,n)},300):gf_input_change(this,o,n))}}function gf_get_input_id_by_html_id(e){var r=gf_get_ids_by_html_id(e),t=r[2];return r[3]&&(t+="."+r[3]),t}function gf_get_form_id_by_html_id(e){var r=gf_get_ids_by_html_id(e),t=r[1];return t}function gf_get_ids_by_html_id(e){var r=!!e&&e.split("_");return r}function gf_input_change(e,r,t){gform.doAction("gform_input_change",e,r,t)}function gformExtractFieldId(e){var r=parseInt(e.toString().split(".")[0]);return r?r:e}function gformExtractInputIndex(e){var r=parseInt(e.toString().split(".")[1]);return!!r&&r}function rgars(e,r){for(var t=r.split("/"),i=e,n=0;n<t.length;n++)i=rgar(i,t[n]);return i}function rgar(e,r){return"undefined"!=typeof e[r]?e[r]:""}"undefined"==typeof jQuery.fn.prop&&(jQuery.fn.prop=jQuery.fn.attr),jQuery(document).ready(function(){jQuery(document).bind("gform_post_render",gformBindFormatPricingFields)});var _gformPriceFields=new Array,_anyProductSelected,GFCalc=function(formId,formulaFields){this.patt=/{[^{]*?:(\d+(\.\d+)?)(:(.*?))?}/i,this.exprPatt=/^[0-9 -\/*\(\)]+$/i,this.isCalculating={},this.init=function(e,r){var t=this;jQuery(document).bind("gform_post_conditional_logic",function(){for(var i=0;i<r.length;i++){var n=jQuery.extend({},r[i]);t.runCalc(n,e)}});for(var i=0;i<r.length;i++){var n=jQuery.extend({},r[i]);this.runCalc(n,e),this.bindCalcEvents(n,e)}},this.runCalc=function(formulaField,formId){var calcObj=this,field=jQuery("#field_"+formId+"_"+formulaField.field_id),formulaInput=jQuery("#input_"+formId+"_"+formulaField.field_id),previous_val=formulaInput.val(),formula=gform.applyFilters("gform_calculation_formula",formulaField.formula,formulaField,formId,calcObj),expr=calcObj.replaceFieldTags(formId,formula,formulaField).replace(/(\r\n|\n|\r)/gm,""),result="";if(calcObj.exprPatt.test(expr))try{result=eval(expr)}catch(e){}isFinite(result)||(result=0),window.gform_calculation_result&&(result=window.gform_calculation_result(result,formulaField,formId,calcObj),window.console&&console.log('"gform_calculation_result" function is deprecated since version 1.8! Use "gform_calculation_result" JS hook instead.')),result=gform.applyFilters("gform_calculation_result",result,formulaField,formId,calcObj);var formattedResult=gform.applyFilters("gform_calculation_format_result",!1,result,formulaField,formId,calcObj),numberFormat=gf_get_field_number_format(formulaField.field_id,formId);if(formattedResult!==!1)result=formattedResult;else if(field.hasClass("gfield_price")||"currency"==numberFormat)result=gformFormatMoney(result?result:0,!0);else{var decimalSeparator=".",thousandSeparator=",";"decimal_comma"==numberFormat&&(decimalSeparator=",",thousandSeparator="."),result=gformFormatNumber(result,gformIsNumber(formulaField.rounding)?formulaField.rounding:-1,decimalSeparator,thousandSeparator)}result!=previous_val&&(field.hasClass("gfield_price")?(formulaInput.text(result),jQuery("#ginput_base_price_"+formId+"_"+formulaField.field_id).val(result).trigger("change"),gformCalculateTotalPrice(formId)):formulaInput.val(result).trigger("change"))},this.bindCalcEvents=function(e,r){var t=this,i=e.field_id,n=getMatchGroups(e.formula,this.patt);t.isCalculating[i]=!1;for(var o in n)if(n.hasOwnProperty(o)){var a=n[o][1],l=parseInt(a),f=jQuery("#field_"+r+"_"+l).find('input[name="input_'+a+'"], select[name="input_'+a+'"]');"checkbox"==f.prop("type")||"radio"==f.prop("type")?jQuery(f).click(function(){t.bindCalcEvent(a,e,r,0)}):f.is("select")||"hidden"==f.prop("type")?jQuery(f).change(function(){t.bindCalcEvent(a,e,r,0)}):jQuery(f).keydown(function(){t.bindCalcEvent(a,e,r)}).change(function(){t.bindCalcEvent(a,e,r,0)}),gform.doAction("gform_post_calculation_events",n[o],e,r,t)}},this.bindCalcEvent=function(e,r,t,i){var n=this,o=r.field_id;i=void 0==i?345:i,n.isCalculating[o][e]&&clearTimeout(n.isCalculating[o][e]),n.isCalculating[o][e]=window.setTimeout(function(){n.runCalc(r,t)},i)},this.replaceFieldTags=function(e,r,t){var n=getMatchGroups(r,this.patt);for(i in n)if(n.hasOwnProperty(i)){var o=n[i][1],a=parseInt(o),l=(n[i][3],0),f=jQuery("#field_"+e+"_"+a).find('input[name="input_'+o+'"], select[name="input_'+o+'"]');(f.length>1||"checkbox"==f.prop("type"))&&(f=f.filter(":checked"));var s=!window.gf_check_field_rule||"show"==gf_check_field_rule(e,a,!0,"");if(f.length>0&&s){var u=f.val();u=u.split("|"),l=u.length>1?u[1]:f.val()}var d=gf_get_field_number_format(a,e);d||(d=gf_get_field_number_format(t.field_id,e));var c=gformGetDecimalSeparator(d);l=gform.applyFilters("gform_merge_tag_value_pre_calculation",l,n[i],s,t,e),l=gformCleanNumber(l,"","",c),l||(l=0),r=r.replace(n[i][0],l)}return r},this.init(formId,formulaFields)},gform={hooks:{action:{},filter:{}},addAction:function(e,r,t,i){gform.addHook("action",e,r,t,i)},addFilter:function(e,r,t,i){gform.addHook("filter",e,r,t,i)},doAction:function(e){gform.doHook("action",e,arguments)},applyFilters:function(e){return gform.doHook("filter",e,arguments)},removeAction:function(e,r){gform.removeHook("action",e,r)},removeFilter:function(e,r,t){gform.removeHook("filter",e,r,t)},addHook:function(e,r,t,i,n){void 0==gform.hooks[e][r]&&(gform.hooks[e][r]=[]);var o=gform.hooks[e][r];void 0==n&&(n=r+"_"+o.length),void 0==i&&(i=10),gform.hooks[e][r].push({tag:n,callable:t,priority:i})},doHook:function(e,r,t){if(t=Array.prototype.slice.call(t,1),void 0!=gform.hooks[e][r]){var i,n=gform.hooks[e][r];n.sort(function(e,r){return e.priority-r.priority});for(var o=0;o<n.length;o++)i=n[o].callable,"function"!=typeof i&&(i=window[i]),"action"==e?i.apply(null,t):t[0]=i.apply(null,t)}return"filter"==e?t[0]:void 0},removeHook:function(e,r,t,i){if(void 0!=gform.hooks[e][r])for(var n=gform.hooks[e][r],o=n.length-1;o>=0;o--)void 0!=i&&i!=n[o].tag||void 0!=t&&t!=n[o].priority||n.splice(o,1)}};!function(e,r){function t(t){function a(e,t){r("#"+e).prepend("<li>"+t+"</li>")}function l(){var e,t="#gform_uploaded_files_"+p,i=r(t);return e=i.val(),e="undefined"==typeof e||""===e?{}:r.parseJSON(e)}function f(e){var r=l(),t=c(e);return"undefined"==typeof r[t]&&(r[t]=[]),r[t]}function s(e){var r=f(e);return r.length}function u(e,r){var t=f(e);t.unshift(r),d(e,t)}function d(e,t){var i=l(),n=r("#gform_uploaded_files_"+p),o=c(e);i[o]=t,n.val(r.toJSON(i))}function c(e){return"input_"+e}function g(e){e.preventDefault()}var _=r(t).data("settings"),m=new plupload.Uploader(_);p=m.settings.multipart_params.form_id,e.uploaders[_.container]=m;var p,h;m.bind("Init",function(t,i){t.features.dragdrop||r(".gform_drop_instructions").hide();var n=t.settings.multipart_params.field_id,o=parseInt(t.settings.gf_vars.max_files),a=s(n);o>0&&a>=o&&e.toggleDisabled(t.settings,!0)}),e.toggleDisabled=function(e,t){var i=r("string"==typeof e.browse_button?"#"+e.browse_button:e.browse_button);i.prop("disabled",t)},m.init(),m.bind("FilesAdded",function(t,o){var l,f=parseInt(t.settings.gf_vars.max_files),u=t.settings.multipart_params.field_id,d=s(u),c=t.settings.gf_vars.disallowed_extensions;if(f>0&&d>=f)return void r.each(o,function(e,r){t.removeFile(r)});r.each(o,function(e,i){if(l=i.name.split(".").pop(),r.inArray(l,c)>-1)return a(t.settings.gf_vars.message_id,i.name+" - "+n.illegal_extension),void t.removeFile(i);if(i.status==plupload.FAILED||f>0&&d>=f)return void t.removeFile(i);var o="undefined"!=typeof i.size?plupload.formatSize(i.size):n.in_progress,s='<div id="'+i.id+'" class="ginput_preview">'+i.name+" ("+o+') <b></b> <a href="javascript:void(0)" title="'+n.cancel_upload+"\" onclick='$this=jQuery(this); var uploader = gfMultiFileUploader.uploaders."+t.settings.container+';uploader.stop();uploader.removeFile(uploader.getFile("'+i.id+'"));$this.after("'+n.cancelled+"\"); uploader.start();$this.remove();' onkeypress='$this=jQuery(this); var uploader = gfMultiFileUploader.uploaders."+t.settings.container+';uploader.stop();uploader.removeFile(uploader.getFile("'+i.id+'"));$this.after("'+n.cancelled+"\"); uploader.start();$this.remove();'>"+n.cancel+"</a></div>";r("#"+t.settings.filelist).prepend(s),d++}),t.refresh();var g="form#gform_"+p,_="input:hidden[name='gform_unique_id']",m=g+" "+_,y=r(m);0==y.length&&(y=r(_)),h=y.val(),""===h&&(h=i(),y.val(h)),f>0&&d>=f&&(e.toggleDisabled(t.settings,!0),a(t.settings.gf_vars.message_id,n.max_reached)),t.settings.multipart_params.gform_unique_id=h,t.start()}),m.bind("UploadProgress",function(e,t){var i=t.percent+"%";r("#"+t.id+" b").html(i)}),m.bind("Error",function(e,t){if(t.code===plupload.FILE_EXTENSION_ERROR){var i="undefined"!=typeof e.settings.filters.mime_types?e.settings.filters.mime_types[0].extensions:e.settings.filters[0].extensions;a(e.settings.gf_vars.message_id,t.file.name+" - "+n.invalid_file_extension+" "+i)}else if(t.code===plupload.FILE_SIZE_ERROR)a(e.settings.gf_vars.message_id,t.file.name+" - "+n.file_exceeds_limit);else{var o="<li>Error: "+t.code+", Message: "+t.message+(t.file?", File: "+t.file.name:"")+"</li>";a(e.settings.gf_vars.message_id,o)}r("#"+t.file.id).html(""),e.refresh()}),m.bind("FileUploaded",function(e,t,i){var l=r.secureEvalJSON(i.response);if("error"==l.status)return a(e.settings.gf_vars.message_id,t.name+" - "+l.error.message),void r("#"+t.id).html("");var f="<strong>"+t.name+"</strong>",s=e.settings.multipart_params.form_id,d=e.settings.multipart_params.field_id;f="<img class='gform_delete' src='"+o+"/delete.png' onclick='gformDeleteUploadedFile("+s+","+d+", this);' onkeypress='gformDeleteUploadedFile("+s+","+d+", this);' alt='"+n.delete_file+"' title='"+n.delete_file+"' /> "+f,f=gform.applyFilters("gform_file_upload_markup",f,t,e,n,o),r("#"+t.id).html(f);var c=e.settings.multipart_params.field_id;100==t.percent&&(l.status&&"ok"==l.status?u(c,l.data):a(e.settings.gf_vars.message_id,n.unknown_error+": "+t.name))}),r("#"+_.drop_element).on({dragenter:g,dragover:g})}function i(){return"xxxxxxxx".replace(/[xy]/g,function(e){var r=16*Math.random()|0,t="x"==e?r:3&r|8;return t.toString(16)})}e.uploaders={};var n="undefined"!=typeof gform_gravityforms?gform_gravityforms.strings:{},o="undefined"!=typeof gform_gravityforms?gform_gravityforms.vars.images_url:"";r(document).bind("gform_post_render",function(i,o){r("form#gform_"+o+" .gform_fileupload_multifile").each(function(){t(this)});var a=r("form#gform_"+o);a.length>0&&a.submit(function(){var t=!1;return r.each(e.uploaders,function(e,r){return r.total.queued>0?(t=!0,!1):void 0}),t?(alert(n.currently_uploading),window["gf_submitting_"+o]=!1,r("#gform_ajax_spinner_"+o).remove(),!1):void 0})}),r(document).bind("gform_post_conditional_logic",function(t,i,n,o){o||r.each(e.uploaders,function(e,r){r.refresh()})}),r(document).ready(function(){"undefined"!=typeof adminpage&&"toplevel_page_gf_edit_forms"===adminpage||"undefined"==typeof plupload?r(".gform_button_select_files").prop("disabled",!0):"undefined"!=typeof adminpage&&adminpage.indexOf("_page_gf_entries")>-1&&r(".gform_fileupload_multifile").each(function(){t(this)})}),e.setup=function(e){t(e)}}(window.gfMultiFileUploader=window.gfMultiFileUploader||{},jQuery);var __gf_keyup_timeout;jQuery(document).on("change keyup",".gfield_trigger_change input, .gfield_trigger_change select, .gfield_trigger_change textarea",function(e){gf_raw_input_change(e,this)}),!window.rgars,!window.rgar,String.prototype.format=function(){var e=arguments;return this.replace(/{(\d+)}/g,function(r,t){return"undefined"!=typeof e[t]?e[t]:r})};