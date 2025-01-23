<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Inertia\Inertia;

class CaseStudyController extends Controller
{
    public function show(CaseStudy $caseStudy)
    {
        return Inertia::render('CaseStudy', [
            'caseStudy' => $caseStudy,
        ]);
    }
}
