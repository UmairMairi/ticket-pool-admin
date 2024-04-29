@extends('frontend.master', ['activePage' => 'frontend.checkout.expressCheckout'])
@section('title', __('Checkout'))
@section('content')
<div class="flex flex-col justify-center container gap -10 m-auto w-[80%] mt-10 mb-10 msm:flex-row msm:mt-20 msm:w-[70%]">
    <div class="flex min-h-full flex-col px-6 py-12 h-112  msm:w-1/2" style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
        <div class="w-full">
            <h2 class="text-left text-2xl font-bold leading-9 tracking-tight text-gray-900">Express Checkout</h2>
        </div>

        <input type="hidden" name="totalAmountTax" id="totalAmountTax" value="{{ $data->totalAmountTax }}">
        <input type="hidden" name="totalPersTax" id="totalPersTax" value="{{ $data->totalPersTax }}">
        <input type="hidden" name="flutterwave_key" value="{{ \App\Models\PaymentSetting::find(1)->ravePublicKey }}">
{{--        <input type="hidden" name="email" value="{{ auth()->guard('appuser')->user()->email }}">--}}
{{--        <input type="hidden" name="phone" value="{{ auth()->guard('appuser')->user()->phone }}">--}}
{{--        <input type="hidden" name="name" value="{{ auth()->guard('appuser')->user()->name }}">--}}
        <input type="hidden" name="flutterwave_key" value="{{ \App\Models\PaymentSetting::find(1)->ravePublicKey }}">
        <input type="hidden" name="seatsIoIds" id="seatsIoIds" value="{{ $data->seatsIoIds }}">
        <input type="hidden" name="selectedSeatsIo" id="selectedSeatsIo" value="{{ $data->selectedSeatsIo }}">
            @csrf
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
            if($data->ticket){
               $ticketIdsArray = array_column($data->ticket,'id');
                $ticketIds =  implode(",",$ticketIdsArray);
            }else{
                $ticketIds =  $data->id;
            }
            @endphp
            <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticketIds }}">
            <input type="hidden" name="event_id" value="{{ $data->event->event_id }}">
        <input type="hidden" id="quantity" name="quantity" value="{{$data->totalTickets}}">

{{--    @dd($data)--}}
        <div class="mt-5 w-full">
            <form class="space-y-6" action="{{route('detail_view')}}" method="GET">
                <div>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your email address">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-[50%] justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">Next</button>
                </div>
            </form>

            <p class="mt-5 text-left text-sm text-gray-500">
                <a href="{{url('user/login-express')}}" class="font-semibold leading-6 text-pink">Already have an account? Sign In</a>
            </p>
        </div>
    </div>
    <div class="flex min-h-full flex-col px-6 py-12 h-120 relative msm:w-1/2" style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
    @include('frontend.checkout.ticketDetail')
    </div>
</div>

@endsection
