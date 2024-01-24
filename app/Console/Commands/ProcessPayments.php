<?php

namespace App\Console\Commands;

use Stripe\Stripe;
use Stripe\Transfer;
use Illuminate\Console\Command;
use App\Models\PaymentTransaction;

class ProcessPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process payments and transfer money using Stripe API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Initialisez votre clé secrète Stripe
        Stripe::setApiKey(config('stripe.sk'));

        // Récupérez les transactions en attente de traitement
        $transactions = PaymentTransaction::where('status', 'pending')->get();

        foreach ($transactions as $transaction) {
            try {
                // Effectuez le transfert d'argent avec l'API de Stripe
                $transfer = Transfer::create([
                    'amount' => $transaction->amount,
                    'currency' => $transaction->currency,
                    'destination' => $transaction->recipient_stripe_account_id,
                    'transfer_group' => $transaction->transfer_group,
                ]);

                // Mettez à jour le statut de la transaction dans la base de données
                $transaction->update(['status' => 'completed', 'stripe_transfer_id' => $transfer->id]);

                $this->info("Payment processed successfully for transaction ID: {$transaction->id}");
            } catch (\Exception $e) {
                // Gérez les erreurs de paiement ici
                $this->error("Payment processing failed for transaction ID: {$transaction->id}. Error: {$e->getMessage()}");
            }
        }
    }
}
