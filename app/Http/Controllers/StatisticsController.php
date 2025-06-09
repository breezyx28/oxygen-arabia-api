<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\UsersMessage;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getStatistics()
    {
        // Get the count of all models
        $stats = [
            'usersMessages' => UsersMessage::count(),
            'services' => Service::count(),
            'subservices' => Subservice::count(),
            'projects' => Project::count(),
            'partners' => Partner::count(),
            'missions' => Mission::count(),
        ];

        return $this->Success('all stats', $stats);
    }
}
