@extends('frontend.master', ['activePage' => 'frontend.checkout.expressCheckout'])
@section('title', __('Checkout'))
@section('content')
    <div class="flex flex-col justify-center container gap -10 m-auto w-[80%] mt-10 mb-10 msm:flex-row msm:mt-20 msm:w-[70%]">
        <div class="flex min-h-full flex-col px-6 py-12 h-112  msm:w-1/2" style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
            <div class="w-full">
                <h2 class="text-left text-2xl font-bold leading-9 tracking-tight text-gray-900">Express Checkout</h2>
            </div>

            <div class="mt-5 w-full">
                <form class="space-y-6" action="{{route('user.login.express')}}" method="POST">
                    @csrf
                    <div>
                        <input type="hidden" name="type" value="user">
                        <div class="mt-2">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your email address">
                        </div>
                    </div>
                    <div>
                        <div class="mt-2">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your Password">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="flex w-[50%] justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">Login</button>
                    </div>
                </form>
                @if(session('error_msg'))
                    <div class="mt-4 text-red-500">
                        {{ session('error_msg') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="flex min-h-full flex-col px-6 py-12 h-120 relative msm:w-1/2" style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
            @include('frontend.checkout.ticketDetail')
        </div>
    </div>

@endsection
