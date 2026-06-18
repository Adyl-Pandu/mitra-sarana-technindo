<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DownloadImages extends Seeder
{
    public function run(): void
    {
        $urls = [
            'categories' => [
                1 => 'https://images.pexels.com/photos/7568415/pexels-photo-7568415.jpeg?auto=compress&cs=tinysrgb&w=800',
                2 => 'https://images.pexels.com/photos/2071279/pexels-photo-2071279.jpeg?auto=compress&cs=tinysrgb&w=800',
                3 => 'https://images.pexels.com/photos/30108580/pexels-photo-30108580.jpeg?auto=compress&cs=tinysrgb&w=800',
                4 => 'https://images.pexels.com/photos/3277769/pexels-photo-3277769.jpeg?auto=compress&cs=tinysrgb&w=800',
                5 => 'https://images.pexels.com/photos/236915/pexels-photo-236915.jpeg?auto=compress&cs=tinysrgb&w=800',
                6 => 'https://images.pexels.com/photos/175411/pexels-photo-175411.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            'products' => [
                1 => 'https://images.pexels.com/photos/7568415/pexels-photo-7568415.jpeg?auto=compress&cs=tinysrgb&w=800',
                2 => 'https://images.pexels.com/photos/8472578/pexels-photo-8472578.jpeg?auto=compress&cs=tinysrgb&w=800',
                3 => 'https://images.pexels.com/photos/257775/pexels-photo-257775.jpeg?auto=compress&cs=tinysrgb&w=800',
                4 => 'https://images.pexels.com/photos/7722922/pexels-photo-7722922.jpeg?auto=compress&cs=tinysrgb&w=800',
                5 => 'https://images.pexels.com/photos/7694896/pexels-photo-7694896.jpeg?auto=compress&cs=tinysrgb&w=800',
                6 => 'https://images.pexels.com/photos/6066557/pexels-photo-6066557.jpeg?auto=compress&cs=tinysrgb&w=800',
                7 => 'https://images.pexels.com/photos/457451/pexels-photo-457451.jpeg?auto=compress&cs=tinysrgb&w=800',
                8 => 'https://images.pexels.com/photos/1272585/pexels-photo-1272585.jpeg?auto=compress&cs=tinysrgb&w=800',
                9 => 'https://images.pexels.com/photos/3398470/pexels-photo-3398470.jpeg?auto=compress&cs=tinysrgb&w=800',
                10 => 'https://images.pexels.com/photos/1678507/pexels-photo-1678507.jpeg?auto=compress&cs=tinysrgb&w=800',
                11 => 'https://images.pexels.com/photos/1399160/pexels-photo-1399160.jpeg?auto=compress&cs=tinysrgb&w=800',
                12 => 'https://images.pexels.com/photos/2067396/pexels-photo-2067396.jpeg?auto=compress&cs=tinysrgb&w=800',
                13 => 'https://images.pexels.com/photos/2255565/pexels-photo-2255565.jpeg?auto=compress&cs=tinysrgb&w=800',
                14 => 'https://images.pexels.com/photos/4160230/pexels-photo-4160230.jpeg?auto=compress&cs=tinysrgb&w=800',
                15 => 'https://images.pexels.com/photos/5273200/pexels-photo-5273200.jpeg?auto=compress&cs=tinysrgb&w=800',
                16 => 'https://images.pexels.com/photos/30108580/pexels-photo-30108580.jpeg?auto=compress&cs=tinysrgb&w=800',
                17 => 'https://images.pexels.com/photos/14845201/pexels-photo-14845201.jpeg?auto=compress&cs=tinysrgb&w=800',
                18 => 'https://images.pexels.com/photos/1600250/pexels-photo-1600250.jpeg?auto=compress&cs=tinysrgb&w=800',
                19 => 'https://images.pexels.com/photos/6050551/pexels-photo-6050551.jpeg?auto=compress&cs=tinysrgb&w=800',
                20 => 'https://images.pexels.com/photos/5321370/pexels-photo-5321370.jpeg?auto=compress&cs=tinysrgb&w=800',
                21 => 'https://images.pexels.com/photos/163742/pexels-photo-163742.jpeg?auto=compress&cs=tinysrgb&w=800',
                22 => 'https://images.pexels.com/photos/3277769/pexels-photo-3277769.jpeg?auto=compress&cs=tinysrgb&w=800',
                23 => 'https://images.pexels.com/photos/3398470/pexels-photo-3398470.jpeg?auto=compress&cs=tinysrgb&w=800',
                24 => 'https://images.pexels.com/photos/1272585/pexels-photo-1272585.jpeg?auto=compress&cs=tinysrgb&w=800',
                25 => 'https://images.pexels.com/photos/457451/pexels-photo-457451.jpeg?auto=compress&cs=tinysrgb&w=800',
                26 => 'https://images.pexels.com/photos/7694896/pexels-photo-7694896.jpeg?auto=compress&cs=tinysrgb&w=800',
                27 => 'https://images.pexels.com/photos/236915/pexels-photo-236915.jpeg?auto=compress&cs=tinysrgb&w=800',
                28 => 'https://images.pexels.com/photos/8472578/pexels-photo-8472578.jpeg?auto=compress&cs=tinysrgb&w=800',
                29 => 'https://images.pexels.com/photos/7722922/pexels-photo-7722922.jpeg?auto=compress&cs=tinysrgb&w=800',
                30 => 'https://images.pexels.com/photos/6066557/pexels-photo-6066557.jpeg?auto=compress&cs=tinysrgb&w=800',
                31 => 'https://images.pexels.com/photos/257775/pexels-photo-257775.jpeg?auto=compress&cs=tinysrgb&w=800',
                32 => 'https://images.pexels.com/photos/2067396/pexels-photo-2067396.jpeg?auto=compress&cs=tinysrgb&w=800',
                33 => 'https://images.pexels.com/photos/175411/pexels-photo-175411.jpeg?auto=compress&cs=tinysrgb&w=800',
                34 => 'https://images.pexels.com/photos/1678507/pexels-photo-1678507.jpeg?auto=compress&cs=tinysrgb&w=800',
                35 => 'https://images.pexels.com/photos/1399160/pexels-photo-1399160.jpeg?auto=compress&cs=tinysrgb&w=800',
                36 => 'https://images.pexels.com/photos/2255565/pexels-photo-2255565.jpeg?auto=compress&cs=tinysrgb&w=800',
                37 => 'https://images.pexels.com/photos/4160230/pexels-photo-4160230.jpeg?auto=compress&cs=tinysrgb&w=800',
                38 => 'https://images.pexels.com/photos/5321370/pexels-photo-5321370.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
        ];

        $dirs = [
            'categories' => storage_path('app/public/categories'),
            'products' => storage_path('app/public/products'),
        ];

        $ctx = stream_context_create([
            'http' => [
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'header' => "Referer: https://www.pexels.com/\r\n",
                'timeout' => 30,
            ],
        ]);

        $pdo = new \PDO('mysql:host=127.0.0.1;port=3306;dbname=mitra_sarana_technindo', 'root', '');

        foreach (['categories', 'products'] as $type) {
            $this->command->info("Downloading {$type} images...");
            $table = $type;
            $prefix = $type === 'categories' ? 'cat' : 'prod';
            $idCol = $type === 'categories' ? 'id' : 'id';

            foreach ($urls[$type] as $id => $url) {
                $filename = "{$prefix}_{$id}.jpg";
                $path = $dirs[$type] . '/' . $filename;

                $data = @file_get_contents($url, false, $ctx);
                if ($data) {
                    file_put_contents($path, $data);
                    $pdo->prepare("UPDATE {$table} SET image = ? WHERE id = ?")->execute(["{$table}/{$filename}", $id]);
                    $this->command->info("  ID {$id}: OK (" . round(strlen($data) / 1024) . " KB)");
                } else {
                    $this->command->warn("  ID {$id}: FAILED, trying fallback...");
                    $fallback = 'https://images.pexels.com/photos/161372/pexels-photo-161372.jpeg?auto=compress&cs=tinysrgb&w=800';
                    $data2 = @file_get_contents($fallback, false, $ctx);
                    if ($data2) {
                        file_put_contents($path, $data2);
                        $pdo->prepare("UPDATE {$table} SET image = ? WHERE id = ?")->execute(["{$table}/{$filename}", $id]);
                        $this->command->info("  ID {$id}: OK with fallback (" . round(strlen($data2) / 1024) . " KB)");
                    } else {
                        $this->command->error("  ID {$id}: All sources FAILED");
                    }
                }
            }
        }

        $this->command->info('All images processed!');
    }
}
