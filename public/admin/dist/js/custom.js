function selectImageWithCKFinder( elementId ) {
    CKFinder.popup( {
        chooseFiles: true,
        width: 800,
        height: 600,
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                var file = evt.data.files.first();
                console.log( file );
                var img = jQuery( elementId ).find('img');
                var fileinput = jQuery( elementId ).find('input[name="image"]');
                $(img).attr('src', file.getUrl() );
                $( fileinput ).val( file.getUrl() );

            } );

            finder.on( 'file:choose:resizedImage', function( evt ) {
                var output = document.getElementById( elementId );
                output.value = evt.data.resizedUrl;
            } );
        }
    } );
}

(function( $ ){

    $.fn.filemanager = function(type, options) {
        type = type || 'file';

        this.on('click', function(e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/file-manager';
            var target_input = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                if( items.length > 0 ){
                    // set the value of the desired input to image url
                    target_input.val('').val( items[0].thumb_url ).trigger('change');
                     // clear previous preview
                    target_preview.html('');
                    target_preview.attr('src', items[0].thumb_url);
                    // trigger change event
                    target_preview.trigger('change');
                }
            };
            return false;
        });
    }

})(jQuery);

// Define function to open filemanager window
var lfm = function(options, cb) {
    var route_prefix = (options && options.prefix) ? options.prefix : '/file-manager';
    window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = cb;
};

// Define LFM summernote button
var LFMButton = function(context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Chèn ảnh',
        click: function() {
            lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
                lfmItems.forEach(function (lfmItem) {
                    context.invoke('insertImage', lfmItem.url);
                });
            });

        }
    });
    return button.render();
};


$(function () {

    $('.editor').summernote({
        toolbar: [
            ['popovers', ['lfm']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['misc',['fullscreen','undo','redo','codeview']]
        ],
        buttons: {
            lfm: LFMButton
        }
    });


    $('#sl-real-cats').select2({
        width: '100%'
    });

    // //Initialize Select2 Elements
    // $('#sl-cities').select2({
    //     placeholder: "Tất cả Thành phố",
    //     width: '100%'
    // });
    // $('#sl-district').select2({
    //     placeholder: "Tất cả Quận/ Huyện",
    //     width: '100%'
    // });
    // $('#sl-ward').select2({
    //     placeholder: "Tất cả Phường/ Xã",
    //     width: '100%'
    // });

    $('#sl-cities').on('change', function (e) {
        $.ajax({
            url: ajax.district,
            dataType: 'json',
            method: 'get',
            data:{
                id: $(this).val()
            },
            success: function(data){
                $('#sl-district').html('');
                $('#sl-ward').html('');
                $.each(data, function(index, item){
                    $('#sl-district').append('<option value="'+item.id+'">'+item.text+'</option>');

                })
            }
        });


    });

    $('#sl-district').on('change', function (e) {

        $.ajax({
            url: ajax.ward,
            dataType: 'json',
            method: 'get',
            data:{
                id: $(this).val()
            },
            success: function(data){
                $('#sl-ward').html('');
                $.each(data, function(index, item){
                    $('#sl-ward').append('<option value="'+item.id+'">'+item.text+'</option>');

                })
            }
        });




    });

})