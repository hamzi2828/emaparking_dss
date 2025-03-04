{{--@if(!is_api())
	<div class="bravo_footer mt-4 border-top">
		<div class="main-footer">
			<div class="container">
				<div class="row justify-content-xl-between">
                    @if(!empty($info_contact = clean(setting_item_with_lang('footer_info_text'))))
                        <div class="col-12 col-lg-4 col-xl-3dot1 mb-6 mb-md-10 mb-xl-0">
                            <div class="my-4">
                                <img src="{{get_file_url(setting_item_with_lang('logo_id_2'))}}" alt="emaparking.co.uk" height="40"/>
                            </div>
                            {!! clean($info_contact) !!}
                        </div>
                    @endif
					@if($list_widget_footers = setting_item_with_lang("list_widget_footer"))
                        <?php $list_widget_footers = json_decode($list_widget_footers);?>
						@foreach($list_widget_footers as $key=>$item)
							<div class="col-12 col-md-6 col-lg-{{$item->size ?? '3'}} col-xl-1dot8 mb-6 mb-md-10 mb-xl-0">
								<div class="nav-footer">
                                    <h4 class="h6 font-weight-bold mb-2 mb-xl-4">{{$item->title}}</h4>
                                    {!! clean($item->content) !!}
								</div>
							</div>
						@endforeach
					@endif
                    <div class="col-12 col-md-6 col-lg col-xl-3dot1">
                        <div class="mb-4 mb-xl-2">
                            <h4 class="h6 font-weight-bold mb-2 mb-xl-4">{{ __('Mailing List') }}</h4>
                            <p class="m-0 text-gray-1">{{ __('Sign up for our mailing list to get latest updates and offers.') }}</p>
                        </div>
                        <form action="{{route('newsletter.subscribe')}}" class="subcribe-form bravo-subscribe-form bravo-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="email" class="form-control height-54 font-size-14 border-radius-3 border-width-2 border-color-8 email-input" placeholder="{{__('Your Email')}}">
                                <div class="input-group-append ml-3">
                                    <button type="submit" class="btn-submit btn btn-sea-green border-radius-3 height-54 min-width-112 font-size-14">{{__('Subscribe')}}
                                        <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-mess"></div>
                        </form>
                        <img class="mt-2" alt="emaparking.co.uk" style="width:100%;" src="https://emaparking.co.uk/uploads/0000/1/2023/05/09/whatsapp-image-2023-05-07-at-13327-am.jpeg"/>

                    </div>
				</div>
			</div>
		</div>
<!--        <div class="border-top border-bottom border-color-8 space-1">
            <div class="container">
                <div class="sub-footer d-flex justify-content-center align-items-center">
                    <a class="d-inline-flex justify-content-center align-items-center" href="{{ url('/') }}" aria-label="MyTravel">
                        {!! get_image_tag(setting_item_with_lang('logo_id_2')) !!}
                    </a>
                    <div class="footer-select bravo_topbar d-flex align-items-center">
                        <div class="mr-3">
                            @include('Language::frontend.switcher')
                        </div>
                        @include('Core::frontend.currency-switcher')
                    </div>
                </div>
            </div>
        </div>-->
		<div class="copy-right">
			<div class="container context">
				<div class="row">
					<div class="col-md-12">
						{!! setting_item_with_lang("footer_text_left") ?? ''  !!}
						<div class="f-visa">
							{!! setting_item_with_lang("footer_text_right") ?? ''  !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif--}}
<!-- Footer Section Begin -->
<footer class="footer-section" style="background: #252a3a;">
    <div class="container">
        <div class="footer-text">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ft-about">
                        <div class="logo">
                            <a href="#">
                                <img alt="emaparking.co.uk" src="https://emaparking.co.uk/uploads/0000/1/2023/04/08/02.png">
                            </a>
                        </div>
                        <p>Midlands Parking is the preferred and trusted booking website for most travel management companies and their thousands of clients. We offer the best deals for parking options at East Midlands Airport.</p>
                        <p>Company Reg No. 14674214</p>
                        <p>Vat No. 452 561987</p>
                        <div class="fa-social">
                            <a target="_blank" href="https://www.facebook.com/people/Midlands-Parking-Ltd/100092626675848/"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a target="_blank" href="https://www.youtube.com/@MidlandsParkingLtd"><i class="fa fa-youtube-play"></i></a>
                            <a target="_blank" href="https://www.instagram.com/midlandsparkingltd/"><i class="fa fa-instagram"></i></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-contact">
                        <h6>Contact Us</h6>
                        <ul>
                            <!--                            <li>+44 1234 67890</li>-->
                            <li><a href="mailto:support@emaparking.co.uk"> support@emaparking.co.uk</a></li>
                            <li>Midlands Airport Parking LTD <br>Regus East Midlands Airport. <br>Herald Way, Pegasus Business Park, <br> DE74 2TZ</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="ft-newslatter">
                        <h6>Subscribe</h6>
                        <p>Sign up for our mailing list to get latest updates and offers.</p>
                        <form action="#" class=" fn-form pb-11">
                            <input placeholder="Email" type="text">
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                    <a href="//www.dmca.com/Protection/Status.aspx?ID=7c5fd125-447d-47c1-8034-707bd8dc7c57" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca-badge-w250-5x1-10.png?ID=7c5fd125-447d-47c1-8034-707bd8dc7c57"  alt="DMCA.com Protection Status" /></a>  
                    <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                </div>
                
            </div>
        </div>
    </div>
    <div class="copyright-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul>
                        <li><a href="https://emaparking.co.uk/blog">Blog</a></li>
                        <li><a href="https://emaparking.co.uk/contact">Contact</a></li>
                        <li><a href="{{ route('page.detail', ['slug' => 'terms-conditions']) }}">Terms of use</a></li>
                        <li><a href="{{ route('page.detail', ['slug' => 'privacy-policy']) }}">Privacy Policy</a></li>
                     <!--<li><a href="https://emaparking.co.uk/Terms-and-Conditions">Terms of use</a></li>-->
                     <!--   <li><a href="https://emaparking.co.uk/page/privacy-policy">Privacy Policy</a></li>-->
                        <!--<li><a href="#">Environmental Policy</a></li>-->
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="co-text">
                        <p class="text-white">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Midlands Airport Parking LTD. All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('Layout::parts.login-register-modal')
@include('Popup::frontend.popup')
@if(Auth::id())
	@include('Media::browser')
@endif
<link rel="stylesheet" href="{{asset('libs/flags/css/flag-icon.min.css')}}">

{!! \App\Helpers\Assets::css(true) !!}

{{--Lazy Load--}}
<script src="{{asset('libs/lazy-load/intersection-observer.js')}}"></script>
<script async src="{{asset('libs/lazy-load/lazyload.min.js')}}"></script>
<script>
    // Set the options to make LazyLoad self-initialize
    window.lazyLoadOptions = {
        elements_selector: ".lazy",
        // ... more custom settings?
    };

    // Listen to the initialization event and get the instance of LazyLoad
    window.addEventListener('LazyLoad::Initialized', function (event) {
        window.lazyLoadInstance = event.detail.instance;
    }, false);
</script>
<script src="{{ asset('libs/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('themes/mytravel/libs/jquery-migrate/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('themes/mytravel/libs/header.js') }}?v=1"></script>
<script>
    $(document).on('ready', function () {
        $.MyTravelHeader.init($('#header'));
    });
</script>
<script src="{{ asset('libs/lodash.min.js') }}"></script>
<script src="{{ asset('libs/vue/vue'.(!env('APP_DEBUG') ? '.min':'').'.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>

<script src="{{ asset('themes/mytravel/libs/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('themes/mytravel/libs/slick/slick.js') }}"></script>


@if(Auth::id())
	<script src="{{ asset('module/media/js/browser.js?_ver='.config('app.asset_version')) }}"></script>
@endif
<script src="{{ asset('libs/carousel-2/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/moment.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("libs/daterange/daterangepicker.min.js") }}"></script>
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('themes/mytravel/js/functions.js?_ver='.config('app.asset_version')) }}"></script>
<script src="{{asset('themes/mytravel/libs/custombox/custombox.min.js')}}"></script>
<script src="{{asset('themes/mytravel/libs/custombox/custombox.legacy.min.js')}}"></script>
<script src="{{ asset('themes/mytravel/libs/custombox/window.modal.js') }}"></script>

@if(
    setting_item('tour_location_search_style')=='autocompletePlace' || setting_item('hotel_location_search_style')=='autocompletePlace' || setting_item('car_location_search_style')=='autocompletePlace' || setting_item('space_location_search_style')=='autocompletePlace' || setting_item('hotel_location_search_style')=='autocompletePlace' || setting_item('event_location_search_style')=='autocompletePlace'
)
	{!! App\Helpers\MapEngine::scripts() !!}
@endif
<script src="{{ asset('libs/pusher.min.js') }}"></script>
<script src="{{ asset('themes/mytravel/js/home.js?_ver='.config('app.asset_version')) }}"></script>

@if(!empty($is_user_page))
	<script src="{{ asset('module/user/js/user.js?_ver='.config('app.asset_version')) }}"></script>
@endif
@if(setting_item('cookie_agreement_enable')==1 and request()->cookie('booking_cookie_agreement_enable') !=1 and !is_api()  and !isset($_COOKIE['booking_cookie_agreement_enable']))
	<div class="booking_cookie_agreement p-3 fixed-bottom">
		<div class="container d-flex ">
            <div class="content-cookie">{!! setting_item_with_lang('cookie_agreement_content') !!}</div>
            <button class="btn save-cookie">{!! setting_item_with_lang('cookie_agreement_button_text') !!}</button>
        </div>
	</div>
	<script>
        var save_cookie_url = '{{route('core.cookie.check')}}';
	</script>
	<script src="{{ asset('js/cookie.js?_ver='.config('app.asset_version')) }}"></script>
@endif
@if(setting_item('user_enable_2fa'))
    @include('auth.confirm-password-modal')
    <script src="{{asset('/module/user/js/2fa.js')}}"></script>
@endif

<script src="/home/js/bootstrap.min.js"></script>
<script src="/home/js/jquery.magnific-popup.min.js"></script>
<script src="/home/js/jquery.nice-select.min.js"></script>
<script src="/home/js/jquery-ui.min.js"></script>
<script src="/home/js/jquery.slicknav.js?v=1"></script>
<script src="/home/js/owl.carousel.min.js"></script>
<script src="/home/js/main.js?v=1"></script>

<script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/cdb.min.js"></script>
{!! \App\Helpers\Assets::js(true) !!}
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        Livewire.on('error', (data) => {
            Swal.fire({
                text: data.message,
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            })
        })

        Livewire.on('success', (data) => {
            Swal.fire({
                text: data.message,
                icon: 'success',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            })
        })
        @if(session()->has('success'))
        Swal.fire({
            text: '{{ session()->get('success') }}',
            icon: 'success',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
        })
        @endif
        @if(session()->has('error'))
        Swal.fire({
            text: '{{ session()->get('error') }}',
            icon: 'error',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
        })
        @endif
    });

</script>
@stack('js')

@php \App\Helpers\ReCaptchaEngine::scripts() @endphp
