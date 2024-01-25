<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
@if (count($payment_transactions) > 0)
    <table>
        <thead>
            <tr>
                <th>Montant</th>
                <th>Destinataire</th>
                <th>Motif</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payment_transactions as $payment_transaction)
                <tr>
                    <td>{{ $payment_transaction->amount . ' USD' }}</td>
                    <td>{{ $payment_transaction->uuid_user }}</td>
                    <td>{{ $payment_transaction->motif }}</td>
                    <td>{{ $payment_transaction->formatted_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <span class="dark:text-white">Aucune données à afficher</span>
@endif
