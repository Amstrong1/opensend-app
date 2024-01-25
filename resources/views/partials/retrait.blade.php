<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
@if (count($cashouts) > 0)
    <table>
        <thead>
            <tr>
                <th class="text-center w-1/2 dark:text-white">Montant</th>
                <th class="text-center w-1/2 dark:text-white">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cashouts as $cashout)
                <tr>
                    <td class="dark:text-white">{{ $cashout->amount . ' ' . $cashout->currency }}</td>
                    <td class="dark:text-white">{{ $cashout->formatted_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <span class="dark:text-white">Aucune données à afficher</span>
@endif
