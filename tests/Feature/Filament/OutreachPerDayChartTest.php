<?php

use App\Filament\Widgets\OutreachPerDayChart;
use App\Models\OutreachAttempt;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Livewire;

beforeEach(function () {
    Carbon::setTestNow('2026-07-21 12:00:00');

    $this->actingAs(User::factory()->create([
        'email' => 'florismeccanici@tutanota.com',
    ]));
});

it('renders the outreach chart widget', function () {
    OutreachAttempt::factory()->create(['sent_at' => '2026-07-21 09:00:00']);

    Livewire::test(OutreachPerDayChart::class)
        ->assertOk()
        ->assertSee('Outreach per dag');
});
