$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function deleteimgGallery(id_hotel, imgname, _url, _path) {
    //console.log(id_hotel + " " + imgname + " " + _url + " " + _source);
    $.ajax({
        url: _url,
        method: "POST",
        data: { id: id_hotel, name: imgname },
        beforeSend: function() {},
        success: function(data) {
            var partsArray = data.uploaded_image.split(',');
            var str = "";
            for (i = 0; i < partsArray.length; i++) {
                if (partsArray[i] !== "") {
                    imgsrc = _path + "/" + partsArray[i];
                    str += '<div class="imgboxgallery"><img width="100%" height="100%" src="' + imgsrc + '?t=' + Math.random() + '" /><button  type="button" class="btn btn-danger btn-sm delimg"  onclick="deleteimgGallery(\'' + id_hotel + '\',\'' + partsArray[i] + '\',\'' + _url + '\',\'' + _path + '\')"><i class="fas fa-trash-alt"></i></button></div>';
                }
            }
            $('.boxgallery').html(str);
        },
        error: function(jqXhr, textStatus, errorMessage) { // error callback 

        }
    });
}

function AddimgGallery(id_hotel, _url, _delurl, _path) {
    var name = document.getElementById("gallerybtn").files[0].name;
    var ext = name.split('.').pop().toLowerCase();
    var form_data = new FormData();
    if (jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
        alert("Invalid Image File");
    }

    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("gallerybtn").files[0]);
    var f = document.getElementById("gallerybtn").files[0];
    var fsize = f.size || f.fileSize;
    if (fsize > 2000000) {
        alert("Max Image File Size is 2Mo");
    } else {
        form_data.append("file", document.getElementById('gallerybtn').files[0]);
        form_data.append("id", id_hotel);

        $.ajax({
            url: _url,
            enctype: 'multipart/form-data',
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                var partsArray = data.uploaded_image.split(',');
                var str = "";
                for (i = 0; i < partsArray.length; i++) {
                    if (partsArray[i] !== "") {
                        imgsrc = _path + "/" + partsArray[i];

                        // imgsrc = imgsrc.replace(':idimg', partsArray[i]);
                        // imgsrc = imgsrc.replace(':source', _path);
                        // console.log(imgsrc);
                        str += '<div class="imgboxgallery"><img width="100%" height="100%" src="' + imgsrc + '" /><button  type="button" class="btn btn-danger btn-sm delimg"  onclick="deleteimgGallery(\'' + id_hotel + '\',\'' + partsArray[i] + '\',\'' + _delurl + '\',\'' + _path + '\')"><i class="fas fa-trash-alt"></i></button></div>';
                    }
                }
                $('.boxgallery').html(str);
            },
            error: function(jqXhr, textStatus, errorMessage) { // error callback 
                $('.boxgallery').html(errorMessage);
            }
        });
    }
}