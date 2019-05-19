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


$('.state-dropdown').on('change', function () {
    var dropdownValue = this.options[this.selectedIndex].value,
        roomId = this.getAttribute('roomId');

    $.ajax({
        url: '/rooms/change-state-dropdown',
        type: 'POST',
        data: {
            'newValue': dropdownValue,
            'roomId': roomId
        },
        success: function (res) {
        },
        error: function () {
            console.log('error');
        }
    });
});