<?php

namespace App\Containers\Documentation\UI\WEB\Controllers;

use App\Containers\Documentation\UI\WEB\Requests\GetPrivateDocumentationRequest;
use App\Containers\Documentation\UI\WEB\Requests\GetPublicDocumentationRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Support\Facades\Route;

class Controller extends WebController
{
    public function showPrivateDocs(GetPrivateDocumentationRequest $request)
    {
        return view('documentation::documentation.private.index');
    }

    public function showPublicDocs(GetPublicDocumentationRequest $request)
    {
        return view('documentation::documentation.public.index');
    }
}
