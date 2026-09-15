<?php

namespace App\Support;

class DonutChart
{
    /**
     * Build SVG path segments for a donut chart from category rows.
     *
     * Each category row expects: name, count, color.
     *
     * @return array<int, array{d: string, color: string, name: string, count: int}>
     */
    public static function segments(array $categories, float $cx = 70, float $cy = 70, float $outer = 70, float $inner = 45.5): array
    {
        $total = (int) collect($categories)->sum('count');

        if ($total === 0) {
            return [];
        }

        $segments = [];
        $startAngle = 0.0;

        foreach ($categories as $category) {
            $count = (int) ($category['count'] ?? 0);

            if ($count <= 0) {
                continue;
            }

            $sweep = ($count / $total) * 360;

            if ($sweep >= 360) {
                $sweep = 359.999;
            }

            $endAngle = $startAngle + $sweep;

            $segments[] = [
                'd' => self::segmentPath($cx, $cy, $outer, $inner, $startAngle, $endAngle),
                'color' => $category['color'] ?? '#94a3b8',
                'name' => $category['name'] ?? '',
                'count' => $count,
            ];

            $startAngle = $endAngle;
        }

        return $segments;
    }

    private static function segmentPath(float $cx, float $cy, float $outer, float $inner, float $startAngle, float $endAngle): string
    {
        $largeArc = ($endAngle - $startAngle) > 180 ? 1 : 0;

        $startOuter = self::polar($cx, $cy, $outer, $startAngle);
        $endOuter = self::polar($cx, $cy, $outer, $endAngle);
        $startInner = self::polar($cx, $cy, $inner, $endAngle);
        $endInner = self::polar($cx, $cy, $inner, $startAngle);

        return sprintf(
            'M %.4F %.4F A %.4F %.4F 0 %d 1 %.4F %.4F L %.4F %.4F A %.4F %.4F 0 %d 0 %.4F %.4F Z',
            $startOuter['x'],
            $startOuter['y'],
            $outer,
            $outer,
            $largeArc,
            $endOuter['x'],
            $endOuter['y'],
            $startInner['x'],
            $startInner['y'],
            $inner,
            $inner,
            $largeArc,
            $endInner['x'],
            $endInner['y']
        );
    }

    /** @return array{x: float, y: float} */
    private static function polar(float $cx, float $cy, float $radius, float $angleDegrees): array
    {
        $radians = deg2rad($angleDegrees - 90);

        return [
            'x' => $cx + ($radius * cos($radians)),
            'y' => $cy + ($radius * sin($radians)),
        ];
    }
}
