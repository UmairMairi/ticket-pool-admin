@extends('frontend.master', ['activePage' => 'frontend.checkout.detail'])
@section('title', __('Detail'))
@section('content')
<div class="flex flex-col justify-center container gap -10 m-auto w-[80%] mt-10 mb-10 msm:flex-row msm:mt-20 msm:w-[70%]">
    <div class="flex min-h-full flex-col px-6 py-12 h-200  msm:w-1/2" style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
        <div class="w-full">
            <h2 class="text-left text-2xl font-bold leading-9 tracking-tight text-gray-900">Your Details</h2>
        </div>

        <div class="mt-5 w-full">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li style="color:red">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="space-y-3 flex flex-col" action="{{route('detail_post')}}" method="POST">
                @csrf
                <div class="flex flex-row justify-between gap-10">
                    <div class="mt-2 w-full">
                        <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">Firstname<span style="color:red">*</span></label>
                        <input id="firstname" name="firstname" type="text" autocomplete="firstname" required class="block w-full rounded-md border-0 px-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="First name">
                    </div>
                    <div class="mt-2 w-full">
                        <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Lastname<span style="color:red">*</span></label>
                        <input id="lastname" name="lastname" type="text" autocomplete="lastname" required class="block w-full rounded-md border-0 px-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Last name">
                    </div>
                </div>
                <div class="flex flex-row justify-between gap-10">
                    <div class="mt-2 w-full">
                        <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">Gender<span style="color:red">*</span></label>
                        <select id="gender" name="gender" class="border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-1.5 px-1.5 focus:outline-none" style="height:40px">
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>
                    <div class="mt-2 w-full">
                        <label for="birthday" class="block text-sm font-medium leading-6 text-gray-700">Birthday<span style="color:red">*</span></label>
                        <input type="date" id="birthday" name="birthday" placeholder="Select date" class="border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md shadow-sm w-full max-w-xs px-4 py-2 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                <div class="w-full">
                    <label for="postcode" class="block text-sm font-medium leading-6 text-gray-900">Postcode<span style="color:red">*</span></label>
                    <input id="" name="postcode" type="text" autocomplete="postcode" required class="block w-full rounded-md border-0 px-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your postcode"
{{--                           pattern="[A-Z0-9]{2}\s?\d{3}|[A-Z]{2}\s?\d{3}" title="Enter a valid postcode (e.g., 12 WH or HE 123)"--}}
                    >
                </div>
                <div class="w-full">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password<span style="color:red">*</span></label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 px-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one digit, one lowercase and one uppercase letter, and be at least 8 characters long">
                </div>
                <div class="w-full">
                    <label for="confirmation_password" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password<span style="color:red">*</span></label>
                    <input id="confirmation_password" name="confirmation_password" type="password" autocomplete="current-confirmation_password" required class="block w-full rounded-md border-0 px-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your confirmation password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one digit, one lowercase and one uppercase letter, and be at least 8 characters long">
                </div>
                <div class="flex items-center mb-4 mt-2" style="margin-top: 20px">
                    <input id="policy" name="tos[]" type="checkbox" value="privacy_policy" class="w-5 h-5 appearance-none border cursor-pointer border-gray-300  rounded-md mr-2 hover:border-indigo-500 hover:bg-indigo-100 checked:bg-no-repeat checked:bg-center checked:border-indigo-500 checked:bg-indigo-100" required>
                    <label for="policy" class="text-sm font-norma cursor-pointer text-gray-600">I agree to the Privacy Policy and Terms & Conditions.<span style="color:red">*</span></label>
                </div>
                <div class="flex items-center">
                    <input id="event" name="tos[]" type="checkbox" value="keep_informed" class="w-5 h-5 appearance-none cursor-pointer border border-gray-300  rounded-md mr-2 hover:border-indigo-500 hover:bg-indigo-100 checked:bg-no-repeat checked:bg-center checked:border-indigo-500 checked:bg-indigo-100">
                    <label for="event" class="text-sm font-normal cursor-pointer text-gray-600">I would like to be informed about related events by Ticketpool</label>
                </div>
{{--                <p class="text-sm font-normal cursor-pointer text-gray-600">We think you'll love. To opt out of this please check this box.</p>--}}
                <button type="submit" class="flex w-[50%] justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">Next</button>
            </form>
        </div>
    </div>
    <div class="flex min-h-full flex-col px-6 py-12 h-120 relative msm:w-1/2" style="box-shadow: 0px 8px 8px rgba(0, 0, 0, 0.1);">
        @include('frontend.checkout.ticketDetail')
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('confirmation_password');

        function validatePassword() {
            var password = passwordInput.value;
            var confirmPassword = confirmPasswordInput.value;

            if (password !== confirmPassword) {
                confirmPasswordInput.setCustomValidity("Passwords do not match");
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        }

        passwordInput.addEventListener("input", validatePassword);
        confirmPasswordInput.addEventListener("input", validatePassword);
    });
</script>
@endsection
