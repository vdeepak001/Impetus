<?php

namespace App\Enums;

enum CourseTestType: string
{
    case Mock = 'mock';
    case Pre = 'pre';
    case Final = 'final';
    case Practice = 'practice';

    /**
     * @return list<self>
     */
    public static function sequenced(): array
    {
        return [self::Pre, self::Mock, self::Final];
    }

    public function prerequisite(): ?self
    {
        return match ($this) {
            self::Pre => null,
            self::Mock => self::Pre,
            self::Final => self::Mock,
            self::Practice => null,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Mock => 'Mock test',
            self::Pre => 'Pre test',
            self::Final => 'Final test',
            self::Practice => 'Practice test',
        };
    }

    /** Title-style label for result screens and breadcrumbs (e.g. Pre-Test). */
    public function resultBannerLabel(): string
    {
        return match ($this) {
            self::Mock => 'Mock Test',
            self::Pre => 'Pre-Test',
            self::Final => 'Final Test',
            self::Practice => 'Practice Test',
        };
    }
}
