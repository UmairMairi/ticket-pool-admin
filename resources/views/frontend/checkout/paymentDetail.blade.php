@extends('frontend.master', ['activePage' => 'frontend.checkout.expressCheckout'])
@section('title', __('Checkout'))
@section('content')
    <div class="flex flex-col justify-center container gap -10 m-auto w-[80%] mt-10 mb-10 msm:flex-row msm:mt-20 msm:w-[70%]">

        <div class="flex min-h-full flex-col px-6 py-12 h-112  msm:w-1/2"
             style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
            <div class="w-full">
                <h2 class="text-left text-2xl font-bold leading-9 tracking-tight text-gray-900">Payment Details</h2>
            </div>
            <div class="mt-5 w-full">
                <form class="space-y-6" action="{{route('checkout_process')}}" method="POST">
                    @csrf
                    <input type="hidden" name="totalAmountTax" id="totalAmountTax" value="{{ $data->totalAmountTax }}">
                    <input type="hidden" name="totalPersTax" id="totalPersTax" value="{{ $data->totalPersTax }}">
                    <input type="hidden" name="flutterwave_key"
                           value="{{ \App\Models\PaymentSetting::find(1)->ravePublicKey }}">
                    <input type="hidden" name="email" value="{{ auth()->guard('appuser')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ auth()->guard('appuser')->user()->phone }}">
                    <input type="hidden" name="name" value="{{ auth()->guard('appuser')->user()->name }}">
                    <input type="hidden" name="flutterwave_key"
                           value="{{ \App\Models\PaymentSetting::find(1)->ravePublicKey }}">
                    <input type="hidden" name="seatsIoIds" id="seatsIoIds" value="{{ $data->seatsIoIds }}">
                    <input type="hidden" name="selectedSeatsIo" id="selectedSeatsIo"
                           value="{{ $data->selectedSeatsIo }}">

                    <input type="hidden" id="razor_key" name="razor_key"
                           value="{{ \App\Models\PaymentSetting::find(1)->razorPublishKey }}">

                    <input type="hidden" id="stripePublicKey" name="stripePublicKey"
                           value="{{ \App\Models\PaymentSetting::find(1)->stripePublicKey }}">
                    {{-- <input type="hidden" value="{{ $data->ticket_per_order }}" name="tpo" id="tpo"> --}}
                    <input type="hidden" value="" name="tpo" id="tpo">
                    {{-- <input type="hidden" value="{{ $data->available_qty }}" name="available" id="available"> --}}
                    <input type="hidden" value="" name="available" id="available">
                    {{-- <input type="hidden" name="price" id="ticket_price" value="{{ $data->price }}"> --}}
                    <input type="hidden" name="price" id="ticket_price" value="">

                    {{-- <input type="hidden" name="tax" id="tax_total" value="{{ $data->type == 'free' ? 0 : $data->tax_total }}"> --}}
                    <input type="hidden" name="tax" id="tax_total" value="{{ $data->tax_total }}">
                    <input type="hidden" name="payment" id="payment"
                           value="{{ $data->price_total + $data->tax_total }}">
                    @php
                        $price = $data->price_total + $data->tax_total;
                        if ($data->currency_code == 'USD' || $data->currency_code == 'EUR' || $data->currency_code == 'INR') {
                            $price = $price * 100;
                        }
                    @endphp
                    <input type="hidden" name="stripe_payment" id="stripe_payment"
                           value="{{ $price }}">


                    <input type="hidden" name="currency_code" id="currency_code" value="{{ $data->currency_code }}">
                    <input type="hidden" name="currency" id="currency" value="{{ $data->currency }}">
                    <input type="hidden" name="payment_token" id="payment_token">

                    @php
                        if($data->ticket)
                            {
                           $ticketIdsArray = array_column($data->ticket,'id');
                           $ticketIds =  implode(",",$ticketIdsArray);
                            }
                        else{
                           $ticketIds =  $data->id;
                        }
                    @endphp

                    <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticketIds }}">
                    <input type="hidden" name="selectedSeats" id="selectedSeats">
                    <input type="hidden" name="selectedSeatsId[]" id="selectedSeatsId">

                    <input type="hidden" name="coupon_id" id="coupon_id" value="">
                    <input type="hidden" name="coupon_discount" id="coupon_discount" value="0">
                    <input type="hidden" name="subtotal" id="subtotal" value="">
                    <input type="hidden" name="add_ticket" value="">
                    {{-- <input type="hidden" class="tax_data" id="tax_data" name="tax_data" value="{{ $data->tax }}"> --}}
                    <input type="hidden" class="tax_data" id="tax_data" name="tax_data" value="">
                    <input type="hidden" name="event_id" value="{{ $data->event->event_id }}">
                    {{-- <input type="hidden" name="ticketname" id="ticketname" value="{{ $data->name }}"> --}}
                    <input type="hidden" name="ticketname" id="ticketname" value="">
                    <input type="hidden" id="quantity" name="quantity" value="{{$data->totalTickets}}">
                    <div class="flex md:space-x-5 md:flex-row md:space-y-0 sm:flex-col sm:space-x-0 sm:space-y-5 xxsm:flex-col xxsm:space-x-0 xxsm:space-y-5 mb-5 payments">
                        <?php $setting = App\Models\PaymentSetting::find(1); ?>
                        {{-- @if ($data->type == 'free')
                            <div
                                class="  p-5 rounded-lg text-gray-100 w-full font-normal text-base leading-6 flex">
                                {{ __('FREE') }}
                                <input id="default-radio-1" required type="radio" value="FREE"
                                    name="payment_type"
                                    class="ml-2 h-5 w-5 mr-2   hover:border-gray-light focus:outline-none">
                            </div>
                        @else --}}
                        @if ($setting->paypal == 1)
                            <div
                                    class="  p-5 rounded-lg text-gray-100 w-full font-normal text-base leading-6 flex align-middle">
                                <input id="Paypal" required type="radio" value="PAYPAL"
                                       name="payment_type"
                                       class="h-5 w-5 mr-2   hover:border-gray-light focus:outline-none">
                                <label for="Paypal"><img
                                            src="{{ asset('images/payments/paypal.svg') }}"
                                            alt="" class="object-contain"></label>
                            </div>
                        @endif

                        @if ($setting->razor == 1)
                            <div
                                    class=" p-5 rounded-lg text-gray-100 w-full font-normal text-base leading-6 flex items-center">
                                <input id="Razor" required type="radio" value="RAZOR"
                                       name="payment_type"
                                       class="h-5 w-5 mr-2   hover:border-gray-light focus:outline-none">
                                <label for="Razor"><img
                                            src="{{ asset('images/payments/razorpay.svg') }}"
                                            alt="" class="object-contain"></label>
                            </div>
                        @endif

                        @if ($setting->stripe == 1)
                            <div
                                    class=" p-5 rounded-lg text-gray-100 w-full font-normal text-base leading-6 flex items-center">
                                <input id="Stripe" required type="radio" value="STRIPE"
                                       name="payment_type"
                                       class="h-5 w-5 mr-2   hover:border-gray-light focus:outline-none">
                                <label for="Stripe"><img
                                            src="{{ url('images/payments/stripe.svg') }}"
                                            alt="" class="object-contain"></label>
                            </div>
                        @endif

                        @if ($setting->flutterwave == 1)
                            <div
                                    class=" p-5 rounded-lg text-gray-100 w-full font-normal text-base leading-6 flex">
                                <input id="Flutterwave" required type="radio"
                                       value="FLUTTERWAVE" name="payment_type"
                                       class="h-5 w-5 mr-2   hover:border-gray-light focus:outline-none">
                                <label for="Flutterwave"><img
                                            src="{{ url('images/payments/flutterwave.svg') }}"
                                            alt="" class="object-contain"></label>
                            </div>
                        @endif

                        @if (
                            $setting->cod == 1 ||
                                ($setting->flutterwave == 0 && $setting->stripe == 0 && $setting->paypal == 0 && $setting->razor == 0))
                            <div
                                    class="items-center  p-5 rounded-lg text-gray-100 w-full font-normal text-base leading-6 flex">
                                <input id="Cash" type="radio" value="LOCAL"
                                       name="payment_type"
                                       class="h-5 w-5 mr-3   hover:border-gray-light focus:outline-none">
                                <label for="Cash"><img
                                            src="{{ url('images/payments/cash.svg') }}"
                                            alt="" class="object-contain"></label>
                            </div>
                        @endif
                        @if ($setting->wallet == 1)
                            <div
                                    class=" p-5 rounded-lg text-gray-100 w-full font-normal text-base leading-6 flex">
                                <input id="wallet" type="radio" value="wallet"
                                       name="payment_type"
                                       class="h-5 w-5 mr-2   hover:border-gray-light focus:outline-none">
                                <label for="wallet"><img
                                            src="{{ url('images/payments/wallet.svg') }}"
                                            alt="" class="object-contain"></label>
                            </div>
                        @endif

                        {{-- @endif --}}
                    </div>

                    <div>
{{--                        <button type="submit" id="form_submit"--}}
{{--                                class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black"--}}
{{--                                <?php--}}
{{--                                if (!isset($_REQUEST['payment_type']) && $setting->cod == 0 && $setting->wallet == 0){ ?> disabled <?php--}}
{{--                                                                                                                                   }--}}
{{--                                                                                                                                   ?>--}}
{{--                        >--}}
{{--                            {{ __('Place Order') }}--}}
{{--                        </button>--}}
                        <button type="submit" id="form_submit"
                                class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black"
                                onclick="this.disabled = true;" style="cursor:pointer;">
                            {{ __('Place Order') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex min-h-full flex-col px-6 py-12 h-auto relative msm:w-1/2"
             style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
            @include('frontend.checkout.ticketDetail')
        </div>
    </div>
@endsection