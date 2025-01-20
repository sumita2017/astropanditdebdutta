<script type="text/javascript">
    $(document).ready(function () {

        var base_url = "{{ URL::to('/') }}";

        setTimeout(function () {
            $('.sessiondata').fadeOut('400');
        }, 3000);

        //  delete admin user
        $(document).on('click', '.deleteadmin', function () {
            var obj = $(this);
            var id = $(this).attr('adminid');
            //alert(id);
            bootbox.confirm("Are you sure to delete this Admin?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deleteadmin',
                        method: "get",
                        data: {
                            'id': id
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        //console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("Admin Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry Admin Not Deleted")
                        }
                    })
                } else { }
            });
        });

        // delete service
        $(document).on('click', '.deleteservice', function () {
            var obj = $(this);
            var id = $(this).attr('serviceid');
            var serviceimage = $(this).attr('serviceimage');
            //alert(serviceimage);
            bootbox.confirm("Are you sure to delete this Service?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deleteservice',
                        method: "get",
                        data: {
                            'id': id,
                            'serviceimage': serviceimage,
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("Service Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry Service Not Deleted")
                        }
                    })
                } else { }
            });
        });

        //show image if edited in update service
        $('.newimage').on('change', function () {
            var obj = $(this);
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $("#showimage").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        });

        //checkbox checked property change for add chamber section 
        $('#alldays').on('change', function () {
            var obj = $(this);
            if ($('#alldays').prop('checked') == true) {
                $('.dayselect').prop('checked', true);
            } else {
                $('.dayselect').prop('checked', false);
            }
        });

        //checkbox checked property change for edit chamber section 
        $('#editalldays').on('change', function () {
            var obj = $(this);
            if ($('#editalldays').prop('checked') == true) {
                $('.dayselect').prop('checked', true);

            } else {
                $('.dayselect').prop('checked', false);
            }
        });

        // delete chamber
        $(document).on('click', '.deletechember', function () {
            var obj = $(this);
            var id = $(this).attr('chamberid');

            bootbox.confirm("Are you sure to delete this Chamber Location?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deletechamber',
                        method: "get",
                        data: {
                            'id': id
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("Chamber Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry Chamber Not Deleted")
                        }
                    })
                } else { }
            });
        });

        // delete bannervideo
        $(document).on('click', '.deletebannervideo', function () {
            var obj = $(this);
            var id = $(this).attr('bannervideoid');
            var bannervideoimage = $(this).attr('bannervideoimage');

            bootbox.confirm("Are you sure to delete this File?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deletebannervideo',
                        method: "get",
                        data: {
                            'id': id,
                            'bannervideoimage': bannervideoimage
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("File Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry File Not Deleted")
                        }
                    })
                } else { }
            });
        });

        // delete Social Link
        $(document).on('click', '.deletesocial', function () {
            var obj = $(this);
            var id = $(this).attr('socialid');

            bootbox.confirm("Are you sure to delete this Social Link?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deletesocials',
                        method: "get",
                        data: {
                            'id': id
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("Chamber Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry Chamber Not Deleted")
                        }
                    })
                } else { }
            });
        });

        // edit Social Link
        $(document).on('change', '.addediturl', function () {
            var obj = $(this);
            var preva = $(this).prev('.jqueryurl');
            var id = $(this).attr('socialid');
            var url = $(this).val();
            //alert(url);
            bootbox.confirm("Are you sure to update this Social Link?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/addeditsocials',
                        method: "get",
                        data: {
                            'id': id,
                            'url': url
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("Link Updated Successful")
                            location.reload(true);
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry Link Not Updated")
                        }
                    })
                } else { }
            });
        });

        // Change visibility of Social Link
        $(document).on('click', '.urlradio', function () {
            var obj = $(this);
            var id = $(this).attr('linkid');
            var radioValue = $('input[name="visibility' + id + '"]:checked').val();
            //console.log(radioValue);
            $.ajax({
                url: base_url + '/visibilitylink',
                method: "get",
                data: {
                    'id': id,
                    'radioValue': radioValue
                }
            }).done(function (msg) {
                var massage = JSON.parse(msg);
                console.log(massage);
                if (massage.status == 1 && massage.msg == "true") {
                    alert("Link Visibility Updated Successful")
                    location.reload(true);
                } else if (massage.status == 0 && massage.msg == "false") {
                    alert("Sorry Link Visibility Not Updated")
                }
            })
        });

        tinymce.init({
            selector: '#shortdescription',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 150,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating| lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#adddescription',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 400,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating| lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#addshortdescription',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 150,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#textareabanner',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 450,
            width: 480,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#textareabanneredit',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 450,
            width: 480,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#description',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 400,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#default',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 400,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#blogdefault',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 400,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#abouttitle',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 220,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#aboutdescription',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 300,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });

        tinymce.init({
            selector: '#abouthomedescription',
            license_key: 'gpl',
            menubar: false,
            plugins: ["wordcount", "code", "insertdatetime", "link"],
            max_height: 300,
            extended_valid_elements: 'b i ',
            toolbar: 'styles| undo redo |underline | sizeselect | bold italic | fontselect |  fontsize | link |floating|  lineheight | wordcount |outdent indent | insertdatetime ',
            content_style: "body { font-size: 12pt; font-family: Calibri; }",
            insertdatetime_dateformat: '%d-%m-%Y',
            font_size_formats: "8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt",
            link_default_target: '_blank',
            convert_urls: false,
        });



        document.addEventListener('focusin', (e) => {
            if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root .tox-dialog") !== null) {
                e.stopImmediatePropagation();
            }
        });

        $('#formdatablog').on('shown.bs.modal', function () {
            $(document).off('focusin.modal');
        });

        // delete blogs
        $(document).on('click', '.deleteblog', function () {
            var obj = $(this);
            var id = $(this).attr('blogid');
            var blogimage = $(this).attr('blogimage');

            bootbox.confirm("Are you sure to delete this Blog?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deleteblog',
                        method: "get",
                        data: {
                            'id': id,
                            'blogimage': blogimage
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("File Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry File Not Deleted")
                        }
                    })
                } else { }
            });
        });

        //show image if edited in update about
        $(document).on('change', '.aboutimage', function () {
            var obj = $(this);
            var file = $(".aboutimage").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $("#showaboutimage").attr("src", reader.result);
                }
                //alert('sffsdf');
                reader.readAsDataURL(file);
            }
        });

        $(document).on('click', '#phonenum', function () {

            var obj = $(this);
            var key = $(this).attr('key');
            var html = '<div class="input-group mb-3 ">';
            html += '<span class="input-group-text">+91</span>';
            html += '<span class="input-group-text"> &nbsp;-&nbsp;</span>';
            html += '<input type="text" maxlength="10" class="form-control form-control-user" name="phone[]" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required />';
            html += '<spann class="input-group-text phonenumminus" key=' + key + ' ><i class="fa-solid fa-minus"></i></spann>';
            html += '</div>';

            obj.parent().prepend(html)

        });

        $(document).on('click', '.phonenumminus', function () {
            //alert("sdasdsadsad");
            $(this).parent().remove();
        });

        $(document).on('click', '#seotext', function () {

            var obj = $(this);
            var key = $(this).attr('key');
            var html = '<div class="input-group mt-3 ">';
            html += '<span class="input-group-text"><i class="fa-solid fa-code"></i></span>';
            html += '<textarea type="text"  class="form-control form-control-user code" name="metadata[]" required /></textarea>';
            html += '<span class="input-group-text seominus" key=' + key + ' ><i class="fa-solid fa-minus"></i></span>';
            html += '</div>';

            obj.parent().append(html);
        });

        $(document).on('click', '.seominus', function () {
            //alert("sdasdsadsad");
            $(this).parent().remove();
        });

        $(document).on('click', '.deletecontact', function () {

            var obj = $(this);
            var id = $(this).attr('contactid');

            bootbox.confirm("Are you sure to delete this Contact?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deletecontactdetails',
                        method: "get",
                        data: {
                            'id': id
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("Contact Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry Contact Not Deleted")
                        }
                    })
                } else { }
            });
        });

        $('.more').on('click', function () {
            var msg = $(this).attr('descriptiondata');
            bootbox.alert(msg)
        });

        $('.filetypebannervideo').on('change', function () {
            var type = $(this).val();
            if (type == 0) {
                $('.bannertextshow').show();
            } else {
                $('.bannertextshow').hide();
                $('.bannertextshow').removeAttr('checked');
            }
        });


        // Get the button
        let mybutton = document.getElementById("topbutton");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        $('#topbutton').on('click', function () {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });

        function scrollFunction() {

            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // will try to call function
        $(document).on('click', '.aboutalt', function () {
            var obj = $(this);
            alttagmodaldata(obj);
        });


        $(document).on('click', '.bannarsalt', function () {
            var obj = $(this);
            alttagmodaldata(obj);
        });

        $(document).on('click', '.servicealt', function () {
            var obj = $(this);
            alttagmodaldata(obj);
        });

        $(document).on('click', '.blogalt', function () {
            var obj = $(this);
            alttagmodaldata(obj);

        });


        $(document).on('click', '.zodiacedit', function () {
            var zodiacid = $(this).attr('zodiacid');
            var oldimage = $(this).attr('oldimage');
            //oldimage name needed
            $('.editzodiacoldimage').val(oldimage);
            $('.editzodiacid').val(zodiacid);
            $('#zodiacimageedit').modal('show');
        });

        $('#zodiacsignform').submit(function (event) {
            event.preventDefault();
            var actionurl = $(this).attr("action");
            var file = $(this).find("input[type=file]").get(0).files[0];
            $.ajax({
                url: actionurl,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    var massage = result;
                    console.log(massage.planet);
                    if (massage.status == 1 && massage.msg == "true") {
                        $('#zodiacimageedit').modal('hide');
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function () {
                                $('.noimage').remove();
                                console.log(massage.planet);
                                $('#planet' + massage.id).html(massage.planet);
                                $("#uploadedsign" + massage.id).attr("src", reader.result);
                            }
                            reader.readAsDataURL(file);
                        }
                    } else if (massage.status == 0 && massage.msg == "false") {
                        alert("Sorry Zodiac Not Updated");
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        $('.paymentamout').click(function () {

            var obj = $(this);
            var name = obj.attr('name');
            var id = obj.attr('id');
            var email = obj.attr('email');
            var phone = obj.attr('phone');
            var bookingdate = obj.attr('bookingdate');

            $('.paymentlinkname').text("Name : " + name);
            $('.paymentlinkemail').text("Email : " + email);
            $('.paymentlinkphonenumber').text("Phone : " + phone);
            $('.paymentlinkbookingdate').text("Booking Date : " + bookingdate);
            $('.paymentformname').val(name);
            $('.paymentformappointmentid').val(id);
            $('.paymentformemail').val(email);
            $('.paymentformphone').val(phone);
        })

        //delete review
        $(document).on('click', '.deletereview', function () {

            var obj = $(this);
            var id = $(this).attr('reviewid');

            bootbox.confirm("Are you sure to delete this Review?", function (result) {
                if (result) {
                    $.ajax({
                        url: base_url + '/deletereview',
                        method: "get",
                        data: {
                            'id': id
                        }
                    }).done(function (msg) {
                        var massage = JSON.parse(msg);
                        //console.log(massage);
                        if (massage.status == 1 && massage.msg == "true") {
                            bootbox.alert("Review Deleted Successful")
                            obj.parent().parent().remove();
                        } else if (massage.status == 0 && massage.msg == "false") {
                            bootbox.alert("Sorry Review Not Deleted")
                        }
                    })
                } else { }
            });
        });

        function alttagmodaldata(obj) {
            var page = obj.attr('page');
            var relatedid = obj.attr('relatedid');
            var alttag = obj.attr('alttag');
            var title = obj.attr('title');
            var urlview = obj.attr('urlview');
            //console.log(title);
            $('#relatedid').val(relatedid);
            $('#page').val(page);
            $('#alttitle').val(title);
            $('#alttag').val(alttag);


            var textstart = "This image belongs to ";
            var textend = ' ';
            textend += '<a href="' + urlview + '" target="_blank" class="link - warning link - offset - 2 link - underline - opacity - 25 link - underline - opacity - 100 - hover ">Here is the details page link.</a>';
            //console.log(textend);
            if (page == 'about_contact') {
                $('#pagetitle').html(textstart + ' About Us ' + textend);
            } else if (page == 'banner') {
                if (urlview == "#") {
                    $('#pagetitle').html(textstart + ' Banner thumbnail ');
                } else {
                    $('#pagetitle').html(textstart + ' Banner thumbnail ' + textend);
                }
            } else if (page == 'youtube') {
                $('#pagetitle').html(textstart + 'Youtube video thumbnail ' + textend);

            } else if (page == 'Service') {
                $('#pagetitle').html(textstart + ' Service ' + textend);
            } else if (page == 'blog') {
                $('#pagetitle').html(textstart + ' Blog ' + textend);
            } else {
                $('#pagetitle').text('source not found ');
            }
        }
    });
</script>