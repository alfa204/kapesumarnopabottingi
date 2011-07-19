/*** Global function ***/
// function for check/uncheck checkbox input
// name checkbox, val false/true
function check_all(name, val) {
    $('input[name='+name+']').attr('checked', val);
}

// function to get data value from checked input
// return array of string
function getCheckedList(name) {
    var arr = new Array();
    var loop = 0;
    $('input[name='+name+']:checked').each
    (
        function() {
            arr[loop] = $(this).val();
            loop+=1;
        }
    );
    return arr;
}

// function for changing select input to default value
function changeDefaultSelection(name) {
    $('select[name='+name+']').val('change');
}

/***********************************************/

/**** Function for showpoi.php ****/
function change_status(val) {
    var checked = new Array();
    if (val==undefined) {
        checked = getCheckedList('checklist');
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
    changeDefaultSelection('status');
}

function delete_poi(val) {
    var checked = new Array();
    if (val==undefined) {
        checked = getCheckedList('checklist');
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
    var link = 'process/admin/admin_action_poi.php';
    var form_data = {
        action : act,
        checked : data
    };

    $.ajax({
            url: link,
            type: 'POST',
            data: form_data,
            success: function(msg) {
               if (act!='delete') {
                  for (id in data) {
                      $('#status_poi_'+data[id]).text(act);
                  }
               } else
                  buttonOnClick('layout/admin/poi_management/poi_management_layout.php','ajax_wrapper');
            }
    });
}

/*******************************************/

/**** Function for poi_detail.php ****/

// Function for table tagline
function change_status_tagline() {
    var checked = getCheckedList('checklist_tagline');
        
    if (checked.length==0) {
        alert('No checked');
    } else {
        var value = $('select[name=status_tagline]').val();
        if (value!='change') {
            if(confirm('Are you sure to change status to '+value+' selected Tagline?')) {
                action_tagline(value, checked);
            }
        }
    }
    changeDefaultSelection('status_tagline');
}

function delete_tagline() {
    var checked = getCheckedList('checklist_tagline');
    if (checked.length==0) {
        alert('No checked');
    } else {
        if(confirm('Are you sure to change status to delete selected Tagline?')) {
            action_tagline('delete', checked);
        }
    }
}

function action_tagline(act, data) {
    var link = 'process/admin/admin_action_tagline.php';
    var form_data = {
        action : act,
        checked : data
    };

    $.ajax({
            url: link,
            type: 'POST',
            data: form_data,
            success: function(msg) {
               if (act!='delete') {
                  for (id in data) {
                      $('#status_tagline_'+data[id]).text(act);
                  }
               } else 
                  buttonOnClick('layout/admin/poi_management/poi_management_layout.php','ajax_wrapper');               
            }
    });
}

/////////////////////////////

// Function for table publishing time
/////////////////////////////

/*******************************************/





    