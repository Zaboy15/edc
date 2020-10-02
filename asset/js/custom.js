$(function(){
    $('.login-btn').on('click', function(e){
        $('.login-form').trigger('reset');
    });

    $('.mobile-toggle').click(function(e)
    {
        $(this).toggleClass('active');
        $('.pure-menu-fixed').toggleClass('active');
        $('.mobile-menu').toggleClass('active');
        $('body').toggleClass('active');
    });

    $(".password-login").on('keypress', function(e){
        if(e.keyCode == 13)
        {
            $('.login-form').submit();
        }
    });

    $(".email-login").on('keypress', function(e){
        if(e.keyCode == 13)
        {
            $('.login-form').submit();
        }
    });

    $('.login-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            return false;
        }
    });

    $('#city').on('change', function(e){
        e.preventDefault();
        var store = $('#store');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        });
        
        $.ajax({
            url: $(this).attr('action'),
            method: "GET",
            dataType: "json",
            data: {
                city: $(this).val()
            },
            beforeSend: function() {
                toastr.info('Sedang load toko ...');
                store.find('option').remove();
                store.append('<option selected="true" disabled>Nama Toko</option>');
            },
            success: function(result)
            {
                toastr.clear();
                toastr.success('Toko berhasil termuat ...');
                store.focus();
                $.each(result.data, function(i, dt){
                    store.append(new Option(dt.name.toUpperCase(), dt.name.toUpperCase()));
                });
            }
        });

        return false;
    });

    $('.login-form').on('submit', function(e){
        e.preventDefault();
        
        var rawdata = $(this).serializeArray();
        var data = {};
        $.each(rawdata, function(i, field) 
        {            
            data[field.name] = field.value;
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        });

        var to = $(this).attr('to');
        
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: "json",
            data: {
                email: data.email,
                password: data.password,
            },
            beforeSend: function() {
                toastr.info('Please wait authentication in progress ...');
            },
            success: function(result)
            {
                // alert(result.status);
                if(result.status == 200)
                {
                    swal({
                        icon: 'success',
                        title: 'Login Berhasil !',
                        text: 'Silahkan Tunggu Beberapa Saat.',
                        button: false,
                        timer: 3000
                    }).then(() => {
                        // alert(to);
                        window.location.href = to;
                    });
                }
                else
                {
                    swal({
                        icon: 'error',
                        title: 'Login Failed !',
                        text: 'Email atau Password salah !.',
                        button: false,
                        timer: 3000
                    }).then(() => {
                        $('.login-form').trigger('reset');        
                    });
                }
                // console.log(result);
                // toastr.clear();
                // if(result.status == 200)
                // {
                //     toastr.success(result.data, result.message);
                // }
                // else
                // {
                //     toastr.error(result.data, result.message);
                // }
            }
        });

        return false;
    });

    $('.login-submit').on('click', function(){
        $('.login-form').submit();
    });

    var notif = null;

    $('.submit-claim').on('click', function(){
        notif = false;
        // $('.form-claim').submit();
    });

    $('.form-claim').on('submit', function(e){
        e.preventDefault();

        var data = new FormData($(this)[0]);
        // $.each(rawdata, function(i, field) 
        // {            
        //     data.append(field.name, field.value);
        // });

        // for (var i = 0; i < total_images; i++) {
        //     data.append('foto[]', images.files[i]);
        // }

        console.log(data);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        });
        
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                Swal.fire({
                    imageUrl: $(location).attr('protocol') + "//" + $(location).attr('hostname') + "/images/loading.gif",
                    title: 'Claim sedang diproses...',
                    text: 'Silahkan Tunggu Beberapa Saat.',
                    showConfirmButton: false,
                });
            },
            success: function(result)
            {
                // console.log(result);
                Swal.close();
                if(result.status == 500)
                {
                    $('.form-claim').trigger('reset');        
                    Swal.fire({
                        title: 'Kesalahan Input',
                        text: result.message,
                        icon: 'error',
                    });
                }
                else if(result.status == 200)
                {
                    $('.form-claim').trigger('reset');        
                    Swal.fire({
                        title: 'Submit berhasil',
                        text: result.message,
                        icon: 'success',
                    });
                }
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });

        return false;
    });

    $("#foto").on("change", function(e) {
        var tot_size=0;
        var count_files = $(this).get(0).files.length;
        var err_var = false;

        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            var file1=$(this).get(0).files[i].name;
            if(!/(\.png|\.jpg|\.jpeg|\.pdf)$/i.test(file1))
            {
                swal("Error !", "File hanya dibolehkan JPG, PNG, dan JPEG !", "error");
                var err_var = true;
            }
            else
            {
                var err_var = false;
            }
        }

        if(err_var == false)
        {
            if(count_files > 3)
            {
                swal("Error !", "File hanya dibolehkan 3 file", "error");            
                $(this).val('');
            }
        }
    });

    $('.form-claim').validate({
        rules: {
            city: {
                required: true
            },
            store: {
                required: true
            },
            product: {
                required: true
            },
            fullname: {
                required: true
            },
            phone: {
                required: true
            },
            sn: {
                required: true
            },
            foto: {
                required: true
            }
        },
        highlight: function (element) {
            if(notif == false)
            {
                swal("Error !", "Ada field yang belum diisi !", "error");
                notif = true;
            }
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            // claimRequest();
        }
    });
});