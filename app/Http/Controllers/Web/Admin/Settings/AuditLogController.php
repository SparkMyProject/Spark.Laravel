<?php

namespace App\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Web\Controller;
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
