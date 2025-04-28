<?php

class FuzzyScoreConvert
{
    public function convertToFuzzyValue(float $score): float
    {
        return match (true) {
            $score >= 80 => 1,
            $score >= 60 => 0.75,
            $score >= 40 => 0.5,
            $score >= 20 => 0.25,
            default => 0,
        };
    }
}