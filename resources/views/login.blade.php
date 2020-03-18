
@extends('layouts.login')

@section('content')

<div id="wrapper">
    <div class="no-margin-b">
        <div class="alert_box">
        </div>
        <div id="exhaustedAttempsMsg"></div>
        <section>
            <div class="col-lg-offset-4 col-lg-4 col-sm-offset-2 col-sm-8  col-xs-offset-1 col-xs-10">
                <div class="contBig">
                    <div class="outbiglogo">
                        <div class="inbiglogo">
                        </div>
                    </div>
                    <div class="headnewaccount">
                        Bienvenido a Cirenio CRM
                    </div>

                    <div class="social-auth-links text-center" style="margin: 20px 10%;">
                        <a href="/redirect">
                            <div class="abcRioButton abcRioButtonLightBlue mb-5 ml-5 mr-5">
                                <div class="abcRioButtonContentWrapper">
                                    <div class="abcRioButtonIcon" style="padding:8px">
                                        <div style="width:18px;height:18px;" class="abcRioButtonSvgImageWithFallback abcRioButtonIconImage abcRioButtonIconImage18">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg">
                                                <g>
                                                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                                    <path fill="none" d="M0 0h48v48H0z"></path>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <span style="font-size:13px;line-height:34px;" class="abcRioButtonContents">
                                        <span id="not_signed_inw452pf8sooum" style="">Acceder con Google</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @if (!empty($message))
                    <div class="alert alert-error text-center" role="alert" style="margin:0 20px">
                        {{ $message }}
                    </div>
                    @endif
                </div>

                <div class="sec-center">
                    No tienes una cuenta? Solicita una prueba gratis <a target="_blank" href="https://crm.cirenio.com/#contact-us">aqui</a>!
                </div>

                <hr>
                <div class="sec-center">
                    <a target="_blank" href="https://crm.cirenio.com/terminos">Términos y Condiciones</a>
                    <a target="_blank" style="margin-left: 5em;" href="https://crm.cirenio.com/politicas">Politicas de privacidad</a>
                </div>
            </div>

        </section>

    </div>
</div>
@endsection
