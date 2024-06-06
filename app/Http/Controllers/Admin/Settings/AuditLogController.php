<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Helpers\ModelHelper;
use App\Helpers\PermissionsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class AuditLogController extends Controller
{
  public function index()
  {
    $audits = Activity::all()->sortByDesc('created_at');
    return view('web.admin.settings.auditlog.index', ['auditlogs' => $audits]);
  }
  public function view($id)
  {
    $audit = Activity::find($id);
    return view('web.admin.settings.auditlog.view', ['audit' => $audit]);
  }
}
