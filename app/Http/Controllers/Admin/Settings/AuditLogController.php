<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Helpers\ModelHelper;
use App\Helpers\PermissionsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class AuditLogController extends Controller
{
  public function auditlog()
  {
    $audits = Activity::all()->sortByDesc('created_at');
    return view('content.admin.settings.auditlog', ['auditlogs' => $audits]);
  }
  public function viewlog($id)
  {
    $audit = Activity::find($id);
    return view('content.admin.settings.viewlog', ['audit' => $audit]);
  }
}
