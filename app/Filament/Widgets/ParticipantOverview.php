<?php

namespace App\Filament\Widgets;

use App\Models\Formation;
use App\Models\Participant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ParticipantOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Peserta', Participant::query()->count())
            ->description('Jumlah Total Peserta')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Jumlah Peserta Bulan Ini', Participant::query()->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count())
            ->description(now()->locale('id')->monthName . " " . now()->year)
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger'),
        
        Stat::make('Jumlah Formasi', Formation::query()->where('status','active')->count())
            ->description('Jumlah Formasi Active')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('warning'),
        ];
    }
}
