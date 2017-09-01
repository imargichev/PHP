<?php
function sortorder_gallery($types_id = 0, $object_id = 0)
{
    $types_id = (int)$types_id;
    $object_id = (int)$object_id;

    if (!$object_id or !$types_id)
        die;
    $result = $_REQUEST['recordsArray'];
    $sort = 1;
    $gallery_id = $types_id . "_" . $object_id;
    foreach ($result as $id) {
        $id = (int)$id;
        $GLOBALS['db']->Execute("UPDATE `gallery` SET sortorder = :sort WHERE id = :id AND gallery_id = :gallery_id", array('sort' => $sort, 'id' => $id, 'gallery_id' => $gallery_id));
        $sort++;
    }
    core::FixGallery($types_id, $object_id);
    $GLOBALS['db']->CloseConnection();
    die;
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            $("#sortorder_autocomplete_<?= $type_id; ?> ul").sortable({
                opacity: 0.6, cursor: 'move', update: function () {
                    var order = $(this).sortable("serialize") + '&order_table=connected';
                    $.post("post.php", order, function (theResponse) {
                    });
                }
            });
        });
    });
</script>

