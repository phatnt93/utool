// Define function jquery
// jQuery.fn.extend({
//     initJsGrid: function(){
//         // console.log($(this).html());
//     }
// });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.select2').select2();

function trans(key, replace = {}) {
    let translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);
    for (var placeholder in replace) {
        translation = translation.replace(`:${placeholder}`, replace[placeholder]);
    }
    return (translation ? translation : key);
}

function init_datatable(idTable, url, opts = {}){
    let selectorsSearch = (opts.selectorsSearch != undefined ? opts.selectorsSearch : []);
    var table = $('#' + idTable);
    var datatable = table.DataTable({
        paging: true,
        lengthChange: true,
        searching: false,
        ordering: false,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: 'POST',
            data: function ( d ) {
                $.each(selectorsSearch, function (index, item) { 
                    d[item] = $('#' + item).val();
                });
            }
        },
        columnDefs: [
            {defaultContent: "", targets: "_all"}
        ],
        language: {
            "processing": '<div class="loader"></div>'
        }
    });
    let selectorsSearchEvent = [];
    $.each(selectorsSearch, function (index, item) {
        selectorsSearchEvent.push('#' + item);
    });
    $(selectorsSearchEvent.join(', ')).on('keyup change clear', function(){
        datatable.ajax.reload();
    });

    table.on('change', '.check-all', function(e){
        table.find('.check-item').prop('checked', $(this).is(':checked'));
    });

    table.on('click', '.btn-bulk-delete', function(e){
        toastr.warning(trans('deleting'));
        let ids = [];
        table.find('.check-item').each(function(index, el){
            if ($(el).is(':checked')) {
                ids.push($(el).val());
            }
        });
        if (ids.length == 0) {
            toastr.error(trans('id_empty'));
            return false;
        }
        let url = $(this).data('href');
        $.ajax({
            type: "POST",
            url: url,
            data: {id: ids.join(',')},
            dataType: 'JSON',
            success: function(res){
                toastr.success(res.msg);
                datatable.ajax.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest.responseJSON.msg);
            }
        });
    });

    table.on('click', '.btn-delete-item', function(e){
        toastr.warning(trans('deleting'));
        let id = $(this).data('id');
        let url = $(this).data('href');
        $.ajax({
            type: "POST",
            url: url,
            data: {id: id},
            dataType: 'JSON',
            success: function(res){
                toastr.success(res.msg);
                datatable.ajax.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error(XMLHttpRequest.responseJSON.msg);
            }
        });
    });
}