/*
 * Add new field in /wp-admin/network/site-new.php
 * URI: http://stackoverflow.com/a/10372861/1287812
 */(function(e){e(document).ready(function(){e('<tr class="form-field form-required"></tr>').append(e('<th scope="row">Site category</th>')).append(e("<td></td>").append(e('<input class="regular-text" type="text" title="Site Category" name="blog[site_category]">')).append(e("<p></p>"))).insertAfter("#wpbody-content table tr:eq(2)")})})(jQuery);