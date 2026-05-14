<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mitrast.com',
            'password' => Hash::make('admin123'),
        ]);

        $categories = [
            ['name' => 'Komponen Mesin Kapal', 'slug' => 'komponen-mesin-kapal', 'description' => 'Berbagai komponen dan suku cadang mesin kapal berkualitas tinggi.', 'meta_title' => 'Jual Komponen Mesin Kapal - PT Mitra Sarana Technindo', 'meta_description' => 'Supplier komponen dan suku cadang mesin kapal terlengkap.', 'sort_order' => 1],
            ['name' => 'Peralatan Navigasi', 'slug' => 'peralatan-navigasi', 'description' => 'Peralatan navigasi kapal untuk keselamatan dan efisiensi pelayaran.', 'meta_title' => 'Jual Peralatan Navigasi Kapal - PT Mitra Sarana Technindo', 'meta_description' => 'Distributor peralatan navigasi kapal terlengkap.', 'sort_order' => 2],
            ['name' => 'Peralatan Keselamatan', 'slug' => 'peralatan-keselamatan', 'description' => 'Peralatan keselamatan kapal sesuai standar IMO.', 'meta_title' => 'Jual Peralatan Keselamatan Kapal - PT Mitra Sarana Technindo', 'meta_description' => 'Supplier peralatan keselamatan kapal standar SOLAS.', 'sort_order' => 3],
            ['name' => 'Perlengkapan Dek Kapal', 'slug' => 'perlengkapan-dek-kapal', 'description' => 'Perlengkapan dek kapal untuk operasional pelayaran.', 'meta_title' => 'Jual Perlengkapan Dek Kapal - PT Mitra Sarana Technindo', 'meta_description' => 'Jual perlengkapan dek kapal berkualitas.', 'sort_order' => 4],
            ['name' => 'Sistem Kelistrikan Kapal', 'slug' => 'sistem-kelistrikan-kapal', 'description' => 'Komponen sistem kelistrikan dan elektronik kapal.', 'meta_title' => 'Jual Sistem Kelistrikan Kapal - PT Mitra Sarana Technindo', 'meta_description' => 'Supplier komponen kelistrikan kapal.', 'sort_order' => 5],
            ['name' => 'Pompa & Valve', 'slug' => 'pompa-dan-valve', 'description' => 'Berbagai jenis pompa dan valve untuk sistem perpipaan kapal.', 'meta_title' => 'Jual Pompa dan Valve Kapal - PT Mitra Sarana Technindo', 'meta_description' => 'Distributor pompa dan valve marine.', 'sort_order' => 6],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $products = [
            ['category_id' => 1, 'name' => 'Piston Ring Set Marine Diesel', 'slug' => 'piston-ring-set-marine-diesel', 'sku' => 'MST-MK001', 'description' => 'Piston ring set untuk mesin diesel kapal. Material cast iron berkualitas tinggi dengan ketahanan aus yang sangat baik.', 'specifications' => "Material: Cast Iron\nDiameter: 150mm - 500mm\nStandar: JIS/DIN", 'price' => 2500000, 'stock' => 25, 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Cylinder Liner Marine Engine', 'slug' => 'cylinder-liner-marine-engine', 'sku' => 'MST-MK002', 'description' => 'Cylinder liner untuk mesin kapal dengan presisi tinggi. Material besi cor sentrifugal.', 'specifications' => "Material: Centrifugal Cast Iron\nTipe: Wet/Dry Liner\nStandar: ISO/JIS", 'price' => 4750000, 'stock' => 15, 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Turbocharger Assembly', 'slug' => 'turbocharger-assembly', 'sku' => 'MST-MK003', 'description' => 'Turbocharger assembly lengkap untuk mesin diesel kapal. Performa optimal untuk kondisi operasional berat.', 'specifications' => "Tipe: Radial Flow\nMaterial: Inconel Alloy\nBearing: Journal Bearing", 'price' => 18500000, 'stock' => 8, 'is_featured' => true],
            ['category_id' => 1, 'name' => 'Fuel Injection Pump', 'slug' => 'fuel-injection-pump', 'sku' => 'MST-MK004', 'description' => 'Pompa injeksi bahan bakar untuk mesin diesel marine. Presisi tinggi.', 'specifications' => "Tipe: Inline Pump\nTekanan: 300-1200 bar\nSertifikasi: Class Approved", 'price' => 8900000, 'stock' => 12],
            ['category_id' => 1, 'name' => 'Crankshaft Bearing Set', 'slug' => 'crankshaft-bearing-set', 'sku' => 'MST-MK005', 'description' => 'Set bearing crankshaft untuk mesin diesel kapal. Material bimetal berkualitas.', 'specifications' => "Material: Bimetal\nTipe: Main & Con Rod Bearing", 'price' => 3200000, 'stock' => 20],
            ['category_id' => 2, 'name' => 'Kompas Magnetik Marine', 'slug' => 'kompas-magnetik-marine', 'sku' => 'MST-NV001', 'description' => 'Kompas magnetik marine standar SOLAS untuk navigasi kapal.', 'specifications' => "Tipe: Wet Card\nDiameter: 165mm\nStandar: SOLAS/IMO", 'price' => 5600000, 'stock' => 10, 'is_featured' => true],
            ['category_id' => 2, 'name' => 'GPS Navigator Marine', 'slug' => 'gps-navigator-marine', 'sku' => 'MST-NV002', 'description' => 'GPS Navigator marine dengan layar warna 7 inci dan chartplotter.', 'specifications' => "Layar: 7 inch TFT\nAkurasi: 3m\nWaterproof: IPX7", 'price' => 12500000, 'stock' => 6],
            ['category_id' => 2, 'name' => 'Marine VHF Radio', 'slug' => 'marine-vhf-radio', 'sku' => 'MST-NV003', 'description' => 'Radio VHF marine dengan DSC. Memenuhi standar GMDSS.', 'specifications' => "Frekuensi: 156-163 MHz\nDaya: 1W/25W\nStandar: GMDSS", 'price' => 7800000, 'stock' => 9],
            ['category_id' => 3, 'name' => 'Life Jacket SOLAS Approved', 'slug' => 'life-jacket-solas-approved', 'sku' => 'MST-KS001', 'description' => 'Life jacket standar SOLAS dengan lampu otomatis dan peluit.', 'specifications' => "Daya Apung: 150N\nMaterial: Nylon/PVC\nSertifikasi: SOLAS/MED", 'price' => 450000, 'stock' => 100, 'is_featured' => true],
            ['category_id' => 3, 'name' => 'Life Raft 25 Person', 'slug' => 'life-raft-25-person', 'sku' => 'MST-KS002', 'description' => 'Life raft inflatable kapasitas 25 orang dengan SOLAS A Pack.', 'specifications' => "Kapasitas: 25 orang\nPack: SOLAS A Pack\nServicing: Annual", 'price' => 65000000, 'stock' => 4],
            ['category_id' => 3, 'name' => 'Fire Extinguisher CO2 5kg', 'slug' => 'fire-extinguisher-co2-5kg', 'sku' => 'MST-KS003', 'description' => 'Tabung pemadam CO2 5kg untuk kapal. Kelas B dan C.', 'specifications' => "Isi: 5kg CO2\nKelas: B, C\nTekanan: 56 bar", 'price' => 1800000, 'stock' => 30],
            ['category_id' => 3, 'name' => 'EPIRB 406MHz', 'slug' => 'epirb-406mhz', 'sku' => 'MST-KS004', 'description' => 'EPIRB 406MHz dengan GPS built-in untuk posisi darurat.', 'specifications' => "Frekuensi: 406/121.5 MHz\nGPS: Built-in\nBaterai: 48 jam", 'price' => 15000000, 'stock' => 7, 'is_featured' => true],
            ['category_id' => 4, 'name' => 'Tali Tambat Polypropylene 40mm', 'slug' => 'tali-tambat-polypropylene-40mm', 'sku' => 'MST-DK001', 'description' => 'Tali tambat kapal polypropylene 40mm tahan UV dan air laut.', 'specifications' => "Diameter: 40mm\nBreaking Strength: 12 ton\nPanjang: 200m/coil", 'price' => 3500000, 'stock' => 20],
            ['category_id' => 4, 'name' => 'Stockless Anchor 500kg', 'slug' => 'stockless-anchor-500kg', 'sku' => 'MST-DK002', 'description' => 'Jangkar stockless 500kg besi cor berkualitas. Class Approved.', 'specifications' => "Berat: 500kg\nTipe: Stockless Hall\nMaterial: Cast Steel", 'price' => 22000000, 'stock' => 3],
            ['category_id' => 4, 'name' => 'Bollard Cast Iron 10 Ton', 'slug' => 'bollard-cast-iron-10-ton', 'sku' => 'MST-DK003', 'description' => 'Bollard besi cor 10 ton, hot-dip galvanized anti korosi.', 'specifications' => "Kapasitas: 10 ton SWL\nFinishing: Hot-dip Galvanized", 'price' => 8500000, 'stock' => 10],
            ['category_id' => 5, 'name' => 'Marine Generator Set 50 kVA', 'slug' => 'marine-generator-set-50-kva', 'sku' => 'MST-EL001', 'description' => 'Generator set marine 50 kVA diesel powered, pendingin air laut.', 'specifications' => "Daya: 50 kVA\nVoltage: 380V/220V\nFrekuensi: 50Hz", 'price' => 125000000, 'stock' => 2, 'is_featured' => true],
            ['category_id' => 5, 'name' => 'Kabel Marine XLPE 35mm2', 'slug' => 'kabel-marine-xlpe-35mm2', 'sku' => 'MST-EL002', 'description' => 'Kabel marine XLPE 35mm2 tahan api dan minyak. Standar IEC 60092.', 'specifications' => "Penampang: 35mm2\nInsulasi: XLPE\nSheath: LSZH", 'price' => 85000, 'stock' => 500],
            ['category_id' => 5, 'name' => 'Navigation Light Set LED', 'slug' => 'navigation-light-set-led', 'sku' => 'MST-EL003', 'description' => 'Set lampu navigasi LED lengkap standar COLREG.', 'specifications' => "Tipe: LED\nVisibilitas: 2-3 NM\nStandar: COLREG 72", 'price' => 6500000, 'stock' => 12],
            ['category_id' => 6, 'name' => 'Centrifugal Pump Marine 100m3/h', 'slug' => 'centrifugal-pump-marine-100m3h', 'sku' => 'MST-PV001', 'description' => 'Pompa sentrifugal marine 100m3/h untuk pendingin, ballast, dan bilge.', 'specifications' => "Kapasitas: 100 m3/h\nHead: 30m\nSeal: Mechanical Seal", 'price' => 35000000, 'stock' => 5],
            ['category_id' => 6, 'name' => 'Butterfly Valve Marine DN150', 'slug' => 'butterfly-valve-marine-dn150', 'sku' => 'MST-PV002', 'description' => 'Butterfly valve DN150 bronze untuk sistem perpipaan air laut.', 'specifications' => "Ukuran: DN150 (6 inch)\nMaterial: Bronze\nOperasi: Manual", 'price' => 4800000, 'stock' => 18],
            ['category_id' => 6, 'name' => 'Gear Pump Fuel Oil Transfer', 'slug' => 'gear-pump-fuel-oil-transfer', 'sku' => 'MST-PV003', 'description' => 'Gear pump untuk transfer bahan bakar kapal. Self-priming.', 'specifications' => "Kapasitas: 5 m3/h\nTekanan: 7 bar\nSeal: Mechanical", 'price' => 12000000, 'stock' => 8],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }

        echo "Seeding completed! Admin: admin@mitrast.com / admin123\n";
    }
}
