'use strict';

console.log('..user-list js run');

// let formatter = new Intl.NumberFormat('ID');
// formatter.format()

$(document).on('click', '[data-toggle="lightbox"]', function(event) { // zoom image
    event.preventDefault();
    $(this).ekkoLightbox();
});

let status_attribute = {
    'deleted': {
        'title':'hapus',
        'title_verb':'menghapus', 
        'info':'Ini tidak dapat dikembalikan',
    },
    'active': {
        'title':'hidupkan',
        'title_verb':'hidupkan kembali', 
        'info':'',
    },
};

function confirmStatusChange(user_id, status_key){
    Swal.fire({
        title: "Yakin untuk "+status_attribute[status_key]['title_verb']+" Item ini?",
        text: status_attribute[status_key]['info'],
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, "+status_attribute[status_key]['title'],
        cancelButtonText: "Batal",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {

            $.ajax({
                url: HOST_URL +'/api/user/update_status_item/'+user_id,
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "POST",
                data:{
                    status_key: status_key
                },
                success:function(data){
                    if(data.status){
                        Swal.fire(
                            "Berhasil!",
                            +data.message,
                            "success"
                        )

                        $('#kt_datatable').DataTable().clear().destroy();
                        KTDatatablesDataSourceAjaxClient.init();
                    }else{
                        Swal.fire(
                            "Gagal..",
                            +data.message,
                            "error"
                        )
                    }
                },
                error:function(xhr, status, error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.responseText,
                        type: "error",
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-error"
                    });
                }
            });
        } else if (result.dismiss === "cancel") { // result.dismiss can be "cancel", "overlay", "close", and "timer"
            Swal.fire(
                "Batal",
                "Item masih seperti semula",
                "error"
            )
        }


        $(".button-form-action").each(function(i,obj){
            $(obj).show();
        });
        $("#button-edit-info").hide();
        $("#button-edit-info").html('');
    });
}

var KTDatatablesDataSourceAjaxClient = function() {
    var initTable1 = function() {
        var table = $('#kt_datatable');

        table.DataTable({
            responsive: true,
            ajax: {
                url: HOST_URL + '/api/user/get_list',
                type: 'POST',
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    status: status
                },
                // success: function (result) {
                //     console.log('result', result);
                // }
            },
            columns: [
                {data: 'updated_at'},
                {data: 'photo'},
                {data: 'name'},
                {data: 'email'},
                {data: 'role'},
                {data: 'status'},
                {data: 'id', responsivePriority: -1},
            ],
            columnDefs: [
                {
                    targets: -1,
                    title: 'Aksi',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        
                        let template = '\
							<a href="'+HOST_URL + '/user/detail/'+data+'" target="_blank" class="btn btn-sm btn-clean btn-icon" title="Edit detail Item ini">\
								<i class="la la-edit"></i>\
							</a>';
                        if(full.item_status_str == 'deleted'){
                            template += '\
                                <a href="#" onclick="confirmStatusChange('+data+',`active`)" class="btn btn-sm btn-clean btn-icon" title="Ubah status Item ini">\
                                    <i class="la la-flag-o"></i>\
                                </a>\
                            ';
                        }else{
                            template += '\
                                <a href="#" onclick="confirmStatusChange('+data+',`deleted`)" class="btn btn-sm btn-clean btn-icon" title="Hapus Item ini">\
                                    <i class="la la-trash"></i>\
                                </a>\
                            ';
                        }
                        return template;
                    },
                },
                {
                    targets: 0,
                    title: '#',
                    render: function(data, type, full, meta) {
                        return '';
                    }
                },
                {
                    width: '70px',
                    targets: 1,
                    render: function(data, type, full, meta) {
                        let temp_style = '';
                        if(full.item_status_str == 'deleted'){ temp_style = 'filter: grayscale(80%);';}
                        if(data) {
                            let display =  `<div class="symbol-group symbol-hover">
                                                <a className="symbol symbol-circle" href="`+IMG_URL+data+`" data-toggle="lightbox" data-gallery="example-gallery">
                                                   <img alt="Pic" src="`+IMG_URL+data+`" style="`+temp_style+`" width="50px" height="50px"/>
                                                </a>
                                            </div>`;
                            return display;
                        }else{
                            return '<div class="symbol symbol-circle symbol-light-primary">\
                                        <span class="symbol-label font-weight-bold">IMG</span>\
                                    </div>';
                        }
                    },
                },
                {
                    width: '200px',
                    targets: 2,
                    render: function(data, type, full, meta) {
                        let temp_class = 'wrap-text-md';
                        if(full.item_status_str == 'deleted'){ temp_class += ' text-muted';}else{ temp_class += ' text-dark';}
                        if(data){
                            return '<a href="'+HOST_URL + '/user/detail/'+full.id+'" target="_blank" class="d-block '+temp_class+'" title="'+data+'">'+data+'</a>';
                        }else{
                            return '<a class="'+temp_class+'">-</a>';
                        }
                    },
                },
                {
                    width: '70px',
                    targets: 3,
                    render: function(data, type, full, meta) {
                        let temp_class = '';
                        if(full.item_status_str == 'deleted'){ temp_class = 'text-muted';}
                        if(data){
                            return '<span class="font-weight-bolder d-block font-size-lg '+(temp_class?temp_class:'text-primary')+'">'+data+'</span>';
                        }else{
                            return '<span class="'+temp_class+'">-</span>';
                        }
                    },
                },
                {
                    width: '80px',
                    targets: 4,
                    render: function(data, type, full, meta) {
                        let temp_class = '';
                        if(full.item_status_str == 'deleted'){ temp_class = 'text-muted';}
                        if(data){
                            return '<span class="'+temp_class+'">'+data.toLowerCase()+'</span>';
                        }else{
                            return '<span class="'+temp_class+'">-</span>';
                        }
                    },
                },
                {
                    width: '150px',
                    targets: 5,
                    render: function(data, type, full, meta) {
                        let temp_class = 'text-success';
                        if(full.item_status_str == 'deleted'){ temp_class = 'text-muted';}
                        if(data){
                            return '<span class="label label-pill label-inline '+temp_class+'">'+data+'</span>';
                        }else{
                            return '<span class="'+temp_class+'">-</span>';
                        }
                    },
                },
                {
                    width: '150px',
                    targets: 6,
                    render: function(data, type, full, meta) {
                        let temp_class = '';
                        if(full.item_status_str == 'deleted'){ temp_class = 'text-muted';}
                        if(data){
                            return  '<span class="'+temp_class+'">'+data.toLowerCase()+'</span>'+
                                    '<br>'+(full.need_approval?'<small class="text-warning">menunggu persetujuan admin</small>':'');
                        }else{
                            return  '<span class="'+temp_class+'">-</span>';
                        }
                    },
                },
            ],
            layout: {
                theme: 'default',
                scroll: false,
                height: null,
                footer: false,
                spinner: {
                    overlayColor: '#000000',
                    opacity: 0,
                    type: 'loader',
                    state: 'primary',
                    message: true,
                },
            },
        });
    };

    return {
        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesDataSourceAjaxClient.init();
});

// ----------------------- limit

