<?php

namespace App\Notifications;

use App\Models\Seminaire; // Importez votre modèle Seminaire
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str; // Pour Str::limit sur le résumé

class NouveauSeminairePublieNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $seminaire;

    public function __construct(Seminaire $seminaire)
    {
        $this->seminaire = $seminaire;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $datePresentation = $this->seminaire->date_presentation->format('d/m/Y');
        $urlSeminaires = route('welcome'); // Ou une future route listant les séminaires publics

        $mailMessage = (new MailMessage)
                    ->subject('Nouveau Séminaire Programmé : ' . $this->seminaire->demande->theme)
                    ->greeting('Bonjour,')
                    ->line('Un nouveau séminaire a été programmé et publié pour votre information.')
                    ->line('**Thème :** ' . $this->seminaire->demande->theme)
                    ->line('**Présentateur :** ' . $this->seminaire->demande->user->name)
                    ->line('**Date de Présentation :** ' . $datePresentation);

        if ($this->seminaire->chemin_resume) {
            // Le PDF demande de publier le résumé. Ici on peut mettre un extrait ou mentionner sa disponibilité.
            // Pour un extrait, il faudrait lire le fichier, ce qui est plus complexe pour un email.
            // Alternative : un lien direct si le résumé est publiquement accessible,
            // ou simplement mentionner qu'il est disponible sur la plateforme.
            $mailMessage->line('Un résumé est disponible sur la plateforme.');
        }

        $mailMessage->action('Voir les séminaires', $urlSeminaires)
                    ->line('Nous vous encourageons à y assister.');

        return $mailMessage;
    }
}