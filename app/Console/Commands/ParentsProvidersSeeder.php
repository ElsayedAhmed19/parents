<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParentsProvidersSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'providers:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Parents\' providers with data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('ProviderX seeder started');
        $this->seedProviderX();
        $this->info('ProviderX seeder finsihed');

        $this->info('ProviderY seeder started');
        $this->seedProviderY();
        $this->info('ProviderY seeder finsihed');
    }

    private function seedProviderX()
    {
        $parents = [];

        for ($i=0; $i < 10000; $i++) {
            $parents [] = [
                'parentAmount' => rand(100, 10000),
                'Currency' => 'USD',
                'parentEmail' => "parent{$i}@parent.eu",
                'statusCode' => rand(1, 3),
                'registerationDate' => $this->generateRandDate(),
                'parentIdentification' => Str::uuid()->toString()
            ];
        }

        $this->writeToFile('providerX.json', $parents);
    }

    private function seedProviderY()
    {
        $parents = [];

        $expectedStatuses = [100, 200, 300];

        for ($i=10001; $i < 15001; $i++) {
            $parents [] = [
                'balance' => rand(100, 10000),
                'currency' => 'AED',
                'email' => "parent{$i}@parent.eu",
                'status' => $expectedStatuses[array_rand($expectedStatuses)],
                'created_at' => $this->generateRandDate(),
                'id' => Str::uuid()->toString()
            ];
        }

        $this->writeToFile('providerY.json', $parents);
    }

    private function writeToFile(string $fileName, $data)
    {
        Storage::disk('public')->put($fileName, '[]'); //reset the file

        Storage::disk('public')->put($fileName, json_encode($data));
    }

    private function generateRandDate()
    {
        return date('Y-m-d', rand(strtotime('2022-01-01'), strtotime(date('Y-m-d'))));
    }
}
