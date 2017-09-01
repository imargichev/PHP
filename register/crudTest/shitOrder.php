<script type="text/javascript">
            $(document).ready(function () {
                $(function () {
                    $("#sortorder_autocomplete_<?= $type_id; ?> ul").sortable({
                        opacity: 0.6, cursor: 'move', update: function () {
                            var order = $(this).sortable("serialize") + '&order_table=connected';
                            $.post("/admin/menu/sortorder/", order, function (theResponse) {

                            });
                        }
                    });
                });

            });
        </script>