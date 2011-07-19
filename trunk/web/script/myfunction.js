function check_all(val) {
    $('input[name=checklist]').attr('checked', val);
}

function getCheckedList() {
    var arr = new Array();
    var loop = 0;
    $('input[name=checklist]:checked').each
    (
        function() {
            arr[loop] = $(this).val();
            loop+=1;
        }
    );
    return arr;
}

function change_status(val) {
    var checked = new Array();
    if (val==undefined) {
        checked = getCheckedList();
    } else {
        checked = new Array(val);
    }
    if (checked.length==0) {
        alert('No checked');
    } else {
        var value = $('select[name=status]').val();
        if (value!='change') {
            if(confirm('Are you sure to change status to '+value+' selected POI?')) {
                action_poi(value, checked);
            }
        }
    }
    changeDefaultSelection();
}

function delete_poi(val) {
    var checked = new Array();
    if (val==undefined) {
        checked = getCheckedList();
    } else {
        checked = new Array(val);
    }
    if (checked.length==0) {
        alert('No checked');
    } else {
        if(confirm('Are you sure to change status to delete selected POI?')) {
            action_poi('delete', checked);
        }
    }
}

function action_poi(act, data) {
    var link = 'process/admin/admin_action.php';
    var form_data = {
        action : act,
        checked : data
    };

    $.ajax({
            url: link,
            type: 'POST',
            data: form_data,
            success: function(msg) {
               buttonOnClick('layout/admin/poi_management/poi_management_layout.php','ajax_wrapper');
            }
    });
}

function changeDefaultSelection() {
    $('select[name=status]').val('change');
}



    