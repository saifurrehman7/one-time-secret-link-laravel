@extends('layout.master')
<style>
    .copy-url {
        border: 1px springgreen solid;
        background: linear-gradient(135deg, #bda47f, #e8e8e8, #ff9900);
        width: 100%;
        padding: 6px;
        border-radius: 7px;
        font-weight: 500;
        text-align: center;
    }

    .genete-btn {
        background-color: #ff9900;
        color: #fff;
        border: none;
        border-radius: 7px;
        font-weight: bold;
        font-size: 20px;
        text-align: center;
        width: 100%;
        margin-top: 15px;
    }

    .btn-burnt {
        width: 100%;
        font-weight: 500;
        font-size: 20px !important;
        border: 1px solid gray !important;
        background: linear-gradient(to bottom, #fff, #e6e6e6);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    textarea {
        min-height: 100px;
        padding: 10;
    }

    .show-password {
        opacity: 0;
        transform: translateX(-100%);
        animation: slideIn 0.6s ease-out forwards;
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

@section('content')
<div class="container">

</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            @if($link->first_url == 0)
            <div class="show-password">
                <p>Here is your secret link:</p>
                <input type="text" class="copy-url py-2" id="copyInput" readonly
                    value="{{ route('view-password', $link->slug) }}" />
            </div>
            <button class="genete-btn py-3" onclick="copyToClipboard()">Copy Link</button>
            <div class="pt-5">
                <h3>Or, send your link directly to our helpdesk.</h3>
                {{-- Alert container --}}
                <div id="alert-container"></div>
                {{-- Loader --}}
                <div id="loader" style="display:none;" class="text-center my-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Sending, please don't refresh the page...</span>
                    </div>
                    <p>Sending, please don't refresh the page...</p>
                </div>
                <form id="helpdeskForm">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control py-3" name="first_name" placeholder="First Name"
                                required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control py-3" name="last_name" placeholder="Last Name"
                                required>
                        </div>
                        <div class="col-12">
                            <button class="genete-btn py-3 mt-3" type="submit">Send to Helpdesk</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pt-5">
                <h3>Secret</h3>
                <textarea disabled class="w-100">{{ $link->secret_text }}</textarea>
            </div>
            @else
            <div>
                <h3>Your Secret (You can only see this once)</h3>
                <textarea disabled class="w-100" type="password">************</textarea>
            </div>
            @endif

            <div class="pt-3">
                <h3>Expires in {{ $daysLeft + 1 }} Days</h3>
            </div>

            <div class="pt-3">
                <a href="{{ url('burn-link') }}/{{ base64_encode($link->id) }}" class="btn btn-burnt py-3 fw-normal">🔥
                Burn this secret*</a>
            </div>

            @if($link->first_url == 1)
            <div class="pt-3">
                <a href="{{ url('/') }}" class="genete-btn d-flex justify-content-center py-3 mt-3">Create another
                    secret</a>
            </div>
            @endif

            <div class="pt-5">
                <h3>F.A.Q.</h3>
                <h4>What if I forgot to copy the shared link?</h4>
                <p>You need to create a new secret. We can't retrieve it for you.</p>
                <h4>How long will the secret be available?</h4>
                <p>The secret link will be available for @if(($daysLeft + 1) == 1)
                     {{ $daysLeft + 1 }} day @else {{ $daysLeft + 1 }} days
                @endif  or until it's viewed.</p>
                <h4>What happens when I burn a secret?</h4>
                <p>Burning a secret deletes it before it's read. If someone receives a link but it's burned before they
                    view it, they won’t be able to access it at all.</p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function copyToClipboard() {
        const input = document.getElementById("copyInput");
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied: " + input.value);
    }
    
</script>

<script>
    $(document).ready(function () {
    $('#helpdeskForm').submit(function (e) {
        e.preventDefault();

        // disable button
        let $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.prop('disabled', true).text('Sending...');

        $('#alert-container').html('');      // Clear previous alerts
        $('#loader').show();                 // Show loader

        $.ajax({
            url: "{{ route('send-secret', $link->slug) }}",
            method: "POST",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#loader').hide();
                $('#alert-container').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Email successfully sent to helpdesk.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);

                $('#helpdeskForm')[0].reset();

                setTimeout(() => {
                    $('.alert').fadeOut('slow');
                }, 3000);
            },
            error: function () {
                $('#loader').hide();
                $('#alert-container').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ❌ Email not sent. Please try again after a few minutes.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);

                setTimeout(() => {
                    $('.alert').fadeOut('slow');
                }, 3000);
            },
            complete: function () {
                // re-enable button no matter success or error
                $submitBtn.prop('disabled', false).text('Send to Helpdesk');
            }
        });
    });
});

</script>

@endsection