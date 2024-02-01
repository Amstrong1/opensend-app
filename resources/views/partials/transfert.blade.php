<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
@if (count($cashouts) > 0)
    <table>
        <thead>
            <tr class="text-left text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
                <th class="w-1/3 p-2">Montant</th>
                <th class="w-1/3 p-2">Destinataire</th>
                <th class="w-1/3 p-2">Motif</th>
                <th class="w-1/3 p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cashouts as $cashout)
                <tr class="text-black text-start dark:text-white border-b border-gray-700">
                    <td class="text-xs dark:text-white p-2">{{ $cashout->amount . ' USD' }}</td>
                    <td class="text-xs dark:text-white p-2">{{ $cashout->uuid_user }}</td>
                    <td class="text-xs dark:text-white p-2">{{ $cashout->motif }}</td>
                    <td class="text-xs dark:text-white p-2">{{ $cashout->formatted_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <span class="dark:text-white">Aucune données à afficher</span>
@endif
