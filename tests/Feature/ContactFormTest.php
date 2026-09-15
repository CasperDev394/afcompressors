<?php

namespace Tests\Feature;

use App\Mail\WebsiteFormSubmitted;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('mail.website_forms_recipient', 'office-afrus@afcompressors.com');
    }

    public function test_general_contact_form_sends_an_email(): void
    {
        Mail::fake();

        $response = $this->postJson('/contact/general', [
            'lastName' => 'Иванов',
            'firstName' => 'Иван',
            'email' => 'ivan@example.com',
            'phone' => '+7 999 123-45-67',
            'companyName' => 'Компрессоры ООО',
            'message' => 'Нужна консультация по оборудованию.',
            'consent' => true,
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('message', 'Спасибо! Ваше сообщение успешно отправлено.');

        Mail::assertSent(WebsiteFormSubmitted::class, function (WebsiteFormSubmitted $mail): bool {
            $html = $mail->render();

            return str_contains($html, 'Нужна консультация по оборудованию.')
                && str_contains($html, 'Компрессоры ООО')
                && $mail->hasTo('office-afrus@afcompressors.com')
                && $mail->hasReplyTo('ivan@example.com')
                && $mail->formType === 'general';
        });
    }

    public function test_quote_request_sends_all_quote_fields(): void
    {
        Mail::fake();

        $response = $this->postJson('/contact/quote-request', [
            'lastName' => 'Петров',
            'firstName' => 'Пётр',
            'email' => 'petr@example.com',
            'phone' => '+7 999 765-43-21',
            'companyName' => 'Промышленность ООО',
            'country' => 'Россия',
            'productType' => 'Высокое давление',
            'message' => 'Просьба подготовить предложение.',
            'consent' => true,
        ]);

        $response->assertOk();

        Mail::assertSent(WebsiteFormSubmitted::class, function (WebsiteFormSubmitted $mail): bool {
            return $mail->hasTo('office-afrus@afcompressors.com')
                && $mail->formType === 'quote'
                && $mail->submission['country'] === 'Россия'
                && $mail->submission['productType'] === 'Высокое давление';
        });
    }

    public function test_contact_form_validates_required_fields_and_consent(): void
    {
        Mail::fake();

        $this->postJson('/contact/general', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'lastName',
                'firstName',
                'email',
                'phone',
                'companyName',
                'message',
                'consent',
            ]);

        Mail::assertNothingSent();
    }

    public function test_newsletter_form_sends_subscription_email(): void
    {
        Mail::fake();

        $response = $this->postJson('/newsletter/subscribe', [
            'email' => 'subscriber@example.com',
            'consent' => true,
        ]);

        $response->assertOk();

        Mail::assertSent(WebsiteFormSubmitted::class, function (WebsiteFormSubmitted $mail): bool {
            $html = $mail->render();

            return str_contains($html, 'Новая подписка на рассылку')
                && str_contains($html, 'subscriber@example.com')
                && $mail->hasTo('office-afrus@afcompressors.com')
                && $mail->hasReplyTo('subscriber@example.com')
                && $mail->formType === 'newsletter';
        });
    }

    public function test_newsletter_form_requires_email_and_consent(): void
    {
        Mail::fake();

        $this->postJson('/newsletter/subscribe', [
            'email' => 'not-an-email',
            'consent' => false,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email', 'consent']);

        Mail::assertNothingSent();
    }
}
