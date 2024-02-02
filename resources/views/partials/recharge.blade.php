<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
@if (count($recharges) > 0)
    <table>
        <thead>
            <tr class="text-left text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
                <th class="w-1/3 p-2">{{ __('message.amount') }}</th>
                <th class="w-1/3 p-2">{{ __('message.hPayment') }}</th>
                <th class="w-1/3 p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recharges as $recharge)
                <tr class="text-black text-start dark:text-white border-b border-gray-700">
                    <td class="text-xs dark:text-white p-2">{{ $recharge->amount . ' USD' }}</td>
                    <td class="text-xs dark:text-white p-2">{{ $recharge->payment_method }}</td>
                    <td class="text-xs dark:text-white p-2">{{ $recharge->formatted_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <span class="dark:text-white">{{ __('message.empty') }}</span>
@endif
