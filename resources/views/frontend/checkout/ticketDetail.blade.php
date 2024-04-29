<div class="flex flex-row justify-between">
    <div class="flex flex-col" style="width:70%">

        <h4 class="relative font-bold"><span id="eventTitle"> {{ $data->event->name }}</span> &#x1F31E;</h4>
        <p id="order_date">{{ date('D, jS M \a\t g:ia', strtotime($data->event->start_time)) }}</p>
        {{-- @if ($data->allday == 0)
            <div>
                <input type="date" name="ticket_date" id="onetime" data-date="{{ $data->event->end_time }}" placeholder="mm/dd/yy" class="mt-3 border p-2 border-gray-light">
                @if ($errors->has('ticket_date'))
                <div class="text-danger">{{ $errors->first('ticket_date') }}</div>
                @endif
                <div class="ticket_date text-danger"></div>
            </div>
        @endif --}}
    </div>
    <div style="width:30%">
        <img id="thumbnailImage" src="{{ asset('images/upload/' . $data->event->image) }}" alt="avatar" style="width:100%" />
    </div>
</div>
<div class="w-full h-0.5 bg-black mt-5"></div>
<div class="flex flex-col mt-5">
    <h2 class="font-bold text-2xl">Order Summary</h2>
    @if(isset($singleEvent))
        <div class="flex flex-row justify-between">
            <div class="ticket-name">
{{--                @dd($data)--}}
{{--                @foreach($data->ticket as $ticket)--}}
                    <p class="rest-ticket" style="font-size: 16px; line-height: 2.5"> {{$data->event->name}} * 1</p>
{{--                @endforeach--}}
            </div>
            <p id="total_price" class="price" style="font-size: 16px; line-height: 2.5">{{ $data->currency }}{{$data->price_total}}</p>
        </div>
    @else
        <div class="flex flex-row justify-between">
            <div class="ticket-name">
                @foreach($data->ticket as $ticket)
                    <p class="rest-ticket" style="font-size: 16px; line-height: 2.5"> {{$ticket->name}} * {{$ticket->selectedseatsCount}}</p>
                @endforeach
            </div>
            <p id="total_price" class="price" style="font-size: 16px; line-height: 2.5">{{ $data->currency }}{{$data->price_total}}</p>
        </div>
    @endif

</div>
{{-- @if (isset($data->type) && $data->type == 'paid') --}}

<div class="flex flex-col mt-5">
    <div class="space-y-5">
        <p class="font-semibold text-base leading-8 text-black ">
            {{ __('Taxes and Charges') }}</p>
        <div class="flex justify-between">
            <p class="font-normal text-lg leading-7 text-gray-200">
                {{ __('Total Tax amount') }}</p>
            <p class="font-medium text-lg leading-7 text-gray-300 totaltax">
                {{ $currency }} {{ $data->tax_total }}
            </p>
        </div>
        <div class="flex justify-between">
            <p class="font-normal text-lg leading-7 text-gray-200">
                {{ __('Tickets amount') }}</p>
            <p class="font-medium text-lg leading-7 text-gray-300">
                {{-- @if ($data->seatmap_id == null) --}}
                {{ $currency }} {{ $data->price_total }}
                {{-- @endif --}}
            </p>
        </div>

        <div class="flex justify-between">
            <p
                class="font-semibold text-xl leading-7 text-primary xlg:text-lg 1xl:text-xl">
                </p>
            <p
                class="font-semibold text-2xl leading-7 text-primary xlg:text-lg 1xl:text-2xl subtotal">
                {{ __('Total:') }}
                {{-- @if ($data->seatmap_id == null || $data->module->is_enable == 0) --}}
                    {{ $currency }} {{ $data->price_total + $data->tax_total }}
                {{-- @endif --}}
            </p>
        </div>
    </div>
</div>
{{-- @endif --}}
