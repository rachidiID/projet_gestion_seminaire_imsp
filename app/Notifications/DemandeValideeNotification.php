<?php

namespace App\Notifications;

use App\Models\Demande; // Importez votre modèle Demande
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeValideeNotification extends Notification implements ShouldQueue // Implémente ShouldQueue pour l'envoyer en tâche de fond
{
    use Queueable;

    protected $demande;

    /**
     * Create a new notification instance.
     */
    public function __construct(Demande $demande)
    {
        $this->demande = $demande;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail']; // Envoyer uniquement par e-mail
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $datePresentation = $this->demande->date_presentation_validee->format('d/m/Y');
        $urlVersSite = url('/'); // Vous pouvez affiner cette URL si besoin

        return (new MailMessage)
                    ->subject('Votre demande de séminaire a été validée !')
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Bonne nouvelle ! Votre demande de séminaire concernant le thème "' . $this->demande->theme . '" a été validée.')
                    ->line('La présentation a été programmée pour le : **' . $datePresentation . '**.')
                    ->line('Le commentaire éventuel du secrétariat : ' . ($this->demande->commentaire_secretaire ?: 'Aucun commentaire.'))
                    ->action('Voir le site', $urlVersSite) // Bouton d'action dans l'e-mail
                    ->line('Merci d\'utiliser notre application !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Vous pouvez définir ici une représentation pour d'autres canaux (ex: base de données)
        ];
    }
}