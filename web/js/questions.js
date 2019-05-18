// makes to choose only one right answer
$("input:checkbox").on('click', function() {
    var $box = $(this);
    var group = "input:checkbox[group-name='is-right-checkbox']";
    if ($box.is(":checked")) {
        $(group).prop("checked", false);

        $box.prop("checked", true);
    } else {
        $box.prop("checked", true);
    }
});