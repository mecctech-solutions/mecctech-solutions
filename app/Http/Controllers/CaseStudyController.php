<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Inertia\Inertia;
use Inertia\Response;

class CaseStudyController extends Controller
{
    public function show(CaseStudy $caseStudy): Response
    {
        return Inertia::render('CaseStudy', [
            'caseStudy' => $caseStudy,
        ]);
    }
}
