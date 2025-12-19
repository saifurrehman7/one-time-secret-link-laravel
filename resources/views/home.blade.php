@extends('layout.master')
<style>
    .select-expiry {
        width: 160px
    }

    .expiry-options {
        border: 1px solid gray;
        padding: 30px;
        display: flex;
        justify-content: center;
        border-radius: 5px;
        position: relative;
        border: 1px solid #ccc !important;
    }

    .options {
        position: absolute;
        top: 0;
        left: 0;
        background: #ececec;
        color: black;
        font-size: 13px;
        padding: 5px;
        border-radius: 4px
    }

    textarea {
        border: 1px solid #ccc !important;
        height: 150px;
    }

    .genete-btn {
        -webkit-font-smoothing: antialiased;
        background-color: #ff9900;
        background-repeat: repeat-x;
        background-image: none;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.00);
        font-weight: bold;
        font-size: 20px;
        text-align: center;
        width: 100%;
        font-weight: 7600 !important;
        margin-top: 15px;
        color: #ffffff;
        border: none;
        border-radius: 7px;
    }

    h2 {
        font-size: 50px !important;
        font-weight: bold !important
    }

    .contact-cta {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    .contact-cta .cta {
        font-size: 3rem;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .contact-cta .cta span {
        color: #ff9900;
    }

    .contact-cta .cta .black {
        color: black;
    }

    .contact-cta .line {
        flex-grow: 1;
        height: 2px;
        background-color: black;
        max-width: 100px;
        box-shadow: rgba(0, 0, 0, 0.35) 0 5px 15px;
    }

    .contact-cta .button-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 45px;
    }

    .contact-cta .button-container .circle-button {
        background-color: #ff9900;
        color: white;
        font-size: 20px;
        font-weight: bold;
        border: none;
        border-radius: 50%;
        width: 130px;
        height: 130px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: rgba(0, 0, 0, 0.35) 0 5px 15px;
    }

    .contact-cta .work {
        color: #ff9900;
        font-size: 45px;
        font-weight: bold;
    }

    .lock-img {
        height: 200px;
        width: 200px;
    }

    @media (max-width: 600px) {
        .contact-cta .line {
            max-width: 50px;
        }

        h2 {
            font-size: 20px !important;
        }
    }
</style>

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            @if(session('error'))
                <div class="col-12 col-md-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <div class="col-lg-10 col-md-8 text-lg-start text-center">
                <h2 style="color: #ff9900">Onetime Secret</h2>
                <h2 style="color: #ff9900" class="pb-3">Signed.<em>Sealed</em>.Delivered
                </h2>
                <p class="pb-3">Keep sensitive info out of your email and chat logs.</p>
            </div> 
            <div class="col-10 px-0"
                 style="border: 1px solid #e1e1e1; border-radius: 15px; overflow: hidden; box-shadow: rgba(0, 0, 0, 0.24) 0 3px 8px;">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="d-md-flex justify-content-between" style="background: #f7d9ad; padding: 20px;">
                            <div>
                                <strong>Create Secret Link</strong>
                            </div>
                            <div class="mt-md-0 mt-2">
                            <span
                                style="color: gray; font-size: 14px; cursor: not-allowed; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;background: white; padding: 6px; border-radius: 10px;">Protected
                                with end-to-end encryption 🔒</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 py-md-5 py-4 px-md- px-4">
                        <div>
                            <form action="{{route('create-link')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="website" style="display:none">
                                    <textarea class="form-control mb-4" name="secret_text"
                                              placeholder="Secret content goes here..." required></textarea>
                                    <div class="expiry-options">
                                        <div>
                                            <p class="options">Privacy Options</p>
                                        </div>
                                        <div>
                                            <label for="">Lifetime:</label>
                                            <select name="expires_at" class="select-expiry">
                                                <option value="1">1 Day</option>
                                                <option value="3">3 Days</option>
                                                <option value="7" selected>7 Days</option>
                                                <option value="15">15 Days</option>
                                                <option value="30">30 Days</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="genete-btn py-3">Create a secret link*</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 pt-5">
                <section class="contact-cta">
                    <div class="cta">
                        <span>Ready to Scale</span>
                        <span class="black pt-md-0 pt-2">Your Business</span>
                        <span class="work">with IT?</span>
                    </div>
                    <div class="button-container">
                        <div class="line"></div>
                        <a href="#" class="circle-button text-decoration-none">Contact
                            Us</a>
                        <div class="line"></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            let alert = document.getElementById('alert');
            if (alert) {
                alert.style.display = "none";
            }
        }, 5000);
    </script>
@endsection
