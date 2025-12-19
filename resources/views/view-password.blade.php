@extends('layout.master')

<style>
    .genete-btn {
        background-color: #ff9900;
        font-size: 20px;
        width: 100%;
        color: #fff;
        border-radius: 7px;
        margin-top: 15px;
        font-weight: bold;
        border: none;
    }

    .btn-burnt {
        background: linear-gradient(to bottom, #fff, #ff9900);
        border: 1px solid gray;
        font-size: 18px;
        font-weight: 500;
        width: 100%;
    }

    textarea {
        min-height: 100px;
    }

    .this-is-message {
        display: none;
    }
</style>

@section('content')
<div id="page-container">
    <div id="content-wrap">
        <div class="container mt-5">
            <section class="upper-section">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 pt-5">
                        <h3>Click to continue:</h3>
                        <button class="genete-btn py-3 mt-3" id="viewSecretBtn"
                            data-slug="{{ base64_encode($link->slug) }}">
                            View Secret
                        </button>
                        <p>(Careful: we will only show it once.)</p>
                    </div>
                </div>
            </section>

            <section class="this-is-message" id="secretBox">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 pt-5">
                        <h3>This message is for you:</h3>
                        <textarea disabled class="w-100" id="secretText"></textarea>
                    </div>
                    <div class="col-12 col-md-8 pt-3">
                        <a href="{{ url('/') }}" class="btn btn-burnt py-3">Do you want to generate another secret?*</a>
                    </div>
                    <div class="col-12 col-md-8 pt-5">
                        <div>
                            <h3>F.A.Q.</h3>
                            <h4>What if I forgot to copy the shared link?</h4>
                            <p>You need to create a new secret. We can't retrieve it for you.</p>

                            <h4>How long will the secret be available?</h4>
                            <p>The secret link will be available for 7 days or until it's viewed.</p>

                            <h4>What happens when I burn a secret?</h4>
                            <p>Burning a secret will delete it before it has been read.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#viewSecretBtn').on('click', function () {
        const encodedSlug = $(this).data('slug');
        const url = `/show-secret-code/${encodedSlug}`;

        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#secretText').val(response.secret_text);
                $('#secretBox').fadeIn();
                $('.upper-section').hide();  
            },
            error: function (xhr) {
                alert('Failed to load secret or it has already been viewed.');
            }
        });
    });
</script>
@endsection