/**handles:avada-ie9**/
jQuery(document).ready(function(){jQuery("body").each(function(){var e='<style type="text/css">';jQuery(this).find("style").each(function(){e+=jQuery(this).html(),jQuery(this).remove()}),e+="</style>",jQuery(this).prepend(e)})});