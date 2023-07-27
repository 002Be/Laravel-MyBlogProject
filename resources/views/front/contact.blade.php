@extends("front.layouts.master")
@section("title","İletişim")
@section("content")
@section("bg","https://picsum.photos/id/50/1920/1200")

<div class="col-md-2"></div>
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>İletişime geçmek ister misiniz? Bana mesaj göndermek için aşağıdaki formu doldurun, size en kısa sürede geri döneceğim!</p>
                <div class="my-5">
                    <form method="POST" action="{{Route('contact.post')}}">
                        @csrf
                        <div class="form-floating">
                            <input class="form-control" id="name" type="text" placeholder="Enter your name..." required name="name"/>
                            <label for="name">Ad Soyad</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">Zorunlu alan</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="email" type="email" placeholder="Enter your email..." required name="mail"/>
                            <label for="email">E-Posta</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">Zorunlu alan</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">E-posta geçerli değil.</div>
                        </div>
                        <div class="form-floating">
                            <select class="form-control" name="subject" id="subject" placeholder="Enter your subject..." required>
                                <option value="Bilgi">Bilgi</option>
                                <option value="Destek">Destek</option>
                                <option value="Genel">Genel</option>
                            </select>
                            <label for="subject">Konu</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" id="message" placeholder="Enter your message here..." style="height: 12rem" required name="message"></textarea>
                            <label for="message">Mesaj</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">Zorunlu alan</div>
                        </div>
                        <br/>
                        <div class="text-center mb-3">
                            <!-- <div class="fw-bolder">@ if(session("success")) Form gönderimi başarılı! @ endif</div> -->
                            <div class="fw-bolder">@if(session("success")) {{session("success")}} @endif</div>
                        </div>
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Mesaj gönderirken hata oluştu!</div></div>
                        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">İlet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection