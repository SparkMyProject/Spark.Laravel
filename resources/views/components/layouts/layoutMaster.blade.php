@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'components.layouts.horizontalLayout' :
(( $configData["layout"] === 'blank') ? 'components.layouts.blankLayout' :
(($configData["layout"] === 'front') ? 'components.layouts.layoutFront' : 'components.layouts.contentNavbarLayout') )))
@endisset
