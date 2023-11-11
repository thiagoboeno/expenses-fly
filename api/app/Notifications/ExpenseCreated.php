<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpenseCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $expense;
    protected $user;

    public function __construct($expense)
    {
        $this->expense       = $expense;
        $this->user          = $expense->user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $clientUrl = env('CLIENT_URL');
        $expenseId = $this->expense->id;

        $url = "$clientUrl/expenses/$expenseId";

        return (new MailMessage)
            ->subject('Expense created')
            ->greeting('Hello! '.$this->user->first_name)
            ->line('Your expense has been successfully created!')
            ->line('Details')
            ->line('Description: '.$this->expense->description)
            ->line('Value: '.$this->expense->value)
            ->line('Date: '.$this->expense->date)
            ->action('View Expense', $url)
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
