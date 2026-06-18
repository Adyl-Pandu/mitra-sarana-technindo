<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('id');
        $products = Product::all();

        $categoryConfig = [
            1 => ['bg' => [41, 65, 92], 'icon' => 'engine', 'label' => 'Komponen Mesin'],
            2 => ['bg' => [2, 99, 173], 'icon' => 'nav', 'label' => 'Peralatan Navigasi'],
            3 => ['bg' => [220, 38, 38], 'icon' => 'safety', 'label' => 'Keselamatan'],
            4 => ['bg' => [147, 51, 234], 'icon' => 'deck', 'label' => 'Perlengkapan Dek'],
            5 => ['bg' => [234, 179, 8], 'icon' => 'electrical', 'label' => 'Sistem Kelistrikan'],
            6 => ['bg' => [8, 145, 178], 'icon' => 'pump', 'label' => 'Pompa & Valve'],
        ];

        $this->command->info('Generating category images...');

        foreach ($categories as $category) {
            $cfg = $categoryConfig[$category->id] ?? $categoryConfig[1];
            $filename = 'category_' . $category->id . '_' . Str::slug($category->name) . '.jpg';
            $path = storage_path('app/public/categories/' . $filename);

            $this->generateCategoryImage($path, $category->name, $cfg['bg'], $cfg['icon']);

            $category->update(['image' => 'categories/' . $filename]);

            $this->command->info('  Created: ' . $filename);
        }

        $this->command->info('Generating product images...');

        foreach ($products as $product) {
            $catId = $product->category_id;
            $cfg = $categoryConfig[$catId] ?? $categoryConfig[1];
            $catName = isset($categories[$catId]) ? $categories[$catId]->name : '';

            $filename = 'product_' . $product->id . '_' . Str::slug($product->name) . '.jpg';
            $path = storage_path('app/public/products/' . $filename);

            $this->generateProductImage($path, $product->name, $catName, $cfg['bg'], $cfg['icon']);

            $product->update(['image' => 'products/' . $filename]);

            $this->command->info('  Created: ' . $filename);
        }

        $this->command->info('All images generated successfully!');
    }

    private function generateCategoryImage(string $path, string $name, array $bgColor, string $icon): void
    {
        $width = 800;
        $height = 800;

        $img = imagecreatetruecolor($width, $height);

        for ($i = 0; $i < $height; $i += 4) {
            $ratio = $i / $height;
            $r = (int)($bgColor[0] * (1 - $ratio) + min(255, $bgColor[0] + 40) * $ratio);
            $g = (int)($bgColor[1] * (1 - $ratio) + min(255, $bgColor[1] + 40) * $ratio);
            $b = (int)($bgColor[2] * (1 - $ratio) + min(255, $bgColor[2] + 40) * $ratio);
            $lineColor = imagecolorallocate($img, $r, $g, $b);
            imageline($img, 0, $i, $width, $i, $lineColor);
        }

        $white = imagecolorallocate($img, 255, 255, 255);
        $lightGray = imagecolorallocatealpha($img, 255, 255, 255, 40);

        $cx = $width / 2;
        $cy = $height / 2 - 30;

        switch ($icon) {
            case 'engine': $this->drawEngineIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'nav': $this->drawNavigationIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'safety': $this->drawSafetyIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'deck': $this->drawDeckIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'electrical': $this->drawElectricalIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'pump': $this->drawPumpIcon($img, $cx, $cy, $white, $lightGray); break;
        }

        $this->drawTextOverlay($img, $width, $height, $name, '', $white);

        $borderColor = imagecolorallocatealpha($img, 255, 255, 255, 20);
        imagerectangle($img, 0, 0, $width - 1, $height - 1, $borderColor);

        imagejpeg($img, $path, 90);
        imagedestroy($img);
    }

    private function generateProductImage(string $path, string $name, string $catName, array $bgColor, string $icon): void
    {
        $width = 800;
        $height = 800;

        $img = imagecreatetruecolor($width, $height);

        for ($i = 0; $i < $height; $i += 4) {
            $ratio = $i / $height;
            $r = (int)($bgColor[0] * (1 - $ratio) + min(255, $bgColor[0] + 30) * $ratio);
            $g = (int)($bgColor[1] * (1 - $ratio) + min(255, $bgColor[1] + 30) * $ratio);
            $b = (int)($bgColor[2] * (1 - $ratio) + min(255, $bgColor[2] + 30) * $ratio);
            $lineColor = imagecolorallocate($img, $r, $g, $b);
            imageline($img, 0, $i, $width, $i, $lineColor);
        }

        $white = imagecolorallocate($img, 255, 255, 255);
        $lightGray = imagecolorallocatealpha($img, 255, 255, 255, 60);

        $cx = $width / 2;
        $cy = $height / 2 - 30;

        switch ($icon) {
            case 'engine': $this->drawEngineIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'nav': $this->drawNavigationIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'safety': $this->drawSafetyIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'deck': $this->drawDeckIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'electrical': $this->drawElectricalIcon($img, $cx, $cy, $white, $lightGray); break;
            case 'pump': $this->drawPumpIcon($img, $cx, $cy, $white, $lightGray); break;
        }

        $this->drawTextOverlay($img, $width, $height, $name, $catName, $white);

        $borderColor = imagecolorallocatealpha($img, 255, 255, 255, 30);
        imagerectangle($img, 0, 0, $width - 1, $height - 1, $borderColor);

        $watermarkColor = imagecolorallocatealpha($img, 255, 255, 255, 12);
        $fontFile = 'C:/Windows/Fonts/arial.ttf';
        if (file_exists($fontFile)) {
            imagettftext($img, 50, -15, 50, $height - 50, $watermarkColor, $fontFile, 'MST');
        }

        imagejpeg($img, $path, 85);
        imagedestroy($img);
    }

    private function drawTextOverlay($img, $width, $height, string $name, string $subtitle, $white): void
    {
        $fontFile = null;
        $fontPaths = [
            'C:/Windows/Fonts/arial.ttf',
            'C:/Windows/Fonts/arialbd.ttf',
            'C:/Windows/Fonts/segoeui.ttf',
            'C:/Windows/Fonts/segoeuib.ttf',
            'C:/Windows/Fonts/calibri.ttf',
            'C:/Windows/Fonts/calibrib.ttf',
            'C:/Windows/Fonts/verdana.ttf',
        ];

        foreach ($fontPaths as $fp) {
            if (file_exists($fp)) {
                $fontFile = $fp;
                break;
            }
        }

        if (!$fontFile) return;

        $grayOverlay = imagecolorallocatealpha($img, 0, 0, 0, 20);
        imagefilledrectangle($img, 0, $height - 180, $width, $height, $grayOverlay);

        $fontSize = 26;
        $maxWidth = $width - 80;

        $words = explode(' ', $name);
        $lines = [];
        $currentLine = '';

        foreach ($words as $word) {
            $testLine = $currentLine ? $currentLine . ' ' . $word : $word;
            $bbox = imagettfbbox($fontSize, 0, $fontFile, $testLine);
            $textWidth = $bbox[2] - $bbox[0];

            if ($textWidth > $maxWidth && $currentLine) {
                $lines[] = $currentLine;
                $currentLine = $word;
            } else {
                $currentLine = $testLine;
            }
        }
        if ($currentLine) {
            $lines[] = $currentLine;
        }

        $lineHeight = 34;
        $startY = $height - 110 - (count($lines) - 1) * $lineHeight / 2;

        $shadowColor = imagecolorallocatealpha($img, 0, 0, 0, 50);

        foreach ($lines as $i => $line) {
            $bbox = imagettfbbox($fontSize, 0, $fontFile, $line);
            $textWidth = $bbox[2] - $bbox[0];
            $textX = ($width - $textWidth) / 2;
            $textY = $startY + $i * $lineHeight;

            imagefilledrectangle($img,
                (int)$textX - 12, $textY - $fontSize + 3,
                (int)$textX + $textWidth + 12, $textY + 6,
                $shadowColor
            );
            imagettftext($img, $fontSize, 0, (int)$textX, $textY, $white, $fontFile, $line);
        }

        if ($subtitle) {
            $subSize = 15;
            $bbox = imagettfbbox($subSize, 0, $fontFile, $subtitle);
            $subWidth = $bbox[2] - $bbox[0];
            $subX = ($width - $subWidth) / 2;
            $subY = $startY + count($lines) * $lineHeight + 28;
            $subColor = imagecolorallocatealpha($img, 255, 255, 255, 80);
            imagettftext($img, $subSize, 0, (int)$subX, $subY, $subColor, $fontFile, $subtitle);
        }
    }

    private function drawEngineIcon($img, $cx, $cy, $white, $lightGray): void
    {
        $r = 80;
        imagearc($img, $cx, $cy, $r * 2, $r * 2, 0, 360, $white);
        imagearc($img, $cx, $cy, ($r - 20) * 2, ($r - 20) * 2, 0, 360, $lightGray);
        imagefilledellipse($img, $cx, $cy, 12, 12, $white);
        for ($a = 0; $a < 360; $a += 60) {
            $rad = deg2rad($a);
            $x1 = $cx + ($r - 10) * cos($rad);
            $y1 = $cy + ($r - 10) * sin($rad);
            $x2 = $cx + ($r + 30) * cos($rad);
            $y2 = $cy + ($r + 30) * sin($rad);
            imageline($img, (int)$x1, (int)$y1, (int)$x2, (int)$y2, $white);
        }
        imagefilledrectangle($img, $cx - 10, $cy - 40, $cx + 10, $cy + 40, $lightGray);
        imagefilledrectangle($img, $cx - 30, $cy - 10, $cx + 30, $cy + 10, $lightGray);
    }

    private function drawNavigationIcon($img, $cx, $cy, $white, $lightGray): void
    {
        $pts = [$cx, $cy - 100, $cx - 80, $cy + 60, $cx, $cy + 20, $cx + 80, $cy + 60];
        imagefilledpolygon($img, $pts, 4, $white);
        imagefilledellipse($img, $cx, $cy + 20, 16, 16, imagecolorallocate($img, 41, 65, 92));
        imageellipse($img, $cx, $cy + 20, 140, 140, $lightGray);
        imageellipse($img, $cx, $cy + 20, 100, 100, $lightGray);
    }

    private function drawSafetyIcon($img, $cx, $cy, $white, $lightGray): void
    {
        $pts = [$cx, $cy - 100, $cx + 90, $cy - 30, $cx + 70, $cy + 70, $cx - 70, $cy + 70, $cx - 90, $cy - 30];
        imagefilledpolygon($img, $pts, 5, $white);
        $s = 30;
        imagefilledrectangle($img, $cx - 8, $cy - $s - 8, $cx + 8, $cy + $s - 8, $white);
        imagefilledrectangle($img, $cx - $s - 8, $cy - 8, $cx + $s - 8, $cy + 8, $white);
    }

    private function drawDeckIcon($img, $cx, $cy, $white, $lightGray): void
    {
        imagefilledrectangle($img, $cx - 100, $cy - 12, $cx + 100, $cy + 12, $white);
        imagefilledellipse($img, $cx - 60, $cy, 24, 24, $lightGray);
        imagefilledellipse($img, $cx + 60, $cy, 24, 24, $lightGray);
        imageline($img, $cx - 100, $cy - 12, $cx - 120, $cy + 40, $white);
        imageline($img, $cx + 100, $cy - 12, $cx + 120, $cy + 40, $white);
        imageline($img, $cx - 120, $cy + 40, $cx + 120, $cy + 40, $white);
        imagesetthickness($img, 3);
        imageline($img, $cx - 100, $cy - 12, $cx + 100, $cy - 12, $lightGray);
    }

    private function drawElectricalIcon($img, $cx, $cy, $white, $lightGray): void
    {
        $bolt = [$cx + 12, $cy - 80, $cx - 12, $cy - 15, $cx + 8, $cy - 8, $cx - 12, $cy + 80, $cx + 12, $cy + 8, $cx - 8, $cy + 8];
        imagefilledpolygon($img, $bolt, 6, $white);
        imagearc($img, $cx, $cy, 160, 160, 0, 360, $lightGray);
        imagearc($img, $cx, $cy, 130, 130, 0, 360, $lightGray);
    }

    private function drawPumpIcon($img, $cx, $cy, $white, $lightGray): void
    {
        imagefilledellipse($img, $cx, $cy, 150, 150, $white);
        imagefilledellipse($img, $cx, $cy, 110, 110, $lightGray);
        imagefilledellipse($img, $cx, $cy, 25, 25, $white);
        $pipeY = $cy + 75;
        imagefilledrectangle($img, $cx - 12, $cy + 30, $cx + 12, $pipeY + 25, $white);
        imagefilledrectangle($img, $cx - 75, $pipeY + 10, $cx + 75, $pipeY + 40, $white);
        for ($a = 0; $a < 360; $a += 60) {
            $rad = deg2rad($a);
            $fx = $cx + 22 * cos($rad);
            $fy = ($pipeY + 25) + 22 * sin($rad);
            imagefilledellipse($img, (int)$fx, (int)$fy, 6, 6, $lightGray);
        }
    }
}
