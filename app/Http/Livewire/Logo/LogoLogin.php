<?php

namespace App\Http\Livewire\Logo;

use Livewire\Component;
use App\Models\GeneralSettings;

class LogoLogin extends Component
{
    public $logo;

    public function __construct()
    {
        if (GeneralSettings::first() == null || GeneralSettings::first()->logo == null) {
            $this->logo = "/img/logo/SAIH-logo.png";
        }else{
            $this->logo = "logos/" . GeneralSettings::first()->logo;
        }
    }
    public function render()
    {
        return view('livewire.logo.logo-login');
    }
}
