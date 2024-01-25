<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
@if (count($recharges) > 0)
    <table>
        <thead>
            <tr>
                <th class="text-center w-1/3 dark:text-white">Montant</th>
                <th class="text-center w-1/3 dark:text-white">Methode de paiement</th>
                <th class="text-center w-1/3 dark:text-white">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recharges as $recharge)
                <tr>
                    <td class="dark:text-white">{{ $recharge->amount . ' USD' }}</td>
                    <td class="dark:text-white">{{ $recharge->payment_method }}</td>
                    <td class="dark:text-white">{{ $recharge->formatted_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <span class="dark:text-white">Aucune données à afficher</span>
@endif
