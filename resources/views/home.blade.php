<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .bg-light {
            background-color: #e3e3e3 !important;
        }

        .text-justify {
            text-align: justify;
        }

        body {
            font-size: .7rem;
        }

        h5 {
            font-size: .8rem;
        }

        h6 {
            font-size: .7rem;
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-4">

    <div class="row justify-content-center py-3">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="card border-0 bg-white shadow-sm">
                <div class="card-body">
                    <div class="text-center pb-4">
                        <img src="{{ asset('noxy-logo.png') }}" height="60px" alt="Noxy Labs">
                    </div>
                    <h5>NOXY LABS ANTI-COUNTERFEITING SYSTEM</h5>
                    <p class="text-justify">
                        In order to assure all of you enjoy the benefits of authentic <b>Noxy Labs</b> products, our
                        company constantly push ourselves to limits, we focus on solutions that serve our customers to
                        verify authenticity with a multi-layered technology that uses multiple random and unique
                        signatures.
                    </p>
                    <p class="text-justify">
                        You can easily identify your purchased product by the code printed on the package under the
                        scratch line:
                    </p>
                    <h6>STEP 1</h6>
                    <p class="text-justify">
                        Observe the package carefully before you open it. It should be intact and all seals must not be
                        broken. It is observed by an irreversible holographic effect when opened for tamper evidence and
                        anti-counterfeiting protection.
                    </p>
                    <h6>STEP 2</h6>
                    <p class="text-justify">
                        Find the serial number under a scratch line. It should look like "UUAA-LEE1-WB34" in capital
                        letters. Enter them in the below verification form exactly as it is printed, please check
                        carefully because they can look similar, when you ready press 'Check'.
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-12" id="alert"></div>
                        <div class="col-4">
                            <input id="code-1" maxlength="4" type="text" class="form-control text-center">
                        </div>
                        <div class="col-4">
                            <input id="code-2" maxlength="4" type="text" class="form-control text-center">
                        </div>
                        <div class="col-4">
                            <input id="code-3" maxlength="4" type="text" class="form-control text-center">
                        </div>
                    </div>
                    <div class="row justify-content-center pt-3">
                        <div class="col-5">
                            <a href="#" class="btn btn-sm btn-outline-primary w-100">Test Reports</a>
                        </div>
                        <div class="col-5">
                            @csrf
                            <input type="hidden" name="code" id="code">
                            <a href="{{ route('check') }}" id="check" class="btn btn-sm btn-block btn-secondary w-100">
                                Check</a>
                        </div>
                    </div>
                    <div class="pt-4 small">
                        contact: <a href="" class="text-decoration-none">noxylabs@proton.me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script>
    $(document).ready(() => {
        let codeValue = () => {
            $('#alert').html('');
            if ($('#code-1').val().length !== 4) {
                $('#check').addClass('btn-secondary').removeClass('btn-success');
                return $('#code-1').focus();
            }
            if ($('#code-2').val().length !== 4) {
                $('#check').addClass('btn-secondary').removeClass('btn-success');
                return $('#code-2').focus();
            }
            if ($('#code-3').val().length !== 4) {
                $('#check').addClass('btn-secondary').removeClass('btn-success');
                return $('#code-3').focus();
            }
            $('#check').removeClass('btn-secondary').addClass('btn-success');
            let code = $('#code-1').val() + '-' + $('#code-2').val() + '-' + $('#code-3').val();
            $('#code').val(code);
        };
        $('#code-1').on('input', function () {
            if ($(this).val().length === 4) {
                $('#code-2').focus();
            }
        });
        $('#code-2').on('input', function () {
            if ($(this).val().length === 4) {
                $('#code-3').focus();
            }
        });
        $('#code-3').on('input', function () {
            if ($(this).val().length === 4) {
                codeValue();
            }
        });
        $('#check').on('click', (e) => {
            e.preventDefault();
            let code = $('#code').val();
            $.post($('#check').attr('href'), {code: code, _token: $('[name=_token]').val()}, (rsp) => {
                if (rsp.error === 'input') {
                    $('#code-1, #code-2, #code-3').val('');
                    return codeValue();
                }
                if (rsp.error === 'alert') {
                    $('#alert').html('<div class="alert alert-' + rsp.alert + '"><h4 class="alert-heading">' + rsp.title + '</h4>' + rsp.message + '</div>')
                }
                console.log(rsp);
            });
        });
    });
</script>
</body>
</html>
