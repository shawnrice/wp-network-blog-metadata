(function($) {
    $(document).ready(function() {
        $('<tr class="form-field form-required"></tr>').append(
            $('<th scope="row">New field</th>')
        ).append(
            $('<td></td>').append(
                $('<input class="regular-text" type="text" title="New Field" name="blog[new_field]">')
            ).append(
                $('<p>Explanation about your new field</p>')
            )
        ).insertAfter('#wpbody-content table tr:eq(2)');
    });
})(jQuery);