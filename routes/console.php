<?php

use App\Models\User;
use App\Services\ImportWebsiteContent;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create', function () {
    $name = $this->ask('Nama');
    $email = $this->ask('Email');
    $password = $this->secret('Password (minimal 12 karakter)');
    $validator = validator(compact('name', 'email', 'password'), [
        'name' => 'required|string|max:150', 'email' => 'required|email|max:255|unique:users,email', 'password' => 'required|string|min:12',
    ]);
    if ($validator->fails()) {
        $this->error($validator->errors()->first());

        return 1;
    }
    $user = new User(compact('name', 'email', 'password'));
    $user->is_admin = true;
    $user->save();
    $this->info('Admin berhasil dibuat. Login melalui /admin/login.');

    return 0;
})->purpose('Buat administrator CMS tanpa password bawaan');

Artisan::command('cms:import', function () {
    app(ImportWebsiteContent::class)->run();
    $this->info('Konten awal berhasil diimpor. Edit yang sudah ada dipertahankan.');
})->purpose('Impor konten EN/ID website ke CMS');
